<?php

if (isset($_COOKIE['id_user']) && !empty($_COOKIE['id_user']))
{
	$_SESSION['id_user'] = $_COOKIE['id_user'];
	$_SESSION['pseudo'] = $_COOKIE['pseudo'];
	$_SESSION['role'] = $_COOKIE['role'];
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title><?= $title ?> - ShapePlace</title>
		<link href="public/css/style.css" rel="stylesheet" />
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link rel="icon" type="image/png" href="public/images/icone.png" />
        <link href="https://fonts.googleapis.com/css?family=Mansalva&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/a204d33b50.js"></script>
	</head>

	<body>
		<header>
			<div class="navbar navbar-default menulogo">
				<div class="container">
					<div class="col-lg-2 logo">
						<img src="public/images/logo.png" alt="logo shapeplace"/>
					</div>
					<div class="offset-lg-3 col-lg-5 menu">
						<div class="row">
							<a href="" class="col-lg-4">Accueil</a>
							<a href="index.php?action=section" class="col-lg-4">Programmes</a>
							<a href="" class="col-lg-4">Rejoins nous</a>
						</div>
					</div>
					<div class="col-lg-2 login">
						<?php if (isset($_SESSION['id_user']))
							  {
						?>  <div class="dropdown">
  								<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $_SESSION['pseudo'] ?></button>
 								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    								<a class="dropdown-item" href="#">Mon profil</a>
    								<a class="dropdown-item" href="index.php?action=logout">Me deconnecter</a>
  								</div>
							</div>
						<?php }
							  else
							  {
							  ?> <a href="index.php?action=login"><i class="fas fa-user"></i>	</a>
						<?php } ?>
					</div>
				</div>
			</div>
		</header>
		<?php
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

		<div class="container contenant">
			<?= $content ?>
		</div>

		<footer>
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<a href=""> Mentions Légales </a>
					</div>
					<div class="col-lg-4 socialNetwork">
						<h6>Nos réseaux sociaux</h6>
						<div class='row'>
							<a href='' class='col-lg-4 facebook'><i class="fab fa-facebook"></i></a>
							<a href='' class='col-lg-4 twitter'><i class="fab fa-twitter"></i></a>
							<a href='' class='col-lg-4 instagram'><i class="fab fa-instagram"></i></a>
						</div>
					</div>
					<div class="col-lg-4">
						<p><a href=""><i class="far fa-copyright"></i> Copyright 2019</a></p>
						<p><a href="https://www.cornelissenquentin.fr" target="_blank">Réalisé par Cornelissen Quentin</a></p>
					</div>
				</div>
			</div>
		</footer>

		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script src="bootstrap/js/bootstrap.js"></script>
		<script src="public/js/commentForm.js"></script>
		<script src="public/js/sessionStorage.js"></script>
	</body>
</html>