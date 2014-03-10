<?php

/* Formulaire de recherche
 * Entrer un nom ou un prenom
 */
echo form_open("connexion/visiteur/recherche");
echo form_label("Rechercher nom ou prenom d'un visiteur :", "recherche");
echo form_input("recherche");
echo form_submit("rechercher", "rechercher");
echo form_close(); /* FIN FORMULAIRE */
echo validation_errors(); /* Affiche une erreur si la recherche n'est pas rempli */

/* Nom de chaque colonne
 * Lien sur chaque nom pour trier 
 */
$this->table->set_heading(anchor('connexion/visiteur/nom', 'Nom'),
						  anchor('connexion/visiteur/prenom', 'Prenom'),
						  anchor('connexion/visiteur/adresse', 'Adresse') ,
						  anchor('connexion/visiteur/codePostal', 'Code Postal') ,
						  anchor('connexion/visiteur/ville', 'Ville'));

/* Trier selon les données rentrés en parametre
 * Fait appelle a la fonction getVisiteurs() ou rechercherVisiteurs() si c'est une recherche
 * Afficher la table ordonée
 */
switch($colonne){
	case('nom'):{
		echo $this->table->generate($this->fonction_model->getVisiteurs("VIS_NOM"));
		break;
	}
	case('prenom'):{
		echo $this->table->generate($this->fonction_model->getVisiteurs("Vis_PRENOM"));
		break;
	}
	case('adresse'):{
		echo $this->table->generate($this->fonction_model->getVisiteurs("VIS_ADRESSE"));
		break;
	}
	case('codePostal'):{
		echo $this->table->generate($this->fonction_model->getVisiteurs("VIS_CP"));
		break;
	}
	case('ville'):{
		echo $this->table->generate($this->fonction_model->getVisiteurs("VIS_VILLE"));
		break;
	}
	case('secteur'):{
		echo $this->table->generate($this->fonction_model->getVisiteurs("SEC_LIBELLE"));
		break;
	}
	case('labo'):{
		echo $this->table->generate($this->fonction_model->getVisiteurs("LAB_NOM"));
		break;
	}
	case('chef'):{
		echo $this->table->generate($this->fonction_model->getVisiteurs("LAB_CHEFVENTE"));
		break;
	}
	default:{
		echo $this->table->generate($this->fonction_model->rechercherVisiteurs($colonne));
		break;
	}
}
?>