<?php 

$title = 'Erreur';

ob_start();

?>

<div class="container error">
	<div class="row">
		<div class="col-lg-12">
			<div class="row">
				<div class="offset-lg-4 col-lg-4">
					<?php 
					if(isset($error))
					{
					?>
						<h4><?=$error?></h4>
					<?php
					}
					else
					{
					?>
						<h4>Page introuvable</h4>
					<?php
					}
					?>
				</div>
			</div>
			<div class="row">
				
				<div class="offset-lg-1 col-lg-10">
					<p>Malheuresement, cette page n'existe pas ou n'est plus accessible.</p>
					<p>Vous avez toute fois la possibilité de vous redirigé sur la page d'accueil.</p>
				</div>
			</div>
			<div class="row">
				<div class="offset-lg-4 col-lg-4">
					<div class="errorBtn">
						<a href="accueil" class="btn btn-secondary offset-lg-1 col-lg-10"> Revenir à l'accueil </a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php

$content = ob_get_clean();

require('template.php');