<?php

$title = 'Accueil';

ob_start();

?>
<div class="jumbotron" id="oneHome">
	<div class="row">
		<h3 class="offset-lg-3 col-lg-6">Pouvoir s'entrainer partout avec ShapePlace. </h3>
	</div>
	<div class="row">
		<div class="offset-1 col-10 offset-lg-1 col-lg-6 offset-xl-2 col-xl-10" >
			<div class="offset-sm-1 col-sm-10 offset-lg-1 col-lg-10 offset-xl-2 col-xl-5 formMap" id="formMapHome">
				<form action='carte' method='post'>
					<label for="address">Entrez votre adresse pour trouver les spots de workout à proximité</label>
					<div class="form-group row">
						<input type="text" name="search" id="search" class="offset-1 col-8 offset-sm-2 col-sm-8 offset-lg-0 col-lg-10  form-control" placeholder="Adresse, Ville CP">
						<button type="submit" class="btn btn-outline-success"><i class="fas fa-search"></i></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
	
</div>
<div class="container contenant">
	<div class="col-lg-12 col-xs-12">
	<div class="row">
		<div class=" offset-xs-2 col-xs-8 col-lg-4 homeSection">
			<div class="row">
				<div class="pictSection"></div>
			</div>
			<div class="row">
				<h5 class="offset-2 offset-lg-3">Nos programmes :</h5>
			</div>
			<div class="row">
				<p class="offset-lg-1 col-lg-10">Varie tes scéances en utilisant nos divers programmes.</p>
			</div>
			<div class="row">
				<a href="section" class="offset-6 col-5 offset-lg-7 col-lg-4 btn btn-dark"><i class="fas fa-plus-circle"></i>  Accéder</a>
			</div>
			
		</div>
		<div class="offset-xs-2 col-xs-8 offset-lg-4 col-lg-4 homeJoin">
			<div class="row">
				<div class="pictJoin"></div>
			</div>
			<div class="row">
				<h5 class="offset-2 offset-lg-3">Rejoins-nous :</h5>
			</div>
			<div class="row">
				<p class="offset-lg-1 col-lg-10">Rejoins-nous sur instagram et intéragit avec la communauté ShapePlace. N'hésite pas à partager ta progression !</p>
			</div>
			<div class="row">
				<a href="rejoins-nous" class="offset-6 col-5 offset-lg-7 col-lg-4 btn btn-dark"><i class="fas fa-plus-circle"></i>  Accéder</a>
			</div>
		</div>
	</div>
	</div>
</div>

<?php

$content = ob_get_clean();

require('template.php');