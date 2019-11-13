<?php

$title = $program['name'];

ob_start();

?>
<div class="container contenant">
	<div class="row">
		<div class="col-lg-12 cadreTitle">
			<div class="row">
				<div class="col-lg-1 backListProgram">
					<a href="section-<?= $program['id_section'] ?>" class="btn btn-light"><i class="fas fa-arrow-circle-left"></i></a>
				</div>
				<div class="col-lg-6 accessCategory">
					<p>
						<a href="accueil">Accueil</a>
						<i class="fas fa-angle-right"></i>
						<a href="section">Programmes</a>
						<i class="fas fa-angle-right"></i>
						<a href="section-<?=$section['id']?>"><?=$section['name']?></a>
					</p>
				</div>
			</div>
			<div class='row'>
				<div class="offset-lg-3 col-lg-6">
					<h2 class="titreProgram"><?= $program['name'] ?> : </h2>
				</div>
			</div>
			<div class="row">
				
			</div>	
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 content">
			<div class="row">
				<div class="col-lg-9">
					<div class="row">
						<div class="offset-lg-1 col-lg-10">
							
							<div class="contentProgram">
								<h4 id="description"><i class="fas fa-angle-right"></i> La description : </h4>
								<p><?= nl2br($program['description']) ?></p>
							</div>
							<?php	
							if (isset($program['good_point']) && $program['good_point'] != '')
							{
							?>
								<div class="contentProgram">
									<h4 id="goodPoint"><i class="fas fa-angle-right"></i> Les bon points : </h4>
									<?= nl2br($program['good_point']) ?>
								</div>
							<?php
							}
								
							if (isset($program['bad_point']) && $program['bad_point'] != '')
							{
							?>
								<div class="contentProgram">
									<h4 id="badPoint"><i class="fas fa-angle-right"></i> Les mauvais points : </h4>
									<?= nl2br($program['bad_point']) ?>
								</div>
							<?php
							}
							?>
							<div class="contentProgram">
								<h4 id="program"><i class="fas fa-angle-right"></i>	 Le programme : </h4>
								<?= nl2br($program['program']) ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 ">
					<nav id="asideProgram">
						<h6>Accéder à la rubrique :</h6>
						<p><i class="fas fa-angle-right"></i><a href="#description"> La description </a></p>
						<?php
						if (isset($program['good_point']) && $program['good_point'] != '')
						{
						?>
							<p><i class="fas fa-angle-right"></i><a href="#goodPoint"> Les bon points </a></p>
						<?php
						}
							
						if (isset($program['bad_point']) && $program['bad_point'] != '')
						{
						?>
							<p><i class="fas fa-angle-right"></i><a href="#badPoint"> Les mauvais points </a></p>
						<?php
						}
						?>
						<p><i class="fas fa-angle-right"></i><a href="#program"> Le programme </a></p>
					</nav>
					
				</div>
			</div>		
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 formComment">
			<div class="row">
				<div class="offset-lg-4 col-lg-4">
					<button type="button" id="enableFormComment" class="btn btn-info">Ajouter un commentaire</button>
				</div>
			</div>	
			<div class="row">
				<div class="col-lg-12" id="formComment">
					<?php if (isset($_SESSION['id_user']))
					{	
					?>
						<form action="ajouterCommentaire-<?=$program['id']?>-<?=$section['id']?>" method="post">
				        	<fieldset class="form-group">
				        		<div class="row">
				        			<legend class="col-form-label col-sm-2 pt-0">Commentaire</legend>
				        			<div class="col-sm-10">
				        				<div class="form-group">
				        					<input type="hidden" name="pseudo" value="<?=$_SESSION['pseudo']?>" />
				        					<input type="hidden" name="id_user" value="<?=$_SESSION['id_user']?>" />
				        					<textarea class="form-control" name="commentProgram" id="commentProgram" rows="3" required="required"></textarea>
				        				</div>
				        			</div>
				        		</div>
				        	</fieldset>
				        	<button type="submit" class="btn btn-outline-info">Envoyer</button>
						</form>
					<?php
					}
					else
					{
					?>
						<p class="noLogin">Vous devez vous identifier afin de pouvoir publier un commentaire.</p>
						<div class="row">
							<div class="offset-lg-4 col-lg-4">
								<a href="login" class="btn btn-outline-danger"> Identification </a>
							</div>
						</div>
						
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 cadreComment">
			<div class="titleComment">
				<h5> Commentaires : </h5>
			</div>
			<?php 
			while($comment = $comments->fetch())
			{

				if (isset($_SESSION['id_user']) && $comment['id_user'] === $_SESSION['id_user'])
				{
				?>
					<div class="row">
						<div class="col-lg-12">
							<div class="row headerComment" id="<?= $comment['id'] ?>">
								<div class="col-lg-4 pseudoComment">
									<a href="profil-<?=$comment['id_user']?>" target="_blank"><?=htmlspecialchars($comment['pseudo'])?></a>
								</div>
								<div class="offset-lg-3 col-lg-3 dateComment">
									<?php
									if (isset($comment['date_modification_fr']))
									{
									?>
										<p> Modifié le <?=htmlspecialchars($comment['date_modification_fr'])?></p>
									<?php
									}
									else
									{
									?>
										<p> Écrit le <?=htmlspecialchars($comment['date_creation_fr'])?></p>
									<?php
									}
									?>
								</div>
								<div class="col-lg-2 btnComment">
									<a href="supprimerCommentaire-<?=$comment['id']?>" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer ce commentaire ?');"><i class="far fa-trash-alt"></i></i> Supprimer</a>
								</div>
						
							</div>
							<div class="row contentComment">
								<a href="profil-<?=$comment['id_user']?>" class="col-lg-1" target="_blank"><img src="<?=$comment['avatar']?>" alt="<?=$comment['pseudo']?>" class="imgComment"></a>
								<div class="offset-lg-1 col-lg-9">
									<form action="editerCommentaire-<?=$comment['id']?>" method="post">
										<div class="form-group">
											<textarea name="commentEdit" id="commentEdit" class="form-control" rows="3"><?= htmlspecialchars(nl2br($comment['comment'])) ?></textarea>
										</div>
										<div class="row">
											<div class="offset-lg-10 col-lg-2">
												<button type="submit" class="btn btn-outline-info"x>Modifier</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				<?php
				}
				else
				{
				?>
					<div class="row">
						<div class="col-lg-12">
							<div class="row headerComment" id="<?= $comment['id'] ?>">
								<div class="col-2 offset-lg-1 col-lg-4 pseudoComment"> 
									<a href="profil-<?=$comment['id_user']?>" target="_blank"><?=$comment['pseudo']?></a>
								</div>
								<div class="offset-1 col-5 offset-lg-2 col-lg-3 dateComment">
									<?php
									if (isset($comment['date_modification_fr']))
									{
									?>
										<p> Modifié le <?=$comment['date_modification_fr']?></p>
									<?php
									}
									else
									{
									?>
										<p> Écrit le <?=nl2br($comment['date_creation_fr'])?></p>
									<?php
									}
									?>
								</div>
								<div class="col-4 col-lg-2 btnComment">
									<a href="signalerCommentaire-<?=$comment['id']?>" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous signaler ce commentaire ?');"><i class="fas fa-exclamation-triangle"></i> Signaler</a>
								</div>
						
							</div>
							<div class="row contentComment">
								<a href="profil-<?=$comment['id_user']?>" class="col-1 col-lg-1" target="_blank"><img src="<?=$comment['avatar']?>" alt="<?=$comment['pseudo']?>" class="imgComment"></a>
								<div class="offset-1 col-9 offset-lg-1 col-lg-9">
									<p><?= nl2br($comment['comment']) ?></p>
								</div>
							</div>
						</div>
					</div>
				<?php 
				}
				
			}
			?>
		</div>
	</div>
</div>
<?php

$content = ob_get_clean();

require('template.php');

?>