<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('login_md'); // Charger le modèle de connexion
        $this->load->helper('url');
    }

    public function profil(){
        
    }
}