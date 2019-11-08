<?php

if (isset($_COOKIE['id_user']) && !empty($_COOKIE['id_user']))
{
	$_SESSION['id_user'] = $_COOKIE['id_user'];
	$_SESSION['pseudo'] = $_COOKIE['pseudo'];
	$_SESSION['avatar'] = $_COOKIE['avatar'];
	$_SESSION['role'] = $_COOKIE['role'];
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title><?= $title ?> - ShapePlace</title>
		<link href="../public/css/style.css" rel="stylesheet" />
        <link href="../bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link rel="icon" type="image/png" href="../public/images/icone.png" />
        <link href="https://fonts.googleapis.com/css?family=Mansalva&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/a204d33b50.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.js"></script>
        <script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-map.js?key=myM1G6Q4D8yFlzD4AG07TLWWZQUP5ljI"></script>
		<script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-geocoding.js?key=myM1G6Q4D8yFlzD4AG07TLWWZQUP5ljI"></script>

	</head>

	<body>
		<?php
		if (isset($_COOKIE['RGPD']) OR isset($_COOKIE['NORGPD'])) 
		{

		}
		else
		{
		?>
			<div class="row">
				<div id="sessionStorage" class="col-lg-12 gray">    	
					<p class="offset-lg-1 col-lg-7">
						En poursuivant votre navigation sur ce site, vous acceptez l’utilisation de Cookies pour vous proposer la sauvegarde d'identification.
					</p>
					<div class="col-lg-4">
						<div class="row">
							<a href="index.php?action=RGPD" class="btn btn-secondary offset-lg-2 col-lg-4">Accepter</a>
							<a href="index.php?action=NORGPD" class="btn btn-secondary offset-lg-2 col-lg-4">Refuser</a>
						</div>
					</div>
				</div>
			</div>
		<?php
	}
		if (isset($_SESSION['success']))  {
		?>
			<div class="row">
				<div id="sessionStorage" class="col-lg-12 green">    	
					<p class="offset-lg-4 col-lg-4"><?php
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
						?>
					</p>
					<button id="closeSstorage" class="green offset-lg-3 col-lg-1"><i class="fas fa-window-close"></i></button>
				</div>
			</div>
		<?php
		}
		if (isset($_SESSION['error']))  {
		?>
			<div class="row">
				<div id="sessionStorage" class="red col-lg-12">    	
					<p class="offset-lg-4 col-lg-4"><?php
						echo $_SESSION['error']; 
						unset($_SESSION['error']);
					?>
					</p>
					<button id="closeSstorage" class="red offset-lg-3 col-lg-1"><i class="fas fa-window-close"></i></button>
				</div>
			</div>
		<?php 
		}
		?>
		<div class="jumbotron" id="viewBackend">
			<div class="row">
				<div class="col-lg-2" id="navB">
					<ul>
						<li><a href="../accueil/" >Retour au site</a></li>
					
					
						<li><a href="../deconnexion" >Déconnexion</a></li>
					</ul>
					
					<div class="row">
						<div class="logoB">
							<a href="../admin/" ><img src="../public/images/logo.png" alt="logo shapeplace" class="col-lg-12"/></a>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<div class="row">
								<div class="offset-lg-2 col-lg-8">
									<p>Gestion :</p>
								</div>
							</div>
							<div class="row">
								<ul>
									<?php
									if($_SESSION['role'] == 'superAdmin')
									{
									?>
										<li><a href="../adminUser/"><i class="fas fa-chevron-right"></i> Utilisateurs</a></li>
									<?php
									}
									?>
									<li><a href="../adminSection/"><i class="fas fa-chevron-right"></i> Sections</a></li>
									<li><a href="../adminProgram/"><i class="fas fa-chevron-right"></i> Programmes</a></li>
									<li><a href="../adminComment/"><i class="fas fa-chevron-right"></i> Commentaires</a></li>
									<li><a href="../adminSpot/"><i class="fas fa-chevron-right"></i> Spots</a></li>
									<li><a href="../adminNotes/"><i class="fas fa-chevron-right"></i> Avis</a></li>
								</ul>
							</div>
						</div>
					</div>
					
						
				</div>
				<div class="col-lg-10" id="panel">
					<?= $content ?>
				</div>
			</div>
		</div>
		

		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
		<script src="../bootstrap/js/bootstrap.js"></script>
		<script src="../public/js/sessionStorage.js"></script>
	</body>
</html>