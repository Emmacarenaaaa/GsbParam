<section class="py-5 bg-white" id="admin-modifier-produit">
    <div class="container mt-4" style="max-width: 900px;">
        <p class="text-danger small mb-1">* Champ(s) facultatif(s)</p>
        
        <div class="text-center mb-4">
            <h2 class="fw-bold text-dark" style="font-size: 1.8rem;">Éditer un produit</h2>
            <p class="text-dark" style="font-size: 1.1rem;">Produit <u>N°<?= htmlspecialchars($unProduit['idProd']) ?></u></p>
            
            <div class="mt-3 mb-4">
                <img src="<?= htmlspecialchars($unProduit['imageProd']) ?>" alt="Photo du produit" style="max-height: 120px; object-fit: contain;">
            </div>
        </div>
        
        <form action="index.php?uc=administration&action=sauvegarderModificationProduit" method="POST">
            <input type="hidden" name="idProd" value="<?= htmlspecialchars($unProduit['idProd']) ?>">
            
            <!-- We add a custom layout with a vertical divider -->
            <div class="row">
                <!-- Left Column -->
                <div class="col-md-6 pe-md-5 border-end" style="border-right-color: rgba(0,0,0,0.1) !important;">
                    <div class="mb-4">
                        <label for="nomProd" class="form-label text-secondary small mb-1">Nom du produit</label>
                        <input type="text" class="form-control text-muted" id="nomProd" name="nomProd" value="<?= htmlspecialchars($unProduit['nomProd'] ?? '') ?>" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="descriptionProd" class="form-label text-secondary small mb-1">Description du produit</label>
                        <input type="text" class="form-control text-muted" id="descriptionProd" name="descriptionProd" value="<?= htmlspecialchars($unProduit['descriptionProd'] ?? '') ?>" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="idMarque" class="form-label text-secondary small mb-1">Marque du produit</label>
                        <select class="form-select text-muted" id="idMarque" name="idMarque" required>
                            <?php foreach ($lesMarques as $uneMarque): ?>
                                <option value="<?= htmlspecialchars($uneMarque->idMarque) ?>" <?= ($unProduit['idMarque'] == $uneMarque->idMarque) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($uneMarque->libelleMarque) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <!-- Right Column -->
                <div class="col-md-6 ps-md-5">
                    <div class="mb-4">
                        <label for="idCat" class="form-label text-secondary small mb-1">Catégorie du produit</label>
                        <select class="form-select text-muted" id="idCat" name="idCat" required>
                            <?php foreach ($lesCategories as $uneCategorie): ?>
                                <option value="<?= htmlspecialchars($uneCategorie->idCat) ?>" <?= ($unProduit['idCat'] == $uneCategorie->idCat) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($uneCategorie->libelleCat) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-6">
                            <label for="prixProd" class="form-label text-secondary small mb-1">Prix du produit</label>
                            <div class="input-group">
                                <input type="number" step="0.01" class="form-control text-muted text-end" id="prixProd" name="prixProd" value="<?= htmlspecialchars($unProduit['prixProd'] ?? '') ?>" required>
                                <span class="input-group-text bg-light text-muted">€</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="stockProd" class="form-label text-secondary small mb-1">Stock <span class="text-danger">*</span></label>
                            <input type="number" class="form-control text-muted" id="stockProd" name="stockProd" value="<?= htmlspecialchars($unProduit['stockProd'] ?? '') ?>" required min="0">
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-6">
                            <label for="uniteProd" class="form-label text-secondary small mb-1">Unité</label>
                            <select class="form-select text-muted" id="uniteProd" name="uniteProd">
                                <option value="ml" <?= ($unProduit['uniteProd'] == 'ml') ? 'selected' : '' ?>>ml</option>
                                <option value="cl" <?= ($unProduit['uniteProd'] == 'cl') ? 'selected' : '' ?>>cl</option>
                                <option value="l" <?= ($unProduit['uniteProd'] == 'l') ? 'selected' : '' ?>>l</option>
                                <option value="g" <?= ($unProduit['uniteProd'] == 'g') ? 'selected' : '' ?>>g</option>
                                <option value="mg" <?= ($unProduit['uniteProd'] == 'mg') ? 'selected' : '' ?>>mg</option>
                                <option value="kg" <?= ($unProduit['uniteProd'] == 'kg') ? 'selected' : '' ?>>kg</option>
                                <option value="pièce" <?= ($unProduit['uniteProd'] == 'pièce') ? 'selected' : '' ?>>pièce</option>
                                <option value="boîte" <?= ($unProduit['uniteProd'] == 'boîte') ? 'selected' : '' ?>>boîte</option>
                                <!-- add fallback -->
                                <?php if (!in_array($unProduit['uniteProd'], ['ml', 'cl', 'l', 'g', 'mg', 'kg', 'pièce', 'boîte']) && !empty($unProduit['uniteProd'])): ?>
                                    <option value="<?= htmlspecialchars($unProduit['uniteProd']) ?>" selected><?= htmlspecialchars($unProduit['uniteProd']) ?></option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="contenanceProd" class="form-label text-secondary small mb-1">Contenance</label>
                            <input type="text" class="form-control text-muted" id="contenanceProd" name="contenanceProd" value="<?= htmlspecialchars($unProduit['contenanceProd'] ?? '') ?>">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="d-flex flex-column align-items-center mt-4">
                <button type="submit" class="btn text-white mb-3 px-5 py-2" style="background-color: #198754; width: 250px;">Modifier le produit</button>
                <a href="index.php?uc=voirProduits&action=voirDetails&id=<?= htmlspecialchars($unProduit['idProd']) ?>" class="btn text-white px-5 py-2" style="background-color: #198754; width: 250px;">Retour</a>
            </div>
        </form>
    </div>
</section>
