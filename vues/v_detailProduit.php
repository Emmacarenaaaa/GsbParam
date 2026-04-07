<div id="detail-produit">
    <h2>Détails du produit</h2>
    <img src="<?= $unProduit['imageProd'] ?>" alt="Photo du produit">
    <p><strong>Description :</strong> <?= $unProduit['descriptionProd'] ?></p>
    <p><strong>Prix :</strong> <?= $unProduit['prixProd'] ?> €</p>
    <p><strong>Categorie :</strong> <?= $unProduit['libelleCat'] ?> </p>
    <p><strong>Stock :</strong> <?= $unProduit['stockProd'] ?></p>

    
    <a href="index.php?uc=voirProduits&action=voirCategories">Retour à la liste</a>
</div>