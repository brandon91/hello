<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	 
class VerifierIdentification extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('utilisateur_model','',TRUE);	
	}
		
	function index(){
		//This method will have the credentials validation
		$this->load->library('form_validation');
			
		$this->form_validation->set_rules('identifiant', 'Identifiant', 'trim|required|xss_clean');
		$this->form_validation->set_rules('mdp', 'Mot de Passe', 'trim|required|xss_clean|callback_check_database');
		
		if($this->form_validation->run() == FALSE){
			//Field validation failed.  User redirected to login page
			$this->load->view('connexion_vue');
		}else{
			//Go to private area
			redirect('accueil', 'refresh');
		}
	}
					
	function verifier_baseDeDonnee($mdp){
   		//Field validation succeeded.  Validate against database
		$identifiant = $this->input->post('identifiant');
						
		//query the database
		$resultat = $this->utilisateur_model->connecter($identifiant, $mdp);
						
		if($result){
			$session = array();
			foreach($result as $row){
				$session = array(
					'id' => $row->id,
					'username' => $row->username
				);
				$this->session->set_userdata('logged_in', $session);
			}
			return TRUE;
		}else{
			$this->form_validation->set_message('verifier_baseDeDonnee', 'Invalid username or password');
		return false;
		}
	}
}
?>