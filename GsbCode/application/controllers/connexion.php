<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Connexion extends CI_Controller {

	function __construct(){
		parent::__construct();
	}
	
	public function index(){
			if($this->utilisateur_model->etreConnecter()){
				redirect('connexion/espaceVisiteur/');
			}else{
			$data['titre'] = 'GSB';
			$data['h1'] = 'Espace connexion';
			$this->load->view('templates/header',$data); //TETE
			$this->load->view('connexion_vue');
			$this->load->view('templates/footer'); //PIED
			}
	}
	
	public function login(){
	
	
		$this->form_validation->set_rules('identifiant', 'Identifiant', 'trim|required|xss_clean');
		$this->form_validation->set_rules('mdp', 'Mot de Passe', 'trim|required|xss_clean|callback_check_database');
		
		
		if(!$this->form_validation->run()){ // Si les champs ne sont pas valide renvoyer au formulaire
				
			$data['titre'] = 'GSB';
			$data['h1'] = 'Espace connexion';
			$this->load->view('templates/header',$data); //TETE
			$this->load->view('connexion_vue');
			$this->load->view('templates/footer'); //PIED
		
		}
		else{
				
			if($this->utilisateur_model->connecter($this->input->post('identifiant'),$this->input->post('mdp'))){
				$this->load->library('session');
				
				$donnee = array(
						'nom'  => $this->input->post('identifiant'),
						'logged_in' => TRUE
				);
				
				$this->session->set_userdata($donnee);
				$nom = $this->input->post('identifiant');
				redirect('connexion/espaceVisiteur/');
			}
			else{
				$data['titre']="GSB";
				$data['h1'] = 'Espace connexion';
				$data['erreur']="Identifiant ou mot de passe incorrect";
				
				$this->load->view('templates/header',$data); //TETE
				$this->load->view('connexion_vue');
				echo $this->utilisateur_model->getDateDEmbauche($this->input->post('mdp'));
				$this->load->view('templates/footer'); //PIED
			}
		}
	
	
	}
	
	public function espaceVisiteur(){
			$data['titre']="GSB (Espace visiteur)";
			$data['h1'] = 'Accueil';
			$this->load->view('templates/header',$data); // TETE
			$this->load->view('templates/menu'); // MENU
			$this->load->view('accueil_vue');
			$this->load->view('templates/footer'); // PIED		
		
	}
	
	public function praticien($colonne){
		
		$data['colonne']=$colonne;
		$data['titre']="GSB (Espace visiteur)";
		$data['h1'] = 'Les praticiens';
		
		$this->form_validation->set_rules('recherche', 'Recherche', 'trim|required|xss_clean');
		if($this->form_validation->run()){
			$data['colonne']=$this->input->post('recherche');
		}
		
		$this->load->view('templates/header',$data); // TETE
		$this->load->view('templates/menu'); // MENU
		$this->load->view('praticien_vue',$data); // APPELLE LA VUE PRATICIEN_VUE
		$this->load->view('templates/footer'); // PIED
	
	}
	
	public function visiteur($colonne){
	
		$data['colonne']=$colonne;
		$data['titre']="GSB (Espace visiteur)";
		$data['h1'] = 'Les visiteurs';
	
		$this->form_validation->set_rules('recherche', 'Recherche', 'trim|required|xss_clean');
		if($this->form_validation->run()){
			$data['colonne']=$this->input->post('recherche');
		}
	
		$this->load->view('templates/header',$data); // TETE
		$this->load->view('templates/menu'); // MENU
		$this->load->view('visiteur_vue',$data); // APPELLE LA VUE PRATICIEN_VUE
		$this->load->view('templates/footer'); // PIED
	
	}
	
	function logout(){
		$this->session->sess_destroy();
		redirect(site_url());
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

?>