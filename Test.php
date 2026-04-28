<?php
require 'config/.config.php';
require 'modele/ModeleConnexion.php';
$m = new ModeleConnexion();
$mail = 'Vincent.LaG@mail.com';
$cmd = $m->getAllCommandes($mail);
echo "\n--- Commandes ---\n";
print_r($cmd);

$info = $m->getAllInformationCompte($mail);
echo "\n--- Infos ---\n";
print_r($info);