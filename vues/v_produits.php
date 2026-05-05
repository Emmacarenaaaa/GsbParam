<div id="produits">
	<?php
	echo "<h2>$titreCategorie</h2>";
	?>
	<?php if (isset($_SESSION['idHab']) && $_SESSION['idHab'] == 1): ?>
        <div class="card shadow-sm border-0 rounded-4 mb-4">
            <div class="card-body bg-white rounded-4">
                <form action="index.php" method="GET" class="row g-3 align-items-center">
                    <input type="hidden" name="uc" value="voirProduits">
                    <input type="hidden" name="action" value="nosProduits">
                    
                    <div class="col-auto">
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" role="switch" id="dispo_only" name="dispo_only" value="1" <?= isset($_GET['dispo_only']) && $_GET['dispo_only'] == '1' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="dispo_only">Produits disponibles uniquement</label>
                        </div>
                    </div>
                    
                    <div class="col-auto ms-auto d-flex align-items-center">
                        <label for="sort" class="me-2 text-nowrap">Trier par :</label>
                        <select class="form-select form-select-sm" id="sort" name="sort" onchange="this.form.submit()">
                            <option value="id_asc" <?= (!isset($_GET['sort']) || $_GET['sort'] == 'id_asc') ? 'selected' : '' ?>>Par défaut</option>
                            <option value="stock_asc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'stock_asc') ? 'selected' : '' ?>>Stock (Croissant)</option>
                            <option value="stock_desc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'stock_desc') ? 'selected' : '' ?>>Stock (Décroissant)</option>
                        </select>
                    </div>
                    
                    <div class="col-auto">
                        <button type="submit" class="btn btn-sm btn-outline-success">Filtrer</button>
                    </div>
                </form>
            </div>
        </div>
	<?php endif; ?>
	<?php

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
				<?php if ($unProduit->stockProd > 0): ?>
					<div class="stock-label" style="color: green;">En Stock</div>
				<?php else: ?>
					<div class="stock-label" style="color: red; font-weight: bold;">En rupture de stock</div>
				<?php endif; ?>
				
				<a href="index.php?uc=voirProduits&action=voirDetails&id=<?= $id ?>" class="btn-voir-card">Voir</a>
				
				<!-- Hidden add to cart icon to keep functionality if needed elsewhere -->
				<?php if ($unProduit->stockProd > 0): ?>
					<a href="index.php?uc=gererPanier&produit=<?= $id ?>&action=ajouterAuPanier" style="display:none;">Ajouter</a>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
	?>
	</div>