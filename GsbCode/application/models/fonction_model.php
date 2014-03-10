<?php
class Fonction_model extends CI_Model {
	
function __construct(){
	parent::__construct();
}
	
/** Fonction qui recupere tout les praticiens
 *
 * @param colonne de la table praticien
 * @return la liste des praticiens ordonné selon le parametre
 * @author sylvain
 *
 */
public function getPraticiens($colonne){

	$this -> db -> select('PRA_NOM, PRA_PRENOM,PRA_ADRESSE,PRA_CP,PRA_VILLE,TYP_LIEU,TYP_LIBELLE,PRA_COEFNOTORIETE');
	$this -> db -> from('praticien,engine_praticien');
	$this -> db -> order_by($colonne);
	$this -> db -> order_by('PRA_NOM');
	return $this -> db -> get();
}

/** Fonction qui permet de rechercher un ou plusieurs praticiens
 *
 * @param tout ou une partie du nom/prenom du praticien
 * @return liste des praticiens selon la recherche
 * @author sylvain
 *
 */
public function rechercherPraticiens($praticien){
	$this -> db -> select('PRA_NOM, PRA_PRENOM,PRA_ADRESSE,PRA_CP,PRA_VILLE,TYP_LIEU,TYP_LIBELLE,PRA_COEFNOTORIETE');
	$this -> db -> from('praticien,engine_praticien');
	$this -> db -> like('PRA_NOM',$praticien);
	$this -> db -> or_like('PRA_PRENOM',$praticien);
	$this -> db -> order_by('PRA_NOM');

	return $this -> db -> get();
}


/** Fonction qui recupere tout les visiteurs
 *
 * @param colonne de la table visiteurs
 * @return la liste des visiteurs ordonné selon le parametre
 * @author sylvain
 *
 */
public function getVisiteurs($colonne){

	$this -> db -> select('VIS_NOM, Vis_PRENOM, VIS_ADRESSE, VIS_CP, VIS_VILLE');
	$this -> db -> from('visiteur');
	$this -> db -> order_by($colonne);
	$this -> db -> order_by('VIS_NOM');
	return $this -> db -> get();
}

/** Fonction qui permet de rechercher un ou plusieurs visiteurs
 *
 * @param tout ou une partie du nom/prenom du visiteur
 * @return liste des visiteurs selon la recherche
 * @author sylvain
 *
 */
public function rechercherVisiteurs($visiteur){
	$this -> db -> select('VIS_NOM, Vis_PRENOM, VIS_ADRESSE, VIS_CP, VIS_VILLE');
	$this -> db -> from('visiteur');
	$this -> db -> like('VIS_NOM',$visiteur);
	$this -> db -> or_like('Vis_PRENOM',$visiteur);
	$this -> db -> order_by('VIS_NOM');
	return $this -> db -> get();
}

}