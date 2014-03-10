<?php

/* Formulaire de recherche
 * Entrer un nom ou un prenom
 */
echo form_open("connexion/praticien/recherche");
echo form_label("Rechercher nom ou prenom d'un praticien :", "recherche");
echo form_input("recherche");
echo form_submit("rechercher", "rechercher");
echo form_close(); /* FIN FORMULAIRE */
echo validation_errors(); /* Affiche une erreur si la recherche n'est pas rempli */

/* Nom de chaque colonne
 * Lien sur chaque nom pour trier 
 */
$this->table->set_heading(anchor('connexion/praticien/nom', 'Nom'),
						  anchor('connexion/praticien/prenom', 'Prenom'),
						  anchor('connexion/praticien/adresse', 'Adresse') ,
						  anchor('connexion/praticien/codePostal', 'Code Postal') ,
						  anchor('connexion/praticien/ville', 'Ville'),
						  anchor('connexion/praticien/lieu', 'Lieu'),
						  anchor('connexion/praticien/type', 'Type'),
						  anchor('connexion/praticien/notoriete', 'Notoriété'));

/* Trier selon les données rentrés en parametre
 * Fait appelle a la fonction getPraticiens() ou rechercherPraticiens() si c'est une recherche
 * Afficher la table ordonée
 */
switch($colonne){
	case('nom'):{
		echo $this->table->generate($this->fonction_model->getPraticiens("PRA_NOM"));
		break;
	}
	case('prenom'):{
		echo $this->table->generate($this->fonction_model->getPraticiens("PRA_PRENOM"));
		break;
	}
	case('adresse'):{
		echo $this->table->generate($this->fonction_model->getPraticiens("PRA_ADRESSE"));
		break;
	}
	case('codePostal'):{
		echo $this->table->generate($this->fonction_model->getPraticiens("PRA_CP"));
		break;
	}
	case('ville'):{
		echo $this->table->generate($this->fonction_model->getPraticiens("PRA_VILLE"));
		break;
	}
	case('type'):{
		echo $this->table->generate($this->fonction_model->getPraticiens("TYP_LIBELLE"));
		break;
	}
	case('lieu'):{
		echo $this->table->generate($this->fonction_model->getPraticiens("TYP_LIEU"));
		break;
	}
	case('notoriete'):{
		echo $this->table->generate($this->fonction_model->getPraticiens("PRA_COEFNOTORIETE"));
		break;
	}
	default:{
		echo $this->table->generate($this->fonction_model->rechercherPraticiens($colonne));
		break;
	}
}
?>