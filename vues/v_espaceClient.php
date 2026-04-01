<ul id="infosClient">
    <?php if ($lesInfos): ?>
        <li><strong>Nom :</strong> <?php echo $lesInfos['nomCli']; ?></li>
        <li><strong>Prenom :</strong> <?php echo $lesInfos['prenomCli']; ?></li>
        <li><strong>Mail :</strong> <?php echo $lesInfos['mail']; ?></li>
        <li><strong>Mot de passe :</strong> <?php echo $lesInfos['password']; ?></li>
        
    

    <?php endif; ?>
    <form action="index.php?uc=espaceClient&action=seDeconnecter" method="post" style="display:inline;">
    <button type="submit" class="btn-deconnexion">Déconnexion</button>
</form>
</ul>