<?php
require_once 'controleurs/ControleurVoirProduits.php';
require_once 'controleurs/ControleurAccueil.php';
require_once 'controleurs/ControleurGererPanier.php';
require_once 'controleurs/ControleurConnexion.php';
require_once 'controleurs/ControleurAdministration.php';
/**
 * @class Routeur
 * @brief gère les routes (actions à exécuter en fonction des urls)
 */
class Routeur{
    
    private $ctrlVoirProduits;
    private $ctrlAccueil;
    private $ctrlGererPanier;
    private $ctrlConnexion;
    private $ctrlAdministration;

    
    public function __construct(){
        
        $this->ctrlVoirProduits=new ControleurVoirProduits();
        $this->ctrlAccueil=new ControleurAccueil();
        $this->ctrlGererPanier=new ControleurGererPanier();
        $this->ctrlConnexion=new ControleurConnexion();
        $this->ctrlAdministration=new ControleurAdministration();
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
                case 'nosProduits' : {$this->ctrlVoirProduits->voirTousLesProduits(); break;} 
                case 'voirDetails': {$this->ctrlVoirProduits->voirDetailsProduits($_REQUEST['id']);break;}
                case 'ajouterAvis': {$this->ctrlVoirProduits->ajouterAvis();break;}
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
              //  case 'viderPanier' : {$this->ctrlGererPanier->supprimerPanier();break;}
                default: {$this->ctrlGererPanier->voirPanier();break;}
            }; break;
            case 'espaceClient':
                switch($action)
                {
                    case null: 
                        if (isset($_SESSION['mail'])) {
                            $this->ctrlConnexion->espaceClient($_SESSION['mail']);
                        } else {
                            $this->ctrlConnexion->pageConnexion();
                        } 
                        break;

                    case 'seConnecter':
                        if (isset($_POST['pseudo']) && isset($_POST['mdp'])) {
                            $pseudo = $_POST['pseudo'];
                            $mdp = $_POST['mdp'];
                            $this->ctrlConnexion->seConnecter($pseudo,$mdp);
                        } else
                        {
                            $this->ctrlConnexion->pageConnexion(); 
                        }
                        case 'seDeconnecter':
                            $this->ctrlConnexion->seDeconnecter();
                            break;
                        case 'modifierProfil':
                            $this->ctrlConnexion->modifierProfil($_SESSION['mail']);
                             break;
                        case 'confirmerModif':
                                $this->ctrlConnexion->confirmerModif($_SESSION['mail']);

                            break;

                    }; 
                    break;

                   
        case 'administration' :
            switch($action) {
                case null:
                    $this->ctrlAdministration->pageAdministration();
                    break;
                case 'gererStocks':
                    $this->ctrlAdministration->gererStocks();
                    break;
                case 'majStock':
                    $this->ctrlAdministration->majStock();
                    break;
                case 'afficherModifierProduit':
                    $this->ctrlAdministration->afficherModifierProduit();
                    break;
                case 'sauvegarderModificationProduit':
                    $this->ctrlAdministration->sauvegarderModificationProduit();
                    break;
                case 'gererCategories':
                    $this->ctrlAdministration->gererCategories();
                    break;
                case 'sauvegarderNouvelleCategorie':
                    $this->ctrlAdministration->sauvegarderNouvelleCategorie();
                    break;
            }
            break; 
    }
    }
}