create database construction
use construction

create table utilisateur (
    id varchar(30) primary key,
    nom varchar(30),
    motdepasse varchar(30),
    adresse varchar(30),
    contact varchar(30),
    btp boolean
);

CREATE  TABLE construction.devis ( 
	id                   INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	`idClient`           VARCHAR(30)       ,
	date_debut           DATE       ,
	etat                 VARCHAR(30)       ,
	date_fin             DATE       ,
	couttotal            DOUBLE       ,
	idfinition           VARCHAR(30)       ,
	idbatiment           VARCHAR(30)       ,
	resteapayer          DOUBLE       
 ) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

CREATE INDEX `idClient` ON construction.devis ( `idClient` );


create table travaux(
    id varchar(30) primary key,
    typetravaux varchar(30),
    codetravaux varchar(10),
    designation varchar(50),
    unite varchar(10),
    duree double 
);

insert into travaux values('T01','Travaux Preparatoire','001','Mur de soutenement et demi cloture','m3');
insert into travaux values('T02','Travaux de Terrassement','101','Decapage des terrains meubles','m2');
insert into travaux values('T03','Travaux de Terrassement','102','Dressage du plateforme','m2');

insert into devis values('D01','U02','T01',4,34000,'2024-01-02','En cours');

create view v_devis as select de.id as id,u.nom as Client,t.typetravaux as typetravaux , t.codetravaux as code , t.designation , t.unite,de.quantite,de.PU,de.date_debut,de.etat 
from devis as de 
left join utilisateur as u on u.id = de.idClient 
left join travaux as t on t.id = de.idTrav ;

 insert into devis values('D03','U03','T06',2,45000,'2024-01-02','En cours');

 insert into devis values('D04','U03','T04',1,29000,'2024-01-02','En cours');


 insert into devis values('D05','U01','T05',5,31000,'2024-01-03','En cours');

 insert into travaux values('T04','Travaux de Terrassement','103','Fouille douvrage terrain ferme','m3');

 insert into travaux values('T05','Travaux en infrastructure','201','Maconnerie de moellons , ep 35cm','m3');

 insert into travaux values('T06','Travaux en infrastructure','203','Remblai technique','m3');


create table finition ( 
    id varchar(10) primary key,
    finition varchar(30),
    augmentationprix double,
    gaintemps double
);

create table typebatiment(
    id varchar(30) primary key,
    designation varchar(30),
    duree double 
);

create table paiement(
    id varchar(30) primary key,
    iddevis varchar(30),
    etat varchar(30)
);
insert into utilisateur values('U03','Marc','marc','Itaosy','0324567823','client');

insert into finition values('F01','Standard',40,0);
insert into finition values('F02','Gold',40,40);
insert into finition values('F04','VIP',40,120);
insert into finition values('F03','Premium',40,70);

insert into typebatiment values('BAT01','Villa T2',180);
insert into typebatiment values('BAT02','Maison T3',205);

create table devisbatiment(
    id varchar(30) primary key,
    idbatiment varchar(30),
    idtrav varchar(30),
    quantite double,
    pu double,
    foreign key(idtrav) references travaux(idtrav),
    foreign key(idbatiment) references typebatiment(id)
);

insert into devisbatiment values('DVBAT01','BAT01','T02',2,13000);
insert into devisbatiment values('DVBAT01','BAT01','T04',1,19000);
insert into devisbatiment values('DVBAT01','BAT01','T05',3,21000);

insert into devisbatiment values('DVBAT02','BAT02','T01',2,16000);
insert into devisbatiment values('DVBAT02','BAT02','T02',2,13000);
insert into devisbatiment values('DVBAT02','BAT02','T06',3,12000);
insert into devisbatiment values('DVBAT02','BAT02','T04',2,19000);


select sum(pu) as totalpu,sum(quantite) as totalquantite,(sum(pu) * sum(quantite)) as couttotal from devisbatiment group by idbatiment having idbatiment='BAT01';
create view v_batimentcout as select bat.designation,bat.duree,db.pu,db.quantite,sum(db.pu) as totalpu,sum(db.quantite) as totalquantite,(sum(db.pu) * sum(db.quantite)) as couttotal from devisbatiment as db left join typebatiment as bat on bat.id = db.idbatiment group by idbatiment;
select * from v_batimentcout;
select * from v_getcouttotal;
select * from devisbatiment group by id;
create view v_getcouttotal as select sum(pu) as totalpu,sum(quantite) as totalquantite,(sum(pu) * sum(quantite)) as couttotal from devisbatiment group by idbatiment;

drop view v_devisfinale;
create view v_devisfinale as select de.id as IdDevise,de.idclient ,u.nom,db.idbatiment,tv.id,tb.designation as batiment,fn.finition,tv.typetravaux,tv.codetravaux,tv.designation,tv.unite,db.quantite,tb.duree,de.date_debut,de.date_fin,de.couttotal,de.etat,pa.etat as etatpaiement from devis as de left join devisbatiment as db on db.idbatiment=de.idbatiment left join paiement pa on pa.iddevis = de.id left join typebatiment as tb on tb.id = db.idbatiment left join travaux as tv on tv.id = db.idtrav left join finition fn on fn.id = de.idfinition left join utilisateur as u on de.idclient = u.id;

select * from v_devisfinale group by IdDevise having nom='marc';
alter table paiement add column paye varchar(30);

create view v_paiementdevis as select pa.id as idpaiement,de.id as iddevis,pa.datepaiement,de.idclient,de.nom,de.idbatiment,de.id,de.batiment,de.finition,de.couttotal,de.resteapayer,de.etat from paiement pa left join v_devisfinale as de on de.iddevise = pa.iddevis group by pa.id;

CREATE TABLE IF NOT EXISTS Months (month VARCHAR(2));
INSERT INTO Months VALUES ('01'), ('02'), ('03'), ('04'), ('05'), ('06'), ('07'), ('08'), ('09'), ('10'), ('11'), ('12');