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
        $req = 'SELECT * from client WHERE mail= :mail;';
       // $req= bindParam(':mail', $mail, PDO::PARAM_STR);
        $res =$this->executerRequete($req, $mail);
        $result = $res->fetch();
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
        //$req->bindParam(':mail', $mail, PDO::PARAM_STR);
        //$req->bindParam(':mdp', $mdp, PDO::PARAM_STR);
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





}