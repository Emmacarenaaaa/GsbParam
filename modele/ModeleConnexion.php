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

function getAllInformationCompte($idUser)
{

    try 
    {
        $req = 'SELECT * from utilisateur WHERE id= ? ;';
        $params= [$idUser];
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
function getAllCommandes($idUser)
{
    try 
    {
        $req = 'SELECT * from commande WHERE idUser= ? ;';
       
        $params= [$idUser];
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
   
        $req = 'SELECT pseudo, motPasse FROM login
    WHERE pseudo = ? AND motPasse = ?';
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
function updateClient($idUser,$nom,$prenom, $mdp){
    try 
    {
        $req='UPDATE utilisateur SET  nomCli = ? , prenomCli= ? , password= ? WHERE idUser= ?';
        $params =[$nom,$prenom, $mdp,$idUser];
        $res =$this->executerRequete($req,$params);
        return $res;

    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}




}