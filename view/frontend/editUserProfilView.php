<?php

$title = 'Gerer mon profil';

ob_start();

?>

<div class="container contenant">
	<div class="editUser">
		<div class="row buttonBack">
			<a href="profil-<?=$_SESSION['id_user']?>" class="offset-1 offset-lg-1 backProfile"><i class="fas fa-arrow-circle-left"></i> Retourner a mon profil</a>
		</div>
		<div class="row">
			<div class="offset-lg-2 col-lg-8">
				
				<div class="row">
					<h3 class="offset-lg-2 col-lg-8">Modifier mon profil :</h3>
				</div>
				<div class="row">
					<div class="offset-3 offset-lg-1 col-lg-3 avatar">
						<img src="<?= $user['avatar'] ?>" alt="Avatar de <?= $user['pseudo'] ?>"/>
					</div>
					<div class="offset-2 offset-lg-2 col-lg-6" id="editAvatar">
						<form action="editAvatar" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label for="avatar">Modifier votre image de profil :</label>
								<input type="file" name="avatar" id="avatar" class="form-control-file">
							</div>
							<button type="submit" class="offset-2 btn btn-outline-primary">Envoyer le fichier</button>
						</form>
					</div>
				</div>
				<div class="row">
					<button class="offset-lg-8 col-lg-4 btn btn-secondary" id="showEditPw">Modifier le mot de passe</button>
				</div>
				<div class="row" id="editPassword">
					<form action="editPw" method="post"  class="col-lg-12">
						<div class="form-group offset-lg-3 col-lg-5">
							<label for="oldPw" required="required"> Votre mot de passe actuel :</label>
							<input type="password" name="oldPw" id="oldPw" class="form-control">
						</div>
						<div class="form-group offset-lg-3 col-lg-5">
							<label for="newPw"> Votre nouveau mot de passe :</label>
							<input type="password" name="newPw" class="form-control">
						</div>
						<div class="form-group offset-lg-3 col-lg-5">
							<label for="newPw2"> Confirmer le mot de passe :</label>
							<input type="password" name="newPw2" class="form-control">
						</div>
						<button type='submit' class="btn btn-secondary offset-lg-4 col-lg-4">Valider</button>
					</form>
				</div>
				<div class="row">
					<?php
					if (!empty($user['instagram']))
					{
					?>
						<a href="<?= $user['instagram'] ?>" target="_blank" class="btn btn-outline-info offset-lg-1 col-lg-4" id="linkInsta">Mon profil Instagram</a>
						<button class="offset-lg-3 col-lg-4 btn btn-secondary" id="showEditInsta">Modifier mon lien instagram</button>
					<?php		
					}
					else
					{
					?>
						<button class="offset-lg-8 col-lg-4 btn btn-secondary" id="showAddInsta">Mon profil instagram</button>
					<?php
					}
					?>
				</div>
				<div class="row" id="editInsta">
					<form action="editInsta" method="post"  class="col-lg-12">
						<?php
						if (!empty($user['instagram']))
						{
						?>
							<div class="form-group offset-lg-3 col-lg-6">
								<label for="oldInsta"> Votre lien Instagram actuel :</label>
								<input type="text" name="oldInsta" id="oldInsta" class="form-control" value="<?= $user['instagram'] ?>" readonly>
							</div>
						<?php
						}
						?>
						<div class="form-group offset-lg-3 col-lg-6">
							<label for="insta"> Votre nouveau lien Instagram :</label>
							<input type="text" name="insta" id="insta" class="form-control">
						</div>
						<button type='submit' class="btn btn-secondary offset-lg-4 col-lg-4">Valider</button>
					</form>
				</div>
				<div class="row">
					<button class="offset-lg-8 col-lg-4 btn btn-secondary" id="showEditMail">Modifier l'adresse mail</button>
				</div>
				<div class="row" id="editMail">
					<form action="editMail" method="post"  class="col-lg-12">

						<div class="form-group offset-lg-3 col-lg-6">
							<label for="oldMail"> Votre adresse mail actuelle :</label>
							<input type="email" name="oldMail" id="oldMail" class="form-control" value="<?= $user['email'] ?>" readonly>
						</div>
						<div class="form-group offset-lg-3 col-lg-6">
							<label for="mail"> Votre nouvelle adresse mail :</label>
							<input type="email" name="mail" id="mail" class="form-control">
						</div>
						<div class="form-group offset-lg-3 col-lg-6">
							<label for="mail2"> Confirmer l'adresse :</label>
							<input type="email" name="mail2" id="mail2" class="form-control">
						</div>
						<button type='submit' class="btn btn-secondary offset-lg-4 col-lg-4">Valider</button>
					</form>
				</div>
				<div class="row">
					<button class="offset-lg-8 col-lg-4 btn btn-secondary" id="showEditCity">Modifier la ville</button>
				</div>
				<div class="row" id="editCity">
					<form action="editCity" method="post"  class="col-lg-12">

						<div class="form-group offset-lg-3 col-lg-6">
							<label for="oldCity"> Votre ville actuelle :</label>
							<input type="text" name="oldCity" id="oldCity" class="form-control" value="<?= $user['city'] ?>" readonly>
						</div>
						<div class="form-group offset-lg-3 col-lg-6">
							<label for="city"> Votre nouvelle ville :</label>
							<input type="text" name="city" id="city" class="form-control">
						</div>
						<button type='submit' class="btn btn-secondary offset-lg-4 col-lg-4">Valider</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


<?php

$content = ob_get_clean();

require('template.php');