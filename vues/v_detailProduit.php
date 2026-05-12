<div class="detail-container">
    <?php if (isset($_SESSION['message_produit'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert"
            style="width: 100%; grid-column: 1 / -1; margin-bottom: 20px;">
            <i class="bi bi-check-circle-fill me-2"></i><?= htmlspecialchars($_SESSION['message_produit']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['message_produit']); ?>
    <?php endif; ?>
    <div class="detail-left">
        <img src="<?= $unProduit['imageProd'] ?>" alt="Photo du produit">
    </div>
    <div class="detail-right">
        <div class="detail-body">
            <h2 class="detail-title"><?= $unProduit['descriptionProd'] ?></h2>

            <?php
            $nbAvis = count($lesAvis);
            $moyenne = 0;
            if ($nbAvis > 0) {
                $total = 0;
                foreach ($lesAvis as $avis) {
                    $total += $avis->note;
                }
                $moyenne = round($total / $nbAvis, 1);
            }
            ?>
            <div class="mb-3 d-flex align-items-center">
                <?php if ($nbAvis > 0): ?>
                    <div class="text-warning me-2" style="font-size: 0.9rem;">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <?php if ($i <= round($moyenne)): ?>
                                <i class="bi bi-star-fill"></i>
                            <?php else: ?>
                                <i class="bi bi-star"></i>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                    <span class="text-muted small me-3"><?= $nbAvis ?> avis</span>
                <?php endif; ?>
                <a href="#section-avis" class="text-decoration-none small text-success">Donner un avis</a>
            </div>

            <p class="detail-subtitle">Produit de la catégorie <?= $unProduit['libelleCat'] ?></p>

            <hr class="detail-divider">

            <div class="detail-contenance">
                <label>Contenance :</label>
                <select class="select-box">
                    <option>
                        <?= htmlspecialchars($unProduit['contenanceProd'] ?? '') . ' ' . htmlspecialchars($unProduit['uniteProd'] ?? '') ?>
                    </option>
                </select>
            </div>

            <div class="detail-price-stock">
                <span class="detail-price"><?= $unProduit['prixProd'] ?>€</span>
                <?php if ($unProduit['stockProd'] > 0): ?>
                    <span class="detail-stock" style="color: green;">- En Stock <span class="stock-count">(plus que
                            <?= $unProduit['stockProd'] ?>)</span></span>
                <?php else: ?>
                    <span class="detail-stock" style="color: red; font-weight: bold;">- En rupture de stock</span>
                <?php endif; ?>
            </div>

            <div class="detail-actions">
                <select class="select-box qty-box" <?= $unProduit['stockProd'] == 0 ? 'disabled' : '' ?>>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
                <?php if ($unProduit['stockProd'] > 0): ?>
                    <a href="index.php?uc=gererPanier&produit=<?= $unProduit['idProd'] ?>&action=ajouterAuPanier"
                        class="btn-ajouter">Ajouter au panier</a>
                <?php else: ?>
                    <button class="btn-ajouter" disabled
                        style="background-color: #ccc; cursor: not-allowed; border: none; color: white; display: inline-block; text-align: center;">Ajouter
                        au panier</button>
                <?php endif; ?>
            </div>
        </div>
        <div class="detail-footer">
            <a href="index.php?uc=voirProduits&action=voirCategories" class="btn-retour">Retour</a>
            <?php if (isset($_SESSION['idHab']) && $_SESSION['idHab'] == 1): ?>
                <a href="index.php?uc=administration&action=afficherModifierProduit&idProd=<?= $unProduit['idProd'] ?>"
                    class="btn-retour" style="background-color: #ffc107; color: black; margin-left: 10px;">Modifier</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Section Avis Clients -->
<div id="section-avis" class="container mt-5 mb-5" style="max-width: 900px; margin: 0 auto; padding: 20px;">
    <h3 class="fw-bold mb-4 border-bottom pb-2">Avis clients</h3>

    <?php if (isset($_SESSION['message_avis'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i><?= htmlspecialchars($_SESSION['message_avis']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['message_avis']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['erreur_avis'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i><?= htmlspecialchars($_SESSION['erreur_avis']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['erreur_avis']); ?>
    <?php endif; ?>

    <!-- Laisser un avis -->
    <div class="card shadow-sm border-0 rounded-4 mb-5">
        <div class="card-body p-4 bg-light rounded-4">
            <h5 class="fw-bold mb-3">Laisser un avis</h5>
            <?php if (!isset($_SESSION['idUser'])): ?>
                <p class="text-muted mb-0">Veuillez vous <a href="index.php?uc=connexion">connecter</a> pour laisser un avis
                    sur ce produit.</p>
            <?php elseif ($aDejaAvis): ?>
                <p class="text-success fw-bold mb-0"><i class="bi bi-check-circle-fill me-2"></i>Vous avez déjà donné votre
                    avis sur ce produit.</p>
            <?php else: ?>
                <form action="index.php?uc=voirProduits&action=ajouterAvis" method="POST">
                    <input type="hidden" name="idProd" value="<?= htmlspecialchars($unProduit['idProd']) ?>">

                    <div class="mb-3">
                        <label class="form-label fw-bold small">Note <span class="text-danger">*</span></label>
                        <div class="d-flex" id="star-rating">
                            <i class="bi bi-star fs-4 text-warning me-1 star-btn" data-value="1"
                                style="cursor: pointer;"></i>
                            <i class="bi bi-star fs-4 text-warning me-1 star-btn" data-value="2"
                                style="cursor: pointer;"></i>
                            <i class="bi bi-star fs-4 text-warning me-1 star-btn" data-value="3"
                                style="cursor: pointer;"></i>
                            <i class="bi bi-star fs-4 text-warning me-1 star-btn" data-value="4"
                                style="cursor: pointer;"></i>
                            <i class="bi bi-star fs-4 text-warning me-1 star-btn" data-value="5"
                                style="cursor: pointer;"></i>
                        </div>
                        <input type="hidden" name="note" id="note-input" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold small">Commentaire (optionnel)</label>
                        <textarea class="form-control" id="description" name="description" rows="3"
                            placeholder="Partagez votre expérience avec ce produit..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-success px-4 rounded-pill">Publier mon avis</button>
                </form>

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const stars = document.querySelectorAll(".star-btn");
                        const noteInput = document.getElementById("note-input");
                        const container = document.getElementById("star-rating");

                        stars.forEach(star => {
                            star.addEventListener("click", function () {
                                let value = this.getAttribute("data-value");
                                noteInput.value = value;
                                updateStars(value);
                            });

                            star.addEventListener("mouseover", function () {
                                let value = this.getAttribute("data-value");
                                updateStars(value);
                            });
                        });

                        container.addEventListener("mouseout", function () {
                            let value = noteInput.value || 0;
                            updateStars(value);
                        });

                        function updateStars(value) {
                            stars.forEach(s => {
                                if (s.getAttribute("data-value") <= value) {
                                    s.classList.remove("bi-star");
                                    s.classList.add("bi-star-fill");
                                } else {
                                    s.classList.remove("bi-star-fill");
                                    s.classList.add("bi-star");
                                }
                            });
                        }
                    });
                </script>
            <?php endif; ?>
        </div>
    </div>

    <!-- Liste des avis -->
    <div>
        <?php if (empty($lesAvis)): ?>
            <div class="text-center py-4 bg-light rounded-4 border-0">
                <p class="text-muted mb-0">Le produit n'a reçu aucun avis pour le moment. Soyez le premier !</p>
            </div>
        <?php else: ?>
            <?php foreach ($lesAvis as $unAvis): ?>
                <div class="card shadow-sm border-0 rounded-4 mb-3">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="fw-bold mb-0">
                                <?= htmlspecialchars($unAvis->prenomUser . ' ' . substr($unAvis->nomUser, 0, 1) . '.') ?></h6>
                            <span
                                class="badge <?= $unAvis->note >= 4 ? 'bg-success' : ($unAvis->note == 3 ? 'bg-warning text-dark' : 'bg-danger') ?>">
                                <?= htmlspecialchars($unAvis->note) ?>/5 <i class="bi bi-star-fill"></i>
                            </span>
                        </div>
                        <div class="text-muted small mb-2">
                            Publié le <?= date('d/m/Y à H:i', strtotime($unAvis->date_avis)) ?>
                        </div>
                        <?php if (!empty($unAvis->description)): ?>
                            <p class="mb-0 text-dark"><?= nl2br(htmlspecialchars($unAvis->description)) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>