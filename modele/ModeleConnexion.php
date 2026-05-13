<?php
/**
 * @file ModeleConnexion.php
 * @author Emma Ducos Martin
 */

/**
 * @class ModeleConnexion
 * @brief Gère l'accès aux données liées à la connexion, aux informations des utilisateurs et à leurs commandes.
 */
require_once 'Modele.php';

class ModeleConnexion extends Modele
{

    /**
     * Récupère toutes les informations d'un compte utilisateur à partir de son adresse email.
     * @param string $mail L'adresse email de l'utilisateur.
     * @return array|false Les données de l'utilisateur ou false s'il n'est pas trouvé.
     */
    function getAllInformationCompte($mail)
    {
        try {
            // Requête pour obtenir les infos de l'utilisateur ainsi que son mot de passe
            $req = 'SELECT u.idUser, u.nomUser as nomCli, u.prenomUser as prenomCli, u.adresseMailUser as mail, l.motPasse as password, u.adresseRueUser, u.villeUser, u.cpUser FROM utilisateur u INNER JOIN login l ON u.idUser = l.idUser WHERE u.adresseMailUser = ? ;';
            $params = [$mail];
            $res = $this->executerRequete($req, $params);
            $result = $res->fetch();
            return $result;
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    /**
     * Récupère l'historique de toutes les commandes passées par un utilisateur.
     * @param string $mail L'adresse email de l'utilisateur.
     * @return array La liste des commandes de l'utilisateur.
     */
    function getAllCommandes($mail)
    {
        try {
            // Jointure entre paniercommande, utilisateur et etat pour avoir le détail des commandes
            $req = 'SELECT c.idCom as id, c.dateCom as dateCommande, c.montantCom as montant, e.libelleEtat as etat 
                FROM paniercommande c 
                INNER JOIN utilisateur u ON c.idUser = u.idUser 
                INNER JOIN etat e ON c.idEtat = e.idEtat
                WHERE u.adresseMailUser = ? ORDER BY c.dateCom DESC;';

            $params = [$mail];
            $res = $this->executerRequete($req, $params);
            $result = $res->fetchAll();
            return $result;
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    /**
     * Récupère les lignes d'une commande spécifique (produits, quantités, prix).
     * @param int $idCom L'identifiant de la commande.
     * @return array La liste des produits contenus dans la commande.
     */
    function getLignesCommande($idCom)
    {
        try {
            // Jointure pour récupérer les informations des produits liés à cette commande
            $req = 'SELECT l.quantite, p.nomProd, p.imageProd, p.prixProd, p.contenanceProd, p.uniteProd, m.libelleMarque 
                FROM lignecommande l 
                INNER JOIN produit p ON l.idProd = p.idProd 
                INNER JOIN marque m ON p.idMarque = m.idMarque 
                WHERE l.idCom = ?';
            $res = $this->executerRequete($req, [$idCom]);
            return $res->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    /**
     * Vérifie si les identifiants de connexion (pseudo et mot de passe) sont corrects.
     * @param string $pseudo Le pseudo de l'utilisateur.
     * @param string $mdp Le mot de passe de l'utilisateur.
     * @return array|false Les données de l'utilisateur (id, mail, habilitation) si correct, sinon false.
     */
    function checkConnexion($pseudo, $mdp)
    {
        try {
            // Recherche de l'utilisateur correspondant au couple pseudo / mot de passe
            $req = 'SELECT u.idUser, u.adresseMailUser as mail, u.idHab as idHab FROM login l INNER JOIN utilisateur u ON l.idUser = u.idUser WHERE l.pseudo = ? AND l.motPasse = ?';
            $params = [$pseudo, $mdp];
            $res = $this->executerRequete($req, $params);
            $result = $res->fetch();
            return $result;
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    /**
     * Met à jour les informations d'un client (nom, prénom et mot de passe).
     * @param string $mail L'adresse email du client.
     * @param string $nom Le nouveau nom.
     * @param string $prenom Le nouveau prénom.
     * @param string $mdp Le nouveau mot de passe.
     * @return bool True si la mise à jour a réussi, false sinon.
     */
    function updateClient($mail, $nom, $prenom, $mdp)
    {
        try {
            // 1. Mise à jour des informations de l'utilisateur
            $req = 'UPDATE utilisateur SET nomUser = ? , prenomUser= ? WHERE adresseMailUser= ?';
            $params = [$nom, $prenom, $mail];
            $res = $this->executerRequete($req, $params);

            // 2. Mise à jour de son mot de passe dans la table login
            $req2 = 'UPDATE login l INNER JOIN utilisateur u ON l.idUser = u.idUser SET l.motPasse = ? WHERE u.adresseMailUser= ?';
            $params2 = [$mdp, $mail];
            $res2 = $this->executerRequete($req2, $params2);

            return $res && $res2;
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

    /**
     * Récupère tous les avis rédigés par un utilisateur spécifique.
     * @param int $idUser L'identifiant de l'utilisateur.
     * @return array La liste de ses avis triés par date décroissante.
     */
    function getAllAvisClient($idUser)
    {
        try {
            $req = 'SELECT a.note, a.date_avis, a.description, p.nomProd, p.idProd, p.imageProd 
                FROM ecrire_avis a 
                INNER JOIN produit p ON a.idProd = p.idProd 
                WHERE a.idUser = ? 
                ORDER BY a.date_avis DESC';
            $params = [$idUser];
            $res = $this->executerRequete($req, $params);
            return $res->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }

}
?>