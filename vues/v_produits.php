<div id="produits">
    <?php if (isset($_SESSION['message_produit'])): ?>
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert" style="margin-bottom: 20px; width: 100%;">
            <i class="bi bi-check-circle-fill me-2"></i><?= htmlspecialchars($_SESSION['message_produit']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['message_produit']); ?>
    <?php endif; ?>
	<?php
	echo "<h2>$titreCategorie</h2>";
	?>
    <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-body bg-white rounded-4">
            <form action="index.php" method="GET" class="row g-3 align-items-center">
                <input type="hidden" name="uc" value="voirProduits">
                <input type="hidden" name="action" value="<?= isset($_GET['action']) ? htmlspecialchars($_GET['action']) : 'nosProduits' ?>">
                <?php if (isset($_GET['categorie'])): ?>
                <input type="hidden" name="categorie" value="<?= htmlspecialchars($_GET['categorie']) ?>">
                <?php endif; ?>
                
                <?php if (isset($_SESSION['idHab']) && $_SESSION['idHab'] == 1): ?>
                <div class="col-auto">
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" role="switch" id="dispo_only" name="dispo_only" value="1" <?= isset($_GET['dispo_only']) && $_GET['dispo_only'] == '1' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="dispo_only">Produits disponibles</label>
                    </div>
                </div>
                <?php endif; ?>

                <div class="col-auto">
                    <input type="number" step="0.01" class="form-control form-control-sm" id="prix_min" name="prix_min" placeholder="Prix Min" value="<?= isset($_GET['prix_min']) ? htmlspecialchars($_GET['prix_min']) : '' ?>" style="width: 100px;">
                </div>

                <div class="col-auto">
                    <input type="number" step="0.01" class="form-control form-control-sm" id="prix_max" name="prix_max" placeholder="Prix Max" value="<?= isset($_GET['prix_max']) ? htmlspecialchars($_GET['prix_max']) : '' ?>" style="width: 100px;">
                </div>

                <div class="col-auto">
                    <select class="form-select form-select-sm" id="marque" name="marque" style="width: 150px;">
                        <option value="">Toutes marques</option>
                        <?php if(isset($lesMarques) && is_array($lesMarques)): foreach($lesMarques as $uneMarque): ?>
                            <option value="<?= $uneMarque->idMarque ?>" <?= isset($_GET['marque']) && $_GET['marque'] == $uneMarque->idMarque ? 'selected' : '' ?>>
                                <?= htmlspecialchars($uneMarque->libelleMarque) ?>
                            </option>
                        <?php endforeach; endif; ?>
                    </select>
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
                    <?php 
                        $resetUrl = "index.php?uc=voirProduits&action=" . (isset($_GET['action']) ? $_GET['action'] : 'nosProduits');
                        if (isset($_GET['categorie'])) {
                            $resetUrl .= "&categorie=" . $_GET['categorie'];
                        }
                    ?>
                    <a href="<?= $resetUrl ?>" class="btn btn-sm btn-outline-secondary">Réinitialiser</a>
                </div>
            </form>
        </div>
    </div>
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
			<div class="card-footer" style="display: flex; flex-direction: column; gap: 12px; padding-top: 15px;">
				<div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
					<div class="price-box" style="margin: 0;">
						<span class="price-label" style="display: block; font-size: 0.85em; color: #6c757d;">À partir de</span>
						<span class="prixCard" style="font-weight: bold; font-size: 1.1em; color: #198754;"><?= $prix . "€" ?></span>
					</div>
					<?php if ($unProduit->stockProd > 0): ?>
						<div class="stock-label" style="color: green; font-weight: 500;">En Stock</div>
					<?php else: ?>
						<div class="stock-label" style="color: red; font-weight: bold; text-align: right;">En rupture<br>de stock</div>
					<?php endif; ?>
				</div>
				
				<div style="display: flex; gap: 10px; width: 100%;">
					<a href="index.php?uc=voirProduits&action=voirDetails&id=<?= $id ?>" class="btn-voir-card" style="flex: 1; text-align: center; padding: 6px 0;">Voir</a>
					
					<?php if ($unProduit->stockProd > 0): ?>
						<a href="index.php?uc=gererPanier&produit=<?= $id ?>&action=ajouterAuPanier" class="btn-voir-card" style="flex: 1; text-align: center; padding: 6px 0; background-color: #198754; color: white; border: 1px solid #198754;">Ajouter</a>
					<?php else: ?>
						<button class="btn-voir-card" disabled style="flex: 1; text-align: center; padding: 6px 0; background-color: #ccc; color: white; border: 1px solid #ccc; cursor: not-allowed;">Ajouter</button>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
	}
	?>
	</div>