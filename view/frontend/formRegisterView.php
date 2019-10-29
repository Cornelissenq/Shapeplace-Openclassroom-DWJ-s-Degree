<?php

$title = 'Inscription';

ob_start();

?>
<div class="container contenant">
  <div class="row">
  	<div class="offset-lg-1 col-lg-10">
  		<div class="row">
  			<div class="offset-lg-1 col-lg-10 cadreLogin">
  				<form action="index.php?action=register" method="post">
  					<div class="form-group">
  						<div class="form-group offset-md-2 col-md-8">
        						<label for="date_birth">Pseudo :</label>
        						<input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Pseudo" required="required">
      					</div>
      				</div>
  					<div class="form-row">
      					<div class="form-group offset-md-1 col-md-5">
        						<label for="date_birth">Mot de passe :</label>
        						<input type="password" class="form-control" id="pw" name="pw" placeholder="Mot de passe" required="required">
      					</div>
      					<div class="form-group col-md-5">
        						<label for="date_birth"> Confirmer le mot de passe :</label>
        						<input type="password" class="form-control" id="pw2" name="pw2" placeholder="Mot de passe" required="required">
      					</div>
    					</div>
    					<div class="form-row">
      					<div class="form-group offset-md-1 col-md-5">
        						<label for="date_birth">Prénom :</label>
        						<input type="text" class="form-control" id="name" name="name" placeholder="Prénom" required="required">
      					</div>
      					<div class="form-group col-md-5">
        						<label for="date_birth">Nom :</label>
        						<input type="text" class="form-control" id="surname" name="surname" placeholder="Nom" required="required">
      					</div>
    					</div>
    					<div class="row">
  	  					<div class="form-group offset-md-2 col-md-8">
  	  						<label for="date_birth">Adresse Mail :</label>
  	      					<input class="form-control" type="mail" id="mail" name="mail" placeholder="adresse@mail.fr" required="required">
  						</div>
  					</div> 
  					<div class="form-row">
      					<div class="form-group offset-md-1 col-md-5">
        						<label for="date_birth">Date de Naissance :</label>
  	      					<input class="form-control" type="date" id="date_birth" name="date_birth" required="required">
      					</div>
      					<div class="form-group col-md-5">
        						<label for="date_birth"> Ville :</label>
        						<input type="text" class="form-control" id="city" name="city" placeholder="Ville" required="required">
      					</div>
    					</div>
  					<button type="submit" class="btn btn-outline-secondary">S'inscrire</button>
  				</form>
  			</div>
  		</div>	
  	</div>
  </div>
</div>




<?php

$content = ob_get_clean();

require('template.php');