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

    public function espaceClient($mail){
        $lesInfos= $this->modeleConnexion->getAllInformationCompte($mail);
        $lesCommandes=$this->modeleConnexion->getAllCommandes($mail);
        //var_dump($lesCommandes);
        include("vues/v_espaceClient.php");

    }

  /**
	 * lance la fonction qui verifie la connexion
	*/
    public function seConnecter($mail,$mdp){
       $resultat= $this->modeleConnexion->checkConnexion($mail, $mdp);
       if($resultat){
        //connexion réussie
       if (session_status()=== PHP_SESSION_NONE){ session_start();}
        $_SESSION['mail']=$resultat['mail'];

        header("Location:index.php?uc=espaceClient");
        exit();
       
        }else
       //echec
       $erreurs="Mail ou Mot de passe incorrect.";
       require 'vues/v_connexion.html';
       return $resultat;
     
    }
    public function seDeconnecter(){
        session_unset();    
        session_destroy();
        header("Location: index.php");
    exit();
     }
}
