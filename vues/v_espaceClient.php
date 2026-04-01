<ul id="infosClient">
    <?php if ($lesInfos): ?>
        <li><strong>Nom :</strong> <?php echo $lesInfos['nomCli']; ?></li>
        <li><strong>Prenom :</strong> <?php echo $lesInfos['prenomCli']; ?></li>
        <li><strong>Mail :</strong> <?php echo $lesInfos['mail']; ?></li>
        <li><strong>Mot de passe :</strong> <?php echo $lesInfos['password']; ?></li>
    <?php endif; ?>
    <a href="index.php?uc=espaceClient&action=modifierProfil" class="btn">Modifier mes informations</a>

    <h3>Historique de vos commandes</h3>
    <table class="table">
    <thead>
        <tr>
            <th>Numéro</th>
            <th>Date</th>
            <th>Nom Prenom</th>
            <th>Ville</th>
            <th>Adresse</th>
            <th>Code Postal</th>
        </tr>
    </thead>
    <tbody>
        <?php if (isset($lesCommandes) && is_array($lesCommandes)): ?>
            <?php foreach($lesCommandes as $uneCommande): ?>
                <tr>
                    <td><?php echo $uneCommande['id']; ?></td>
                    <td><?php echo $uneCommande['dateCommande']; ?></td>
                    <td><?php echo $uneCommande['nomPrenomClient']; ?></td>
                    <td><?php echo $uneCommande['villeClient']; ?></td>
                    <td><?php echo $uneCommande['adresseRueClient']; ?></td>
                    <td><?php echo $uneCommande['cpClient']; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6">Aucune commande trouvée.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

    <form action="index.php?uc=espaceClient&action=seDeconnecter" method="post" style="display:inline;">
    <button type="submit" class="btn-deconnexion">Déconnexion</button>
</form>
</ul>