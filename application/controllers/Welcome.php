<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('login_md'); // Charger le modèle de connexion
        $this->load->helper('url');
    }

    public function index() {
        $this->load->view('login'); // Afficher le formulaire de connexion
    }

	public function process_login() {
		$nom = $this->input->post('nom');
		$motdepasse = $this->input->post('motdepasse');
	
		// Vérifier les identifiants de connexion pour les clients
		$utilisateur_client = $this->login_md->authentifier_client($nom, $motdepasse);
	
		// Vérifier les identifiants de connexion pour les admins
		$utilisateur_admin = $this->login_md->authentifier_admin($nom, $motdepasse);
	
		if ($utilisateur_client) {
			// L'utilisateur est connecté avec succès
			// $this->session->set_userdata('id',$utilisateur_client->id);
			$this->session->set_userdata('nom', $utilisateur_client->nom);
			$this->session->set_userdata('motdepasse', $utilisateur_client->motdepasse);
			$this->session->set_userdata('role', 'client');
	
			redirect('Welcome/user_dashboard'); // Rediriger l'utilisateur standard vers le tableau de bord utilisateur
		} elseif ($utilisateur_admin) {
			// L'administrateur est connecté avec succès
			$this->session->set_userdata('nom', $utilisateur_admin->nom);
			$this->session->set_userdata('motdepasse', $utilisateur_admin->motdepasse);
			$this->session->set_userdata('role', 'admin');
	
			redirect('Welcome/admin_dashboard'); // Rediriger l'administrateur vers le tableau de bord admin
		} else {
			// Identifiants incorrects, rediriger vers la page de connexion avec un message d'erreur
			$this->session->set_flashdata('error', 'Nom d\'utilisateur, mot de passe ou numéro de téléphone incorrect.');
			redirect('Welcome/index');
		}
	}
	

	public function admin_dashboard() {
		// Vérifier si l'utilisateur est connecté et s'il est admin
		$nom = $this->session->userdata('nom');
		$role = $this->session->userdata('role');
		if ($nom && $role == 'admin') {
			// Afficher le tableau de bord admin
			$this->load->model('admin_md');
			$data['m'] = $this->admin_md->get_montant_par_mois(2024);  // Remplacez par l'année de votre choix
			$data['mt'] = $this->admin_md->get_montant(2024);
			$this->load->view('admin_dashboard',$data);
		} else {
			// Rediriger vers la page de connexion si l'utilisateur n'est pas connecté ou s'il n'est pas admin
			redirect('Welcome/index');
		}
	}
	
	public function user_dashboard() {
		// Vérifier si l'utilisateur est connecté et s'il n'est pas admin
		$nom = $this->session->userdata('nom');
		$role = $this->session->userdata('role');
		if ($nom && $role == 'client') {
			// Afficher le tableau de bord utilisateur
			$this->load->view('user_dashboard');
		} else {
			// Rediriger vers la page de connexion si l'utilisateur n'est pas connecté ou s'il est admin
			redirect('Welcome/index');
		}
	}
	
	public function profil(){
		// Récupérer les données de session
		$nom = $this->session->userdata('nom');
		$role = $this->session->userdata('role');
		$motdepasse= $this->session->userdata('motdepasse');
		// Récupérer d'autres données de l'utilisateur depuis la base de données
		$this->load->model('login_md'); // Charger le modèle utilisateur
		$utilisateur = $this->login_md->authentifier_admin($nom,$motdepasse); // Remplacer par la méthode appropriée pour récupérer l'utilisateur
		
		// Préparer les données à passer à la vue
		$data['nom'] = $nom;
		$data['role'] = $role;
		$data['adresse'] = $utilisateur->adresse; // Supposons que 'adresse' est une colonne dans votre base de données
		$data['contact'] = $utilisateur->contact; // Supposons que 'adresse' est une colonne dans votre base de données

		
		// Charger la vue du profil et passer les données
		$this->load->view('profil', $data);

	}
    public function logout() {
        // Déconnecter l'utilisateur en détruisant la session
        $this->session->sess_destroy();
        redirect('Welcome/index');
    }
}
