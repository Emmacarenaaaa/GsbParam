<div class="detail-container">
    <div class="detail-left">
        <img src="<?= $unProduit['imageProd'] ?>" alt="Photo du produit">
    </div>
    <div class="detail-right">
        <div class="detail-body">
            <h2 class="detail-title"><?= $unProduit['descriptionProd'] ?></h2>
            <p class="detail-subtitle">Produit de la catégorie <?= $unProduit['libelleCat'] ?></p>
            
            <hr class="detail-divider">
            
            <div class="detail-contenance">
                <label>Contenance :</label>
                <select class="select-box">
                    <option>Standard</option>
                </select>
            </div>
            
            <div class="detail-price-stock">
                <span class="detail-price"><?= $unProduit['prixProd'] ?>€</span>
                <span class="detail-stock">- En Stock <span class="stock-count">(plus que <?= $unProduit['stockProd'] ?>)</span></span>
            </div>
            
            <div class="detail-actions">
                <select class="select-box qty-box">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
                <!-- Assuming adding to cart via link -->
                <a href="index.php?uc=gererPanier&produit=<?= $unProduit['idProd'] ?>&action=ajouterAuPanier" class="btn-ajouter">Ajouter au panier</a>
            </div>
        </div>
        <div class="detail-footer">
            <a href="index.php?uc=voirProduits&action=voirCategories" class="btn-retour">Retour</a>
        </div>
    </div>
</div>