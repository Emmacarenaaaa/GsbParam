<ul id="categories">

	<?php
	foreach ($lesCategories as $uneCategorie) {
		$idCategorie = $uneCategorie->idCat;
		$libCategorie = $uneCategorie->libelleCat;
		?>
		<li>
			<a class="text-decoration-none text-light"
				href="index.php?uc=voirProduits&action=voirProduits&categorie=<?= $idCategorie ?>">
				<?= $libCategorie ?></a>
		</li>
		<?php
	}
	?>

</ul>