<?php
require_once 'controleurs/ControleurVoirProduits.php';
require_once 'controleurs/ControleurAccueil.php';
require_once 'controleurs/ControleurGererPanier.php';
require_once 'controleurs/ControleurConnexion.php';
/**
 * @class Routeur
 * @brief gère les routes (actions à exécuter en fonction des urls)
 */
class Routeur{
    
    private $ctrlVoirProduits;
    private $ctrlAccueil;
    private $ctrlGererPanier;
    private $ctrlConnexion;

    
    public function __construct(){
        
        $this->ctrlVoirProduits=new ControleurVoirProduits();
        $this->ctrlAccueil=new ControleurAccueil();
        $this->ctrlGererPanier=new ControleurGererPanier();
        $this->ctrlConnexion=new ControleurConnexion();
    }
    /** recupère les paramètres de l'url et active les contrôleurs nécessaires
    */
    public function routerRequete()
    {
    // traitement des paramètres de l'url
    if(isset($_REQUEST['uc']))
        $uc = $_REQUEST['uc'];
        else $uc='accueil';
    if(isset($_REQUEST['action']))
        $action = $_REQUEST['action'];
    else $action=null;
    switch($uc)
    {
        case 'accueil':
            $this->ctrlAccueil->accueil();break;
        case 'voirProduits' :
            switch ($action)
            {
                case null :
                case 'voirCategories' : {$this->ctrlVoirProduits->voirProduits(null); break;}
                case 'voirProduits' : {$this->ctrlVoirProduits->voirProduits($_REQUEST['categorie']);break;}
                case 'nosProduits' : {$this->ctrlVoirProduits->voirTousLesProduits(); break;} // AJOUT
            }; break;
        case 'gererPanier' :
            switch ($action)
            {
                case null :
                case 'voirPanier' : {$this->ctrlGererPanier->voirPanier();break;}
                case 'ajouterAuPanier' : {$this->ctrlGererPanier->ajouterAuPanier($_REQUEST['produit']);break;}
                case 'supprimerUnProduit' : {$this->ctrlGererPanier->supprimerProduitDuPanier($_REQUEST['produit']);break;}
                case 'viderPanier' : {$this->ctrlGererPanier->viderPanier();break;}
                case 'passerCommande' : $this->ctrlGererPanier->passerCommande();break;
                case 'confirmerCommande' : $this->ctrlGererPanier->confirmerCommande();break;
                case 'viderPanier' : {$this->ctrlGererPanier->supprimerPanier();break;}
                default: {$this->ctrlGererPanier->voirPanier();break;}
            }; break;
            case 'connexion':
                switch($action)
                {
                    case null:{$this->ctrlConnexion->pageConnexion();break;}
                    case 'seConnecter':
                        if (isset($_POST['mail']) && isset($_POST['mdp'])) {
                            $mail = $_POST['mail'];
                            $mdp = $_POST['mdp'];
                            $this->ctrlConnexion->seConnecter($mail,$mdp);
                        } else
                        {
                            $this->ctrlConnexion->pageConnexion(); 
                        }
                    }; break;
        case 'administrer' :  // TODO Créer un contrôleur spécial pour l'administration du site
        break; 
    }
    }
}