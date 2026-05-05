<?php
/**
 * @file ModeleAdministration.php
 */
require_once 'Modele.php';

class ModeleAdministration extends Modele {
    
    public function getTousLesProduits($dispoOnly = false, $sort = 'id_asc') {
        try {
            $req = 'SELECT idProd, descriptionProd, prixProd, imageProd, idCat, stockProd FROM produit';
            
            if ($dispoOnly) {
                $req .= ' WHERE stockProd > 0';
            }
            
            switch ($sort) {
                case 'stock_asc':
                    $req .= ' ORDER BY stockProd ASC';
                    break;
                case 'stock_desc':
                    $req .= ' ORDER BY stockProd DESC';
                    break;
                case 'id_asc':
                default:
                    $req .= ' ORDER BY idProd ASC';
                    break;
            }
            
            $res = $this->executerRequete($req);
            return $res->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }
    
    public function updateStockProduit($idProd, $nouveauStock) {
        try {
            $req = 'UPDATE produit SET stockProd = ? WHERE idProd = ?';
            $this->executerRequete($req, [$nouveauStock, $idProd]);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    public function updateProduitComplet($idProd, $nomProd, $descriptionProd, $prixProd, $idMarque, $idCat, $stockProd, $contenanceProd, $uniteProd) {
        try {
            $req = 'UPDATE produit SET nomProd = ?, descriptionProd = ?, prixProd = ?, idMarque = ?, idCat = ?, stockProd = ?, contenanceProd = ?, uniteProd = ? WHERE idProd = ?';
            $this->executerRequete($req, [$nomProd, $descriptionProd, $prixProd, $idMarque, $idCat, $stockProd, $contenanceProd, $uniteProd, $idProd]);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }
    public function ajouterCategorie($nomCat) {
        try {
            $nomCatNettoye = strtoupper(preg_replace('/[^a-zA-Z]/', '', $nomCat));
            $baseIdCat = substr($nomCatNettoye, 0, 2);
            if (strlen($baseIdCat) < 2) {
                $baseIdCat = str_pad($baseIdCat, 2, 'X');
            }
            
            $idCat = $baseIdCat;
            $reqCheck = 'SELECT count(*) FROM categorie WHERE idCat = ?';
            $res = $this->executerRequete($reqCheck, [$idCat]);
            
            if ($res->fetchColumn() > 0) {
                $idCat = substr($nomCatNettoye, 0, 3);
                if (strlen($idCat) < 3) {
                    $idCat = str_pad($idCat, 3, 'X');
                }
                $res = $this->executerRequete($reqCheck, [$idCat]);
                if ($res->fetchColumn() > 0) {
                    $idCat = substr($baseIdCat, 0, 1) . rand(10, 99);
                }
            }
            
            $req = 'INSERT INTO categorie (idCat, libelleCat) VALUES (?, ?)';
            $this->executerRequete($req, [$idCat, $nomCat]);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }
}
?>
