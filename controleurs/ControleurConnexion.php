<?php
/** @file ControleurAccueil.php
 * @author Emma Ducos Martin
 * @version    3.0
 * @details Gère l'affichage de la page de connexion 
*/
require_once 'Modele/ModeleConnexion.php';
/**
 * @class ControleurConnexion
 * @brief contient la fonction qui gère la connexion
 */
class ControleurConnexion{
    private $modeleConnexion;

    public function __construct()
    {
        $this->modeleConnexion=new ModeleConnexion();
    }

    /**
	 * affiche la page de connexion
	*/
    public function pageConnexion(){
        include("vues/v_connexion.html");
    }

  /**
	 * lance la fonction qui verifie la connexion
	*/
    public function seConnecter($mail,$mdp){
       $resultat= $this->modeleConnexion->checkConnexion($mail, $mdp);
       if($resultat){
        //connexion réussie
        session_start();
        $_SESSION['user_mail']=$resultat['mail'];
        header("Location:index.php?uc=espaceClient");
        exit();
       }else
       //echec
       $erreurs="Mail ou Mot de passe incorrect.";
       require 'vues/v_connexion.html';
       return $resultat;
     
    }
}
