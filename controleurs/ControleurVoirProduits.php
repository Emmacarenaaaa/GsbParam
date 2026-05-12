<?php
/**
 * @file ControleurVoirProduits.php
 * @author Marielle Jouin <jouin.marielle@gmail.com>
 * @version    3.0
 * @details contient les fonctions pour voir les produits

 * regroupe les fonctions pour voir les produits
 */
/**
 * @class ControleurVoirProduits
 * @brief contient les fonctions pour gérer l'affichage des produits
 */
class ControleurVoirProduits{
    private $modeleFront;

    public function __construct()
    {
        $this->modeleFront=new ModeleFront();
    }
	/**
	 * Affiche les produits
	 *
	 * si $categ contient un idCategorie affiche les produits d'une catégorie
	 * @param $categ un identifiant de la catégorie de produits à afficher
	*/
    public function voirProduits($categ){
    if ($categ == null) {
        $categ = 'CH';
    }
    $dispoOnly = isset($_GET['dispo_only']) && $_GET['dispo_only'] == '1';
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'id_asc';
    $prixMin = isset($_GET['prix_min']) && $_GET['prix_min'] !== '' ? floatval($_GET['prix_min']) : null;
    $prixMax = isset($_GET['prix_max']) && $_GET['prix_max'] !== '' ? floatval($_GET['prix_max']) : null;
    $marque = isset($_GET['marque']) && $_GET['marque'] !== '' ? intval($_GET['marque']) : null;

    $lesProduits = $this->modeleFront->getLesProduitsDeCategorie($categ, $dispoOnly, $sort, $prixMin, $prixMax, $marque);
    $lesCategories = $this->modeleFront->getLesCategories();
    $infosCategorie = $this->modeleFront->getLesInfosCategorie($categ);
    $lesMarques = $this->modeleFront->getLesMarques();

    $titreCategorie = "Produits de la catégorie :" . strtolower($infosCategorie->libelleCat);

    include("vues/v_choixCategorie.php");
    include("vues/v_produits.php");
}
public function voirTousLesProduits() {
    $dispoOnly = isset($_GET['dispo_only']) && $_GET['dispo_only'] == '1';
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'id_asc';
    $prixMin = isset($_GET['prix_min']) && $_GET['prix_min'] !== '' ? floatval($_GET['prix_min']) : null;
    $prixMax = isset($_GET['prix_max']) && $_GET['prix_max'] !== '' ? floatval($_GET['prix_max']) : null;
    $marque = isset($_GET['marque']) && $_GET['marque'] !== '' ? intval($_GET['marque']) : null;

    $lesMarques = $this->modeleFront->getLesMarques();
    $lesProduits = $this->modeleFront->getTousLesProduitsFront($dispoOnly, $sort, $prixMin, $prixMax, $marque);
    $titreCategorie = "Tous les produits : ";
    include("vues/v_produits.php");
}
public function voirDetailsProduits($id) {
    $unProduit = $this->modeleFront->getLesDetailsDuProduit($id);
    if (!$unProduit) {
        header("Location: index.php?uc=voirProduits");
        exit();
    }
    
    $lesAvis = $this->modeleFront->getAvisProduit($id);
    $aDejaAvis = false;
    if (isset($_SESSION['idUser'])) {
        $aDejaAvis = $this->modeleFront->aDejaLaisseAvis($_SESSION['idUser'], $id);
    }
    
    include("vues/v_detailProduit.php");
}

public function ajouterAvis() {
    if (!isset($_SESSION['idUser'])) {
        header("Location: index.php?uc=connexion");
        exit();
    }
    
    $idProd = $_POST['idProd'] ?? null;
    $note = $_POST['note'] ?? null;
    $description = $_POST['description'] ?? '';
    
    if ($idProd && $note) {
        $success = $this->modeleFront->ajouterAvisProduit($_SESSION['idUser'], $idProd, $note, $description);
        if ($success) {
            $_SESSION['message_avis'] = "Votre avis a été enregistré avec succès.";
        } else {
            $_SESSION['erreur_avis'] = "Vous avez déjà donné votre avis sur ce produit.";
        }
    } else {
        $_SESSION['erreur_avis'] = "Veuillez attribuer une note au produit.";
    }
    
    if ($idProd) {
        header("Location: index.php?uc=voirProduits&action=voirDetails&id=$idProd");
    } else {
        header("Location: index.php?uc=voirProduits");
    }
    exit();
}
	/**
	 * Affiche le menu à gauche contenant les catégories
	*/
    public function voirCategories(){
		$lesCategories=$this->modeleFront->getLesCategories();
        include("vues/v_choixCategorie.php");
	}
}

?>

