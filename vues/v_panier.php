<div class="cart-page-title">Mon Panier</div>

<div class="cart-layout">
	<div class="cart-items-container">
		<?php
		$total = 0;
		$produitsGroupes = [];
		
		// Regrouper les produits pour calculer les quantités
		foreach ($lesProduitsDuPanier as $unProduit) {
			$id = $unProduit->idProd;
			if (isset($produitsGroupes[$id])) {
				$produitsGroupes[$id]['quantite'] += 1;
			} else {
				$produitsGroupes[$id] = [
					'produit' => $unProduit,
					'quantite' => 1
				];
			}
		}

		foreach ($produitsGroupes as $item) {
			$unProduit = $item['produit'];
			$quantite = $item['quantite'];
			$id = $unProduit->idProd;
			$description = $unProduit->descriptionProd;
			$image = $unProduit->imageProd;
			$prix = $unProduit->prixProd;
			$total += floatval($prix) * $quantite;
			?>
			<div class="cart-item-card">
				<div class="cart-item-img">
					<img src="<?= $image ?>" alt="image descriptive" />
				</div>
				<div class="cart-item-info">
					<div class="cart-item-brand">GsbParam</div>
					<div class="cart-item-title"><?= $description ?></div>
					<div class="cart-item-desc">Produit de notre gamme de parapharmacie.</div>
					
					<div class="cart-item-price-row">
						<span class="cart-item-price"><?= number_format(floatval($prix) * $quantite, 2, '.', '') . "€" ?></span>
						<span class="cart-item-volume"><?= $prix ?> € à l'unité</span>
					</div>
					
					<div class="cart-item-qty">
						<label>Quantité :</label>
						<select class="cart-select" disabled>
							<option><?= $quantite ?></option>
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