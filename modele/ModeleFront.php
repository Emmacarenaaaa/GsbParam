<?php
/** 
 * Mission : architecture MVC GsbParam
 
 * @file ModeleFront.php
 * @author Marielle Jouin <jouin.marielle@gmail.com>
 * @version    3.0
 * @details contient les fonctions d'accès BD pour le FrontEnd
 */
require_once 'Modele.php';
/**
 * @class ModeleFront
 * @brief contient les fonctions d'accès aux infos de la BD pour les utilisateurs
 */
class ModeleFront extends Modele{
	/**
	 * Retourne toutes les catégories 
	 *
	 * @return array $lesLignes le tableau des catégories (tableau d'objets)
	*/
	public function getLesCategories()
	{
		try 
		{
		$req = 'select idCat, libelleCat from categorie';
		$res = $this->executerRequete($req);
		$lesLignes = $res->fetchAll(PDO::FETCH_OBJ);
		return $lesLignes;
		} 
		catch (PDOException $e) 
		{
        print "Erreur !: " . $e->getMessage();
        die();
		}
	}
	/**
	 * Retourne toutes les informations d'une catégorie passée en paramètre
	 *
	 * @param string $idCategorie l'id de la catégorie
	 * @return object $laLigne la catégorie (objet)
	*/
	public function getLesInfosCategorie($idCategorie)
	{
		try 
		{
        $req = 'SELECT * FROM categorie WHERE idCat="'.$idCategorie.'"';
		$res = $this->executerRequete($req);
		$laLigne = $res->fetch(PDO::FETCH_OBJ);
		return $laLigne;
		} 
		catch (PDOException $e) 
		{
        print "Erreur !: " . $e->getMessage();
        die();
		}
	}
	public function getLesDetailsDuProduit($id)
	{
		try 
		{
			$req= 'SELECT p.idProd, p.descriptionProd, p.prixProd, p.imageProd, p.idCat,p.stockProd, c.libelleCat FROM produit p 
			INNER JOIN categorie c 
			ON p.idCat=c.idCat
			WHERE p.idProd=?';
			$res =$this->executerRequete($req, [$id]);
			$resultat = $res->fetch(PDO::FETCH_ASSOC);
			return $resultat;
		}
		catch(PDOException $e)
		{
			print "Aucun produit trouvé !: ".$e->getMessage();
			die();
		}
	}
/**
 * Retourne sous forme d'un tableau tous les produits de la
 * catégorie passée en argument
 * 
 * @param string $idCategorie  l'id de la catégorie dont on veut les produits
 * @return array $lesLignes un tableau des produits de la categ passée en paramètre (tableau d'objets)
*/

	public function getLesProduitsDeCategorie($idCategorie)
	{
		try 
		{
	    $req='select * from produit where idCat ="'.$idCategorie.'"';
		$res = $this->executerRequete($req);
		$lesLignes = $res->fetchAll(PDO::FETCH_OBJ);
		return $lesLignes; 
		} 
		catch (PDOException $e) 
		{
        print "Erreur !: " . $e->getMessage();
        die();
		}
	}
/**
 * Retourne les produits concernés par le tableau des idProduits passé en argument (si null retourne tous les produits)
 *
 * @param array $desIdsProduit tableau d'idProduits
 * @return array $lesProduits un tableau contenant les infos des produits dont les id ont été passé en paramètre
*/
	public function getLesProduitsDuTableau($desIdsProduit=null)
	{
		try 
		{
		$lesProduits=array();
		if($desIdsProduit != null)
		{
			foreach($desIdsProduit as $unIdProduit)
			{
				$req = 'select * from produit where idProd = "'.$unIdProduit.'"';
				$res = $this->executerRequete($req);
				$unProduit = $res->fetch(PDO::FETCH_OBJ);
				$lesProduits[] = $unProduit;
			}
		}
		else // on souhaite tous les produits
		{
			$req = 'select * from produit;';
			$res = $this->executerRequete($req);
			$lesProduits = $res->fetchAll(PDO::FETCH_OBJ);
		}
		return $lesProduits;
		}
		catch (PDOException $e) 
		{
        print "Erreur !: " . $e->getMessage();
        die();
		}
	}
	/**
	 * Crée une commande 
	 *
	 * Crée une commande à partir des arguments validés passés en paramètre, l'identifiant est
	 * construit à partir du maximum existant ; crée les lignes de commandes dans la table contenir à partir du
	 * tableau d'idProduit passé en paramètre
	 * @param string $nom nom du client
	 * @param string $rue rue du client
	 * @param string $cp cp du client
	 * @param string $ville ville du client
	 * @param string $mail mail du client
	 * @param array $lesIdProduit tableau contenant les id des produits commandés
	 
	*/
	public function creerCommande($nom,$rue,$cp,$ville,$mail, $lesIdProduit )
	{
		try 
		{
			// Recherche de l'utilisateur ou création s'il n'existe pas
			$reqSelectUser = 'SELECT idUser FROM utilisateur WHERE adresseMailUser = ?';
			$resUser = $this->executerRequete($reqSelectUser, [$mail]);
			$user = $resUser->fetch();
			$idUser = 0;

			if ($user) {
				$idUser = $user['idUser'];
			} else {
				$reqInsertUser = 'INSERT INTO utilisateur (nomUser, prenomUser, adresseMailUser, adresseRueUser, villeUser, cpUser, idHab) VALUES (?, ?, ?, ?, ?, ?, 2)';
				$this->executerRequete($reqInsertUser, [$nom, "", $mail, $rue, $ville, $cp]);
				$reqMaxUser = 'SELECT max(idUser) as maxi FROM utilisateur';
				$resMaxUser = $this->executerRequete($reqMaxUser);
				$idUser = $resMaxUser->fetch()['maxi'];
			}

			// Calcul du montant de la commande
			$montantCom = 0;
			foreach($lesIdProduit as $unIdProduit) {
				$reqPrix = 'SELECT prixProd FROM produit WHERE idProd = ?';
				$resPrix = $this->executerRequete($reqPrix, [$unIdProduit]);
				$montantCom += $resPrix->fetch()['prixProd'];
			}

			$date = date('Y/m/d'); 

			// Création de la commande dans paniercommande (état=2 Validé)
			$reqInsertCom = "INSERT INTO paniercommande (dateCom, montantCom, idUser, idEtat) VALUES (?, ?, ?, 2)";
			$this->executerRequete($reqInsertCom, [$date, $montantCom, $idUser]);

			// Récupération de l'id de la commande créée
			$reqMaxCom = 'SELECT max(idCom) as maxi FROM paniercommande';
			$resMaxCom = $this->executerRequete($reqMaxCom);
			$idCommande = $resMaxCom->fetch()['maxi'];

			// Insertion des produits dans lignecommande avec quantité
			$produitCounts = array_count_values($lesIdProduit);
			foreach($produitCounts as $unIdProduit => $quantite)
			{
				$reqInsertLigne = "INSERT INTO lignecommande (quantite, idCom, idProd) VALUES (?, ?, ?)";
				$this->executerRequete($reqInsertLigne, [$quantite, $idCommande, $unIdProduit]);
			}
		}
		catch (PDOException $e) 
		{
        print "Erreur !: " . $e->getMessage();
        die();
		}
	}

}
?>