<?php

echo FORM_OPEN("connexion/login");

/*
 * 			Identifiant
 */
	
	echo form_label('Identifiant :', 'identifiant');

	$id = array(
				'name'        => 'identifiant',
				'id'          => 'identifiant',
				'value'       => '',
				'maxlength'   => '20',
				'size'        => '20',
				'style'       => '',
			   );

	echo  form_input($id);
	
	echo br();echo br();

/*
 | 			Mot de passe
 */
	echo form_label('Mot de passe :', 'mdp');

	$mdp = array(
				'name'        => 'mdp',
				'id'          => 'mdp',
				'value'       => '',
				'maxlength'   => '11',
				'size'        => '20',
				'style'       => '',
				);

	echo  form_password($mdp);

	echo br();echo br();

/*
 * 		Bouton 'se connecter'
 */
	echo  form_submit("connexion", "se connecter");

echo form_close(); /* FIN FORMULAIRE */

echo validation_errors(); /* Affiche une erreur si l'id/mdp ne sont pas remplis */

if(isset($erreur)) echo $erreur; /* Affiche une erreur si l'id/mdp sont incorrects */
?>