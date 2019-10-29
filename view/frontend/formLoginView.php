<?php

$title = 'Identification';

ob_start();

?>

<div class="container contenant">
	<div class="row">
		<div class="offset-lg-2 col-lg-8">
			<div class="row">
				<div class="offset-lg-1 col-lg-10 cadreLogin">
					<form action="index.php?action=login" method="post">
						<div class="form-row">
	    					<div class="form-group offset-md-1 col-md-5">
	      						
	      						<input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Pseudo">
	    					</div>
	    					<div class="form-group col-md-5">
	      						
	      						<input type="password" class="form-control" id="pw" name="pw" placeholder="Mot de passe">
	    					</div>
	  					</div>
	  					<div class="form-group ">
	   						<div class="form-check">
	      						<input class="form-check-input" type="checkbox" id="stayOnline" name="stayOnline">
	      						<label class="form-check-label" for="stayOnline">Rester connecté(e)</label>
	    					</div>
						</div>
						<button type="submit" class="btn btn-outline-secondary">S'identifier</button>
					</form>

					<div>
						<p>Vous n'êtes pas inscrit et vous souhaitez nous rejoindre :</p>
						<a href="index.php?action=register" class="btn btn-outline-success">S'inscrire</a>
					</div>
				</div>
			</div>	
		</div>
	</div>
</div>

<?php

$content = ob_get_clean();

require('template.php');

?>