<div class="cart-page-title">Mon Panier</div>

<div class="cart-layout">
	<div class="cart-items-container">
		<?php
		$total = 0;
		foreach ($lesProduitsDuPanier as $unProduit) {
			$id = $unProduit->idProd;
			$description = $unProduit->descriptionProd;
			$image = $unProduit->imageProd;
			$prix = $unProduit->prixProd;
			$total += floatval($prix);
			?>
			<div class="cart-item-card">
				<div class="cart-item-img">
					<img src="<?= $image ?>" alt="image descriptive" />
				</div>
				<div class="cart-item-info">
					<div class="cart-item-brand">Klorane</div>
					<div class="cart-item-title"><?= $description ?></div>
					<div class="cart-item-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus aliquam vene...</div>
					
					<div class="cart-item-price-row">
						<span class="cart-item-price"><?= $prix . "€" ?></span>
						<span class="cart-item-volume">200 ml</span>
					</div>
					
					<div class="cart-item-qty">
						<label>Quantite :</label>
						<select class="cart-select">
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
						</select>
					</div>
					
					<div class="cart-item-actions">
						<a href="index.php?uc=voirProduits&action=voirDetails&id=<?= $id ?>" class="btn-cart-voir">Voir</a>
						<a href="index.php?uc=gererPanier&produit=<?= $id ?>&action=supprimerUnProduit" class="btn-cart-retirer" onclick="return confirm('Voulez-vous vraiment retirer cet article ?');">Retirer</a>
					</div>
				</div>
			</div>
			<?php
		}
		?>
	</div>

	<div class="cart-sidebar">
		<h3 class="cart-total-title">Total</h3>
		<div class="cart-total-row">
			<span>Sous-total</span>
			<span><?= number_format($total, 2, '.', '') ?> €</span>
		</div>
		<div class="cart-total-row">
			<span>Livraison</span>
			<span>(Gratuit) 0.00 €</span>
		</div>
		
		<hr class="cart-divider">
		
		<div class="cart-total-row cart-ttc">
			<span>Total TTC</span>
			<span><?= number_format($total, 2, '.', '') ?> €</span>
		</div>
		
		<div class="cart-sidebar-actions">
			<a href="index.php?uc=gererPanier&action=passerCommande" class="btn-cart-commander">Commander</a>
			<a href="index.php?uc=gererPanier&action=viderPanier" class="btn-cart-vider" onclick="return confirm('Voulez-vous vraiment vider tout le panier ?');">Vider le panier</a>
		</div>
	</div>
</div>