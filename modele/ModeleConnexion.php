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
        $req = 'SELECT * from client WHERE mail= ? ;';
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
        $req = 'SELECT * from commande WHERE mailClient= ? ;';
       
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

function checkConnexion($mail, $mdp)
{
    try 
    {
   
        $req = 'SELECT mail, password FROM client WHERE mail = ? AND password = ?';
        $params = [$mail, $mdp];
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
        $req='UPDATE client SET  nomCli = ? , prenomCli= ? , password= ? WHERE mail= ?';
        $params =[$nom,$prenom, $mdp,$mail];
        $res =$this->executerRequete($req,$params);
        return $res;

    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}




}