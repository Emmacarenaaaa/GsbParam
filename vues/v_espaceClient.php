<div class="container mt-4 mb-5" style="max-width: 1000px;">
    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs justify-content-center mb-4" id="profilTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link text-success fw-bold bg-transparent border-0 px-4 py-3" id="infos-tab" data-bs-toggle="tab" data-bs-target="#infos" type="button" role="tab" style="font-size: 1.1rem; <?php echo !isset($_GET['tab']) || $_GET['tab'] == 'infos' ? 'border-bottom: 3px solid #198754 !important; color: #198754 !important;' : 'color: #6c757d !important;'; ?>">Mes informations</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link text-success fw-bold bg-transparent border-0 px-4 py-3" id="commandes-tab" data-bs-toggle="tab" data-bs-target="#commandes" type="button" role="tab" style="font-size: 1.1rem; <?php echo isset($_GET['tab']) && $_GET['tab'] == 'commandes' ? 'border-bottom: 3px solid #198754 !important; color: #198754 !important;' : 'color: #6c757d !important;'; ?>">Mes commandes</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link text-success fw-bold bg-transparent border-0 px-4 py-3" id="avis-tab" data-bs-toggle="tab" data-bs-target="#avis" type="button" role="tab" style="font-size: 1.1rem; <?php echo isset($_GET['tab']) && $_GET['tab'] == 'avis' ? 'border-bottom: 3px solid #198754 !important; color: #198754 !important;' : 'color: #6c757d !important;'; ?>">Mes avis</button>
        </li>
    </ul>

    <!-- Tabs Content -->
    <div class="tab-content" id="profilTabsContent">
        
        <!-- Tab: Mes informations -->
        <div class="tab-pane fade <?php echo !isset($_GET['tab']) || $_GET['tab'] == 'infos' ? 'show active' : ''; ?>" id="infos" role="tabpanel" tabindex="0">
            <div class="card shadow-sm border-0 rounded-4 mx-auto" style="max-width: 600px;">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4 text-center">Vos coordonnées</h4>
                    <?php if ($lesInfos): ?>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted">Nom</div>
                            <div class="col-sm-8 fw-semibold"><?php echo htmlspecialchars($lesInfos['nomCli']); ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted">Prénom</div>
                            <div class="col-sm-8 fw-semibold"><?php echo htmlspecialchars($lesInfos['prenomCli']); ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted">Email</div>
                            <div class="col-sm-8 fw-semibold"><?php echo htmlspecialchars($lesInfos['mail']); ?></div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-4 text-muted">Mot de passe</div>
                            <div class="col-sm-8 fw-semibold">********</div>
                        </div>
                    <?php endif; ?>
                    <div class="text-center">
                        <a href="index.php?uc=espaceClient&action=modifierProfil" class="btn btn-outline-success rounded-pill px-4">Modifier mes informations</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab: Mes commandes -->
        <div class="tab-pane fade <?php echo isset($_GET['tab']) && $_GET['tab'] == 'commandes' ? 'show active' : ''; ?>" id="commandes" role="tabpanel" tabindex="0">
            <?php if (isset($lesCommandes) && is_array($lesCommandes) && !empty($lesCommandes)): ?>
                <?php foreach($lesCommandes as $uneCommande): ?>
                    <div class="mb-5">
                        <h4 class="text-center mb-3" style="color: #495057;">
                            Commande du <?php echo date('d/m/Y', strtotime($uneCommande['dateCommande'])); ?> d'un montant de <?php echo htmlspecialchars($uneCommande['montant']); ?>€
                        </h4>
                        <div class="card shadow-sm border-0 rounded-4">
                            <div class="card-body p-4">
                                <div class="row">
                                    <?php if(isset($uneCommande['lignes']) && !empty($uneCommande['lignes'])): ?>
                                        <?php foreach($uneCommande['lignes'] as $ligne): ?>
                                            <div class="col-md-6 mb-3 d-flex align-items-center">
                                                <img src="<?php echo htmlspecialchars($ligne->imageProd); ?>" alt="Produit" class="me-3" style="width: 80px; height: 80px; object-fit: contain;">
                                                <div>
                                                    <div class="text-muted small"><?php echo htmlspecialchars($ligne->libelleMarque); ?></div>
                                                    <div class="fw-semibold text-dark"><?php echo htmlspecialchars($ligne->nomProd); ?></div>
                                                    <div class="text-muted small"><?php echo htmlspecialchars($ligne->contenanceProd . ' ' . $ligne->uniteProd); ?></div>
                                                    <div class="fw-bold mt-1"><?php echo htmlspecialchars($ligne->prixProd); ?>€</div>
                                                    <div class="text-muted small">quantité : <?php echo htmlspecialchars($ligne->quantite); ?></div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="col-12 text-center text-muted">Détails de la commande non disponibles.</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="card-footer bg-light text-end py-2 rounded-bottom-4 border-0">
                                <span class="badge bg-success px-3 py-2 rounded-pill"><?php echo htmlspecialchars($uneCommande['etat']); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center py-5 bg-light rounded-4">
                    <i class="bi bi-box-seam fs-1 text-muted mb-3 d-block"></i>
                    <p class="text-muted mb-0">Vous n'avez passé aucune commande pour le moment.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Tab: Mes avis -->
        <div class="tab-pane fade <?php echo isset($_GET['tab']) && $_GET['tab'] == 'avis' ? 'show active' : ''; ?>" id="avis" role="tabpanel" tabindex="0">
            <div class="row">
                <?php if (isset($lesAvis) && !empty($lesAvis)): ?>
                    <?php foreach($lesAvis as $unAvis): ?>
                        <div class="col-md-6 mb-3">
                            <div class="card shadow-sm border-0 rounded-4 h-100">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <?php if (!empty($unAvis->imageProd)): ?>
                                            <img src="<?= htmlspecialchars($unAvis->imageProd) ?>" alt="Produit" style="width: 60px; height: 60px; object-fit: contain;" class="me-3">
                                        <?php endif; ?>
                                        <div>
                                            <h6 class="mb-0 fw-bold"><a href="index.php?uc=voirProduits&action=voirDetails&id=<?= htmlspecialchars($unAvis->idProd) ?>" class="text-decoration-none text-dark"><?= htmlspecialchars($unAvis->nomProd) ?></a></h6>
                                            <small class="text-muted">Publié le <?= date('d/m/Y', strtotime($unAvis->date_avis)) ?></small>
                                        </div>
                                    </div>
                                    <div class="mb-2 text-warning" style="font-size: 1.1rem;">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <?php if ($i <= $unAvis->note): ?>
                                                <i class="bi bi-star-fill"></i>
                                            <?php else: ?>
                                                <i class="bi bi-star"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <span class="text-dark ms-2 fw-bold" style="font-size: 0.9rem;"><?= $unAvis->note ?>/5</span>
                                    </div>
                                    <?php if (!empty($unAvis->description)): ?>
                                        <p class="card-text text-muted small mb-0 mt-2">"<?= nl2br(htmlspecialchars($unAvis->description)) ?>"</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center py-5 bg-light rounded-4">
                        <i class="bi bi-chat-left-text fs-1 text-muted mb-3 d-block"></i>
                        <p class="text-muted mb-0">Vous n'avez pas encore laissé d'avis sur nos produits.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    // Script pour changer l'apparence des onglets au clic
    document.addEventListener("DOMContentLoaded", function() {
        const tabs = document.querySelectorAll('#profilTabs .nav-link');
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                tabs.forEach(t => {
                    t.style.borderBottom = 'none';
                    t.style.color = '#6c757d';
                    t.style.setProperty('color', '#6c757d', 'important');
                });
                this.style.borderBottom = '3px solid #198754';
                this.style.setProperty('color', '#198754', 'important');
                this.style.setProperty('border-bottom', '3px solid #198754', 'important');
            });
        });
    });
</script>