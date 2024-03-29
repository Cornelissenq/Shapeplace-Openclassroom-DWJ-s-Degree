<?php

$title = $user['pseudo'];

ob_start();

?>
<div class="container contenant">
	<div class="row">
		<div class="offset-lg-1 col-lg-10 userProfilHeader">
			<?php
			if (isset($_SESSION['id_user']))
			{
				if ($_SESSION['id_user'] === $user['id'])
				{
				?>
					<div class="row">
						<div class="offset-lg-9 col-lg-3">
							<a href="profil-<?=$_SESSION['id_user']?>-edit" class="btn btn-dark" id="editBtn">Modifier mon profil</a>
						</div>
					</div>
				<?php
				}
			}
			?>
				
			<div class="row">
				<h3 class="offset-lg-3 col-lg-6">Profil de <?= $user['pseudo'] ?></h3>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="offset-lg-1 col-lg-10 userProfil">	
			<div class="row">
				<div class="offset-lg-1 col-lg-10">
					<div class="row">
						<div class="col-lg-4 profilAvatar">
							<img src="<?= $user['avatar'] ?>" alt="Photo de profil de <?php $user['pseudo'] ?>"/>
						</div>

						<div class="offset-lg-1 col-lg-7 contentProfil">
							<h4>Information :</h4>
							<div class="row">
								<p class="offset-1 col-4 offset-lg-1 col-lg-5 infoProfil">Pseudo :</p>
								<p class="col-4 col-lg-4"><?= htmlspecialchars($user['pseudo']) ?></p>
							</div>
							<div class="row">
								<p class="offset-1 col-4 offset-lg-1 col-lg-5 infoProfil">Prénom :</p>
								<p class="col-4 col-lg-4"><?= htmlspecialchars($user['name']) ?></p>
							</div>
							<div class="row">
								<p class="offset-1 col-4 offset-lg-1 col-lg-5 infoProfil">Ville :</p>
								<p class="col-4 col-lg-4"><?= htmlspecialchars($user['city']) ?></p>
							</div>
							<div class="row">
								<p class="offset-1 col-4 offset-lg-1 col-lg-5 infoProfil">Date de naissance :</p>
								<p class="col-4 col-lg-4"><?= htmlspecialchars($user['date_birth_fr']) ?></p>
							</div>
							<?php
							if (isset($user['instagram']))
							{
							?>
								<div class="row">
									<a class="offset-lg-3 col-lg-6 btn btn-dark" href="<?= $user['instagram'] ?>">Profil instagram</a>
								</div>
							<?php
							}
							?>	
						</div>
					</div>
					<div class="row">
						<div class="offset-lg-2 col-lg-8 commentUserProfil">
							<div class="row">
								<div class="col-lg-12 headerCommentUserProfil">
									<h6> Les derniers commentaires :</h6>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-12 contentCommentUserProfil">
									<?php
									while($comment = $comments->fetch())
									{
									?>
										<div class="row">
											<div class="col-lg-12 lastCommentProfil">
												<a href="programme-<?=$comment['url_slug']?>-<?= $comment['id_program'] ?>-<?= $comment['id_section']?>#<?= $comment['id']?>" target="_blank"><?= htmlspecialchars($comment['comment']) ?></a>
											</div>
										</div>
									<?php	
									}
									?>	
								</div>	
							</div>						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php

$content = ob_get_clean();

require('template.php');
