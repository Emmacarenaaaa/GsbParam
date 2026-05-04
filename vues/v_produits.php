<div id="produits">
	<?php
	echo "<h2>$titreCategorie</h2>";

	foreach ($lesProduits as $unProduit) {
		$id = $unProduit->idProd;
		$description = $unProduit->descriptionProd;
		$image = $unProduit->imageProd;
		$prix = $unProduit->prixProd;
		?>
		<div id="card">
			<div class="card-header">
				<div class="card-brand">Klorane</div>
				<div class="card-title"><?= $description ?></div>
			</div>
			<div class="photoCard"><img src="<?= $image ?>" alt="image" /></div>
			<div class="card-footer">
				<div class="price-box">
					<span class="price-label">À partir de</span>
					<span class="prixCard"><?= $prix . "€" ?></span>
				</div>
				<div class="stock-label">En Stock</div>
				<a href="index.php?uc=voirProduits&action=voirDetails&id=<?= $id ?>" class="btn-voir-card">Voir</a>
				
				<!-- Hidden add to cart icon to keep functionality if needed elsewhere -->
				<a href="index.php?uc=gererPanier&produit=<?= $id ?>&action=ajouterAuPanier" style="display:none;">Ajouter</a>
			</div>
		</div>
		<?php
	}
	?>
	</div>