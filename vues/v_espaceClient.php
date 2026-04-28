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
            <th>Montant</th>
            <th>État de la commande</th>
        </tr>
    </thead>
    <tbody>
        <?php if (isset($lesCommandes) && is_array($lesCommandes) && !empty($lesCommandes)): ?>
            <?php foreach($lesCommandes as $uneCommande): ?>
                <tr>
                    <td><?php echo htmlspecialchars($uneCommande['id']); ?></td>
                    <td><?php echo htmlspecialchars($uneCommande['dateCommande']); ?></td>
                    <td><?php echo htmlspecialchars($uneCommande['montant']); ?> €</td>
                    <td><?php echo htmlspecialchars($uneCommande['etat']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4">Aucune commande trouvée.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

    <form action="index.php?uc=espaceClient&action=seDeconnecter" method="post" style="display:inline;">
    <button type="submit" class="btn-deconnexion">Déconnexion</button>
</form>
</ul>