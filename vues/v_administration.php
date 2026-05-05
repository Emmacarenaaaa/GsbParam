<section class="py-5 bg-light h-100" id="admin">
    <div class="container px-4 px-lg-5 mt-5">
        <?php if (isset($_SESSION['message_admin'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i><?= htmlspecialchars($_SESSION['message_admin']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['message_admin']); ?>
        <?php endif; ?>
        <h2 class="text-center mb-4">Administration</h2>
        <div class="row justify-content-center">

            <div class="col-md-5 mb-4">
                <div class="card h-100 shadow-sm border-0 rounded-4">
                    <div class="card-body text-center d-flex flex-column justify-content-center align-items-center py-5">
                        <i class="bi bi-tags fs-1 text-success mb-3" style="font-size: 3rem;"></i>
                        <h4 class="card-title fw-bold">Gérer les catégories</h4>
                        <p class="card-text text-muted mb-4">Ajouter, modifier ou supprimer des catégories de produits pour organiser le catalogue.</p>
                        <a href="index.php?uc=administration&action=gererCategories" class="btn btn-success btn-lg rounded-pill px-4 mt-auto">Gérer les catégories</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
