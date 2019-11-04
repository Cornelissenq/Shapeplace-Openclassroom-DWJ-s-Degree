<?php

$title = 'Administration';

ob_start();

?>

<div class="row">
	<div class="col-lg-12">
		<div class="row">			
			<h4 class="offset-lg-4 col-lg-4">Administration :</h4>
		</div>
		<div class="row">
			<div class="offset-lg-2 col-lg-8">
				<h5>Bonjour <?= $_SESSION['pseudo'] ?>,</h5>
				<br/>
			</div>
		</div>	
		<div class="row">
			<div class="offset-lg-2 col-lg-8">
				<h6>Il y a actuellement <?= $count['nbr'] ?> commentaire(s) signalé(s)</h6>
			</div>
		</div>		
		<div class="row">
			<div class="offset-lg-2 col-lg-4">
				<a href="index.php?action=adminReportedComment" class="btn btn-outline-info col-lg-6">Y accéder</a>
			</div>
		</div>
		<div class="row">
			<div class="offset-lg-2 col-lg-8">
				<br/>
				<h6>Vous trouverez à gauche de la page les différentes rubriques pour gérer le site.</h6>
			</div>
		</div>
	</div>
</div>



<?php

$content = ob_get_clean();

require('template.php');