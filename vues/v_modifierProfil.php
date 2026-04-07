
<div id="contenu">
    <h2>Modifier mes informations</h2>
    <form action="index.php?uc=espaceClient&action=confirmerModif" method="post">
        <p>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nomCli" value="<?php echo $lesInfos['nomCli']; ?>" required>
        </p>
        <p>
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenomCli" value="<?php echo $lesInfos['prenomCli']; ?>" required>
        </p>
        <p>
            <strong>Mail :</strong> <?php echo $lesInfos['mail']; ?> (non modifiable)
        </p>
        <p>
            <strong>Mot de passe :</strong>  <input type="password" id="mdp" name="password" value="<?php echo $lesInfos['password']; ?>" required>
        </p>
        
        <input type="submit" value="Enregistrer les modifications">
        <a href="index.php?uc=espaceClient">Annuler</a>
    </form>
</div>