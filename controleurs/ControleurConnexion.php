<?php
/** @file ControleurConnexion.php
 * @author Emma Ducos Martin
 * @version    3.0
 * @details Gère l'affichage de la page de connexion, la déconnexion et l'espace client.
*/
require_once 'Modele/ModeleConnexion.php';

/**
 * @class ControleurConnexion
 * @brief Gère la logique de l'authentification et de l'espace personnel de l'utilisateur.
 */
class ControleurConnexion{
    private $modeleConnexion;

    public function __construct()
    {
        $this->modeleConnexion=new ModeleConnexion();
    }

    /**
	 * Affiche la page de connexion principale.
	*/
    public function pageConnexion(){
        include("vues/v_connexion.html");
    }

    /**
     * Affiche l'espace client avec les informations de l'utilisateur, 
     * son historique de commandes et ses avis déposés.
     * @param string $mail L'adresse mail de l'utilisateur connecté.
     */
    public function espaceClient($mail){
        // Récupération des informations du compte et des commandes globales
        $lesInfos= $this->modeleConnexion->getAllInformationCompte($mail);
        $lesCommandesBase=$this->modeleConnexion->getAllCommandes($mail);
        
        // Enrichissement des commandes avec le détail de leurs lignes (produits)
        $lesCommandes = [];
        foreach ($lesCommandesBase as $cmd) {
            $cmd['lignes'] = $this->modeleConnexion->getLignesCommande($cmd['id']);
            $lesCommandes[] = $cmd;
        }
        
        // Récupération des avis si l'utilisateur est bien identifié
        $idUser = $lesInfos['idUser'] ?? ($_SESSION['idUser'] ?? null);
        $lesAvis = [];
        if ($idUser) {
            $lesAvis = $this->modeleConnexion->getAllAvisClient($idUser);
        }
        
        // Affichage de la vue de l'espace client
        include("vues/v_espaceClient.php");
    }

    /**
     * Prépare et affiche le formulaire de modification du profil.
     * @param string $idUser L'adresse mail de l'utilisateur (identifiant).
     */
    public function modifierProfil($idUser) {
        $lesInfos = $this->modeleConnexion->getAllInformationCompte($idUser);
        include("./vues/v_modifierProfil.php");
    }

    /**
     * Traite la soumission du formulaire de modification de profil.
     * Récupère les données envoyées en POST et met à jour la base de données.
     * @param string $idUser L'adresse mail de l'utilisateur.
     */
    public function confirmerModif($idUser) {
        // Récupération des saisies de l'utilisateur
        $nom = $_POST['nomCli'];
        $prenom = $_POST['prenomCli'];
        $mdp = $_POST['password'];
        
        // Mise à jour en base de données
        $this->modeleConnexion->updateClient($idUser, $nom, $prenom,$mdp);
        
        // Redirection vers l'espace client après modification
        header("Location: index.php?uc=espaceClient");
        exit();
    }

    /**
	 * Vérifie les identifiants de connexion et initialise la session si corrects.
     * @param string $pseudo Le pseudo entré par l'utilisateur.
     * @param string $mdp Le mot de passe entré.
	*/
    public function seConnecter($pseudo,$mdp){
       // Vérification des identifiants via le modèle
       $resultat= $this->modeleConnexion->checkConnexion($pseudo, $mdp);
       
       if($resultat){
            // Connexion réussie : on démarre la session si elle n'existe pas
            if (session_status()=== PHP_SESSION_NONE){ session_start();}
            
            // Stockage des informations utiles dans la session
            $_SESSION['idUser'] = $resultat['idUser'];
            $_SESSION['mail']=$resultat['mail'];
            $_SESSION['idHab']=$resultat['idHab']; // Habilitation (1=admin, 2=client)

            // Redirection vers l'espace client
            header("Location:index.php?uc=espaceClient");
            exit();
       } else {
            // Échec de la connexion : on affiche un message d'erreur
            $erreurs="Pseudo ou Mot de passe incorrect.";
            require 'vues/v_connexion.html';
            return $resultat;
       }
    }

    /**
     * Gère la déconnexion en détruisant la session actuelle.
     */
    public function seDeconnecter(){
        session_unset();    
        session_destroy();
        header("Location: index.php");
        exit();
    }
}
