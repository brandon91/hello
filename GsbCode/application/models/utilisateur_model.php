<?php
class Utilisateur_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	
	
	/** Fonction qui permet de se connecter
	 *
	 * @param Identifiant et mot de passe
	 * @return retourne une ligne si l'identifiant existe et que le mot de passe et bon
	 * 			sinon retourne faux
	 * @author sylvain
	 */
	public function connecter($nom,$mdp){
		$this -> db -> select('VIS_NOM, VIS_DATEEMBAUCHE');
		$this -> db -> from('visiteur');
		$this -> db -> where('VIS_NOM', $nom);
		$this -> db -> where('VIS_DATEEMBAUCHE',$this->getDateDEmbauche($mdp));
		$this -> db -> limit(1);
		
		$query = $this -> db -> get();
		
		if($query -> num_rows() == 1) return $query->result();
		else return false;
					   
	}

	
	
	/** Fonction privé qui adapte le mot de passe entré par l'utilisateur au mot de passe de la BDD
	 * 
	 * @param Mot de passe entré par l'utilisateur
	 * @return Mot de passe réadapté
	 * @author sylvain
	 * 
	 */
	function getDateDEmbauche($mdp){
		
		$bool=true;
		$jour = substr($mdp, 0,2);
		$mois = substr($mdp, 3,3);
		$annee = substr($mdp, 7,4);
		if(intval($jour)>0 && intval($jour)<32 && intval($annee)>1990 && intval($annee)<3000){
			
			switch($mois){
				case 'jan':{
					$mois='01';break;
				}
				case 'feb':{
					$mois='02';break;
				}
				case 'mar':{
					$mois='03';break;
				}
				case 'apr':{
					$mois='04';break;
				}
				case 'may':{
					$mois='05';break;
				}
				case 'jun':{
					$mois='06';break;
				}
				case 'jul':{
					$mois='07';break;
				}
				case 'aug':{
					$mois='08';break;
				}
				case 'sep':{
					$mois='09';break;
				}
				case 'oct':{
					$mois='10';break;
				}
				case 'nov':{
					$mois='11';break;
				}
				case 'dec':{
					$mois='12';break;
				}
				default:{
					$bool=false;
				}	
			}
		}else $bool=false;
		
	if($bool)return ($annee."-".$mois."-".$jour);
	else return $bool;
	
	}
	
	/** Fonction qui verifie si l'utilisateur est connecter
	 *
	 * @return vrai s'il est connecté, faux s'il n'est pas connecté
	 * @author sylvain
	 */
	public function etreConnecter(){
		
		if($this->session->userdata('logged_in'))return true;
		else return false;	
		
	}
}