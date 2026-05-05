<section class="py-5 bg-white" id="admin-ajouter-categorie">
    <div class="container mt-4" style="max-width: 600px;">
        
        <?php if (isset($_SESSION['erreur_categorie'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i><?= htmlspecialchars($_SESSION['erreur_categorie']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['erreur_categorie']); ?>
        <?php endif; ?>

        <div class="text-center mb-4">
            <h2 class="fw-bold text-dark" style="font-size: 1.8rem;">Ajouter une catégorie</h2>
            <p class="text-muted">Veuillez saisir le nom de la nouvelle catégorie à créer.</p>
        </div>
        
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">
                <form action="index.php?uc=administration&action=sauvegarderNouvelleCategorie" method="POST">
                    
                    <div class="mb-4">
                        <label for="nomCat" class="form-label text-secondary small mb-1">Nom de la catégorie <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nomCat" name="nomCat" placeholder="Ex: Soins du visage" required>
                    </div>
                    
                    <div class="d-flex justify-content-between mt-4">
                        <a href="index.php?uc=administration" class="btn btn-secondary rounded-pill px-4">Retour</a>
                        <button type="submit" class="btn btn-success rounded-pill px-4">Créer la catégorie</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
