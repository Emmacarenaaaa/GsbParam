<div id="produits">
<?php
	echo "<h2>$titreCategorie</h2>";

foreach( $lesProduits as $unProduit) 
{ 	
	$id = $unProduit->idProd;
	$description = $unProduit->descriptionProd;
	$image = $unProduit->imageProd;
	$prix = $unProduit->prixProd;
	?>	
	<div id="card">
		
			<div>
			<div class="photoCard"><img src="<?= $image ?>" alt=image /></div>
			<div class="descrCard"><?= $description ?></div>
			<div class="prixCard"><?= $prix."€" ?></div>
			</div>
			<div class="imgCard"><a href="index.php?uc=gererPanier&produit=<?= $id ?>&action=ajouterAuPanier"> 
			
			<img src="assets/images/mettrepanier.png" title="Ajouter au panier" alt="Mettre au panier"> </a>
			<a href="index.php?uc=voirProduits&action=voirDetails&id=<?= $id ?>">
        <button type="button">Voir les détails</button>
			
	</div>
<?php			
}
?>
</div>
