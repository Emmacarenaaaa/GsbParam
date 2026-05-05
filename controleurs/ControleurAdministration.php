<?php
/**
 * @class ControleurAdministration
 * @brief gère l'affichage et les actions de la partie administration
 */
require_once 'Modele/ModeleAdministration.php';
require_once 'Modele/ModeleFront.php';

class ControleurAdministration{
    
    private $modeleAdmin;
    private $modeleFront;

    public function __construct()
    {
        $this->modeleAdmin = new ModeleAdministration();
        $this->modeleFront = new ModeleFront();
    }

    private function verifierAdmin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['idHab']) || $_SESSION['idHab'] != 1) {
            header("Location: index.php");
            exit();
        }
    }

    /**
     * affiche la page d'administration
    */
    public function pageAdministration(){
        $this->verifierAdmin();
        include("vues/v_administration.php");
    }

    public function gererStocks() {
        $this->verifierAdmin();
        $dispoOnly = isset($_GET['dispo_only']) && $_GET['dispo_only'] == '1';
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'id_asc';
        
        $lesProduits = $this->modeleAdmin->getTousLesProduits($dispoOnly, $sort);
        include("vues/v_gererStocks.php");
    }

    public function majStock() {
        $this->verifierAdmin();
        if (isset($_POST['idProd']) && isset($_POST['stockProd'])) {
            $idProd = $_POST['idProd'];
            $stockProd = intval($_POST['stockProd']);
            $this->modeleAdmin->updateStockProduit($idProd, $stockProd);
            $_SESSION['message_stock'] = "Le stock a été mis à jour avec succès.";
        }
        header("Location: index.php?uc=administration&action=gererStocks");
        exit();
    }

    public function afficherModifierProduit() {
        $this->verifierAdmin();
        if (isset($_GET['idProd'])) {
            $idProd = $_GET['idProd'];
            $unProduit = $this->modeleFront->getLesDetailsDuProduit($idProd);
            $lesCategories = $this->modeleFront->getLesCategories();
            $lesMarques = $this->modeleFront->getLesMarques();
            if ($unProduit) {
                include("vues/v_modifierProduit.php");
            } else {
                header("Location: index.php?uc=voirProduits&action=nosProduits");
                exit();
            }
        } else {
            header("Location: index.php?uc=voirProduits&action=nosProduits");
            exit();
        }
    }

    public function sauvegarderModificationProduit() {
        $this->verifierAdmin();
        if (isset($_POST['idProd'])) {
            $idProd = $_POST['idProd'];
            $nomProd = $_POST['nomProd'] ?? '';
            $descriptionProd = $_POST['descriptionProd'] ?? '';
            $prixProd = $_POST['prixProd'] ?? 0;
            $idMarque = $_POST['idMarque'] ?? '';
            $idCat = $_POST['idCat'] ?? '';
            $stockProd = $_POST['stockProd'] ?? 0;
            $contenanceProd = $_POST['contenanceProd'] ?? '';
            $uniteProd = $_POST['uniteProd'] ?? '';

            $this->modeleAdmin->updateProduitComplet($idProd, $nomProd, $descriptionProd, $prixProd, $idMarque, $idCat, $stockProd, $contenanceProd, $uniteProd);
            
            $_SESSION['message_produit'] = "Le produit a été modifié avec succès.";
            header("Location: index.php?uc=voirProduits&action=voirDetails&id=$idProd");
            exit();
        }
        header("Location: index.php?uc=voirProduits&action=nosProduits");
        exit();
    }
    public function gererCategories() {
        $this->verifierAdmin();
        include("vues/v_ajouterCategorie.php");
    }

    public function sauvegarderNouvelleCategorie() {
        $this->verifierAdmin();
        
        $nomCat = trim($_POST['nomCat'] ?? '');
        
        if (empty($nomCat)) {
            $_SESSION['erreur_categorie'] = "Veuillez saisir un nom pour la catégorie.";
            header("Location: index.php?uc=administration&action=gererCategories");
            exit();
        }
        
        $this->modeleAdmin->ajouterCategorie($nomCat);
        
        $_SESSION['message_admin'] = "La création de la catégorie a été effectuée avec succès.";
        header("Location: index.php?uc=administration");
        exit();
    }
}
?>
