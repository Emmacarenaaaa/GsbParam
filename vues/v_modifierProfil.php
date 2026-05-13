<div id="contenu">
    <!-- Titre de la page -->
    <h2>Modifier mes informations</h2>
    
    <!-- Formulaire d'édition du profil, envoie les données vers le contrôleur Espace Client, action confirmerModif -->
    <form action="index.php?uc=espaceClient&action=confirmerModif" method="post">
        
        <!-- Champ pour modifier le nom -->
        <p>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nomCli" value="<?php echo $lesInfos['nomCli']; ?>" required>
        </p>
        
        <!-- Champ pour modifier le prénom -->
        <p>
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenomCli" value="<?php echo $lesInfos['prenomCli']; ?>" required>
        </p>
        
        <!-- Affichage de l'adresse mail en lecture seule (non modifiable) -->
        <p>
            <strong>Mail :</strong> <?php echo $lesInfos['mail']; ?> (non modifiable)
        </p>
        
        <!-- Champ pour modifier le mot de passe -->
        <p>
            <strong>Mot de passe :</strong> <input type="password" id="mdp" name="password"
                value="<?php echo $lesInfos['password']; ?>" required>
        </p>

        <!-- Boutons d'action -->
        <input type="submit" value="Enregistrer les modifications">
        <!-- Lien pour annuler et revenir au profil -->
        <a href="index.php?uc=espaceClient">Annuler</a>
    </form>
</div>