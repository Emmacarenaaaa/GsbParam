<?php
/**
 * @file ModeleConnexion.php
 * @author Emma Ducos Martin
  */
  
 /**
 * @class Modele
 * @brief contient les fonctions pour les connexions utilisateurs et exécuter des requêtes
 */
require_once 'Modele.php';
class ModeleConnexion extends Modele{

function getAllInformationCompte($mail)
{

    try 
    {
        $req = 'SELECT u.nomUser as nomCli, u.prenomUser as prenomCli, u.adresseMailUser as mail, l.motPasse as password FROM utilisateur u INNER JOIN login l ON u.idUser = l.idUser WHERE u.adresseMailUser = ? ;';
        $params= [$mail];
        $res =$this->executerRequete($req, $params);
        $result = $res->fetch();
        return $result;
    }
        catch (PDOException $e) 
		{
        print "Erreur !: " . $e->getMessage();
        die();
		}

}
function getAllCommandes($mail)
{
    try 
    {
        $req = 'SELECT c.idCom as id, c.dateCom as dateCommande, c.montantCom as montant, e.libelleEtat as etat 
                FROM paniercommande c 
                INNER JOIN utilisateur u ON c.idUser = u.idUser 
                INNER JOIN etat e ON c.idEtat = e.idEtat
                WHERE u.adresseMailUser = ? ORDER BY c.dateCom DESC;';
       
        $params= [$mail];
        $res =$this->executerRequete($req, $params);
        $result = $res->fetchAll();
        return $result;
    }
        catch (PDOException $e) 
		{
        print "Erreur !: " . $e->getMessage();
        die();
		}

}

function checkConnexion($pseudo, $mdp)
{
    try 
    {
   
        $req = 'SELECT u.adresseMailUser as mail FROM login l INNER JOIN utilisateur u ON l.idUser = u.idUser WHERE l.pseudo = ? AND l.motPasse = ?';
        $params = [$pseudo, $mdp];
        $res = $this->executerRequete($req, $params);
        $result = $res->fetch();
        return $result;
    }

    catch (PDOException $e) 
    {
    print "Erreur !: " . $e->getMessage();
    die();
    }
    
}
function updateClient($mail,$nom,$prenom, $mdp){
    try 
    {
        $req='UPDATE utilisateur SET nomUser = ? , prenomUser= ? WHERE adresseMailUser= ?';
        $params =[$nom,$prenom,$mail];
        $res =$this->executerRequete($req,$params);
        
        $req2='UPDATE login l INNER JOIN utilisateur u ON l.idUser = u.idUser SET l.motPasse = ? WHERE u.adresseMailUser= ?';
        $params2 =[$mdp,$mail];
        $res2 =$this->executerRequete($req2,$params2);

        return $res && $res2;
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}




}