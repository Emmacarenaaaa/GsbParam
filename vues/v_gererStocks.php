<section class="py-5 bg-light" id="admin-stocks">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="m-0">Gestion des stocks</h2>
            <a href="index.php?uc=administration" class="btn btn-outline-secondary">Retour à l'administration</a>
        </div>
        
        <?php if (isset($_SESSION['message_stock'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i><?= htmlspecialchars($_SESSION['message_stock']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['message_stock']); ?>
        <?php endif; ?>
        
        <div class="card shadow-sm border-0 rounded-4 mb-4">
            <div class="card-body bg-white rounded-4">
                <form action="index.php" method="GET" class="row g-3 align-items-center">
                    <input type="hidden" name="uc" value="administration">
                    <input type="hidden" name="action" value="gererStocks">
                    
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
        
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">ID</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Catégorie</th>
                                <th>Prix</th>
                                <th>Stock actuel</th>
                                <th class="pe-4 text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lesProduits as $unProduit): ?>
                            <tr>
                                <td class="ps-4"><?= htmlspecialchars($unProduit->idProd) ?></td>
                                <td>
                                    <img src="<?= htmlspecialchars($unProduit->imageProd) ?>" alt="<?= htmlspecialchars($unProduit->descriptionProd) ?>" style="width: 50px; height: 50px; object-fit: cover;" class="rounded">
                                </td>
                                <td><?= htmlspecialchars($unProduit->descriptionProd) ?></td>
                                <td><?= htmlspecialchars($unProduit->idCat) ?></td>
                                <td><?= htmlspecialchars($unProduit->prixProd) ?> €</td>
                                <td>
                                    <form action="index.php?uc=administration&action=majStock" method="POST" class="d-flex align-items-center justify-content-end">
                                        <input type="hidden" name="idProd" value="<?= htmlspecialchars($unProduit->idProd) ?>">
                                        <input type="number" name="stockProd" value="<?= htmlspecialchars($unProduit->stockProd) ?>" class="form-control form-control-sm text-center me-2" style="width: 80px;" min="0">
                                </td>
                                <td class="pe-4 text-end">
                                        <button type="submit" class="btn btn-sm btn-success rounded-pill px-3">Enregistrer</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
