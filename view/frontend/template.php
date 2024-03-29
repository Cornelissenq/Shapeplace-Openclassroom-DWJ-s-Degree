<?php

if (isset($_COOKIE['id_user']) && !empty($_COOKIE['id_user']))
{
	$_SESSION['id_user'] = $_COOKIE['id_user'];
	$_SESSION['pseudo'] = $_COOKIE['pseudo'];
	$_SESSION['avatar'] = $_COOKIE['avatar'];
	$_SESSION['role'] = $_COOKIE['role'];
}
if (isset($_COOKIE['var']) && isset($_SESSION['var']))
{
	if ($_COOKIE['var'] == $_SESSION['var'])
	{
		$ticket = session_id().microtime().rand(0, 999);
		$ticket = hash('sha512', $ticket);
		setcookie("var", $ticket, time() + (60 * 20));
		unset($_SESSION['var']);
		$_SESSION['var'] = $ticket;
	}
	else
	{
		$_SESSION = array();
		session_destroy();
		$_SESSION['error'] = 'Votre session a expirée.';
	}
}
if (isset($_COOKIE['RGPD']))
{
	$ticket = session_id().microtime().rand(0,9999);
	$ticket = hash('sha512', $ticket);
	setcookie("var", $ticket, time() + (60 * 20));
	$_SESSION['var'] = $ticket;
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Trouvez un spot de musculation près de chez vous ou bien un programme de musculation !" />
		<title><?= $title ?> - ShapePlace</title>
		<link href="public/css/style.css" rel="stylesheet" />
		<link rel=" stylesheet" media="screen and (max-width: 992px)" href="public/css/responsive.css" />
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet"/>
        <link rel="icon" type="image/png" href="../public/images/icone.png" />
        <link href="https://fonts.googleapis.com/css?family=Mansalva&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/a204d33b50.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.js"></script>
        <script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-map.js?key=myM1G6Q4D8yFlzD4AG07TLWWZQUP5ljI"></script>
		<script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-geocoding.js?key=myM1G6Q4D8yFlzD4AG07TLWWZQUP5ljI"></script>

	</head>

	<body>
		<header>
			<div class="navbar navbar-default menulogo" id="navbarOrdi">
				<div class="container">
					<div class="col-lg-2 logo">
						<a href="accueil"><img src="public/images/logo.png" alt="logo shapeplace"/></a>
					</div>
					<div class="offset-lg-2 col-lg-5 menu">
						<div class="row">
							<div class="col-lg-6">
								<a class="offset-lg-1 col-lg-10 btn btn-outline-light" href="accueil">Accueil</a>
							</div>
							<div class="col-lg-6">
								<a class="offset-lg-1 col-lg-10 btn btn-outline-light" href="section" >Programmes</a>
							</div>
						</div>
					</div>
					<div class="col-lg-3 login">
						<?php 
						if (isset($_SESSION['id_user']))
						{
						?>  
							<div class="dropdown">
  								<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?= $_SESSION['avatar'] ?>" alt="<?= $_SESSION['pseudo'] ?>" class="avatarMenu"/></button>
 								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="dropDown">
    								<a class="dropdown-item" href="profil-<?=$_SESSION['id_user'] ?>">Mon profil</a>
    								<a class="dropdown-item" href="deconnexion">Déconnexion</a>
    								<?php
									if($_SESSION['role'] == "admin" OR $_SESSION['role'] == "superAdmin")
									{
									?>
										<a class="dropdown-item" href="admin/">Administration</a>
									<?php
									}
									?>
  								</div>
							</div>
						<?php 
						}
						else
						{
						?> 
							<a href="login"><i class="fas fa-user"></i></a>
						<?php 
						} 
						?>
					</div>
				</div>
			</div>
			<div class="pos-f-t" id="navbarMobile">	
  				<nav class="row navbar navbar-dark bg-dark">

	  					<div class="offset-1 col-1 logo">
							<a href="accueil"><img src="public/images/logowhite.png" alt="logo shapeplace"/></a>
						</div>
						<div id="navMobilebtn">
		   					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
		      					<span class="navbar-toggler-icon"></span>
		    				</button>
		    			</div>
  				</nav>
  				<div class="collapse" id="navbarToggleExternalContent">
   					<div class="bg-dark p-4">
      					<h5 class="text-white h5">Menu</h5>
      					<ul>
      						<li><a href="accueil"><i class="fas fa-caret-right"></i> Accueil</a></li>
      						<li><a href="section" ><i class="fas fa-caret-right"></i> Programmes</a></li>
      					</ul>
      					<?php
      					if(isset($_SESSION['id_user']))
      					{
      					?>
      						<h6 class="text-white"><?= $_SESSION['pseudo'] ?> :</h6>
      						<ul>
	      						<li><a href="profil-<?=$_SESSION['id_user'] ?>"><i class="fas fa-caret-right"></i> Mon profil</a></li>
	      						<?php
      							if($_SESSION['role'] == "admin" OR $_SESSION['role'] == "superAdmin")
      							{
      							?>
      								<li><a href="admin/"><i class="fas fa-caret-right"></i> Administration</a></li>
      							<?php
      							}
      							?>
	    						<li><a href="deconnexion"><i class="fas fa-caret-right"></i> Déconnexion</a></li>
      						</ul>
      					<?php
      					}
      					else
      					{
      					?>
      						<ul>
      							<li><a href="login"><i class="fas fa-caret-right"></i> S'identifier</a></li>
      							<li><a href="register"><i class="fas fa-caret-right"></i> S'inscrire</a></li>
      						</ul>
      					<?php
      					}
      					?>
    				</div>
  				</div>
			</div>
		</header>
		<?php
		if (isset($_COOKIE['RGPD']) OR isset($_COOKIE['NORGPD'])) 
		{

		}
		else
		{
		?>
			<div class="row">
				<div id="RGPD" class="col-lg-12"> 
					<p class="offset-1 col-10 offset-sm-3 col-sm-6 offset-lg-1 col-lg-8">
						En poursuivant votre navigation sur ce site, vous acceptez l’utilisation de Cookies pour vous proposer la sauvegarde d'identification.
					</p>
					<div class="col-12 col-sm-12 col-lg-3" id="btnRGPD">
						<div class="row">
							<a href="index.php?action=RGPD" class="btn btn-secondary offset-3 col-6 offset-lg-3 col-lg-4"><i class="fas fa-check"></i> Accepter</a>
							<a href="index.php?action=NORGPD" class="btn btn-secondary offset-3 col-6 offset-lg-1 col-lg-4"><i class="fas fa-times"></i> Refuser</a>
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

		<div class="containeur">
			<?= $content ?>
		</div>

		<footer>
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<p><a href="mentionslegales"> Mentions Légales </a></p>
					</div>
					<div class="col-lg-4 socialNetwork">
						<h6>Nos réseaux sociaux</h6>
						<div class='row'>
							<a href='' class='col-lg-4 facebook'><i class="fab fa-facebook"></i></a>
							<a href='' class='col-lg-4 twitter'><i class="fab fa-twitter"></i></a>
							<a href='https://www.instagram.com/shapeplace/' target='_blank' class='col-lg-4 instagram'><i class="fab fa-instagram"></i></a>
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
		<script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
		<script src="bootstrap/js/bootstrap.js"></script>
		<script src="public/js/commentForm.js"></script>
		<script src="public/js/sessionStorage.js"></script>
		<script src="public/js/editProfilUser.js"></script>
		<script src="https://cdn.lightwidget.com/widgets/lightwidget.js"></script>
	</body>
</html>