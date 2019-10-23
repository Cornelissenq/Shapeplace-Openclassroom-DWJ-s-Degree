<?php

$title = $program['name'];

ob_start();

?>

<div class="row">
	<div class="col-lg-12 cadreTitle">
		<div class="row">
			<div class="col-lg-1 backListProgram">
				<a href="index.php?action=list&amp;id=<?= $program['id_section'] ?>" class="btn btn-light"><i class="fas fa-arrow-circle-left"></i></a>
			</div>
			<div class="col-lg-6 accessCategory">
				<p>
					<a href="index.php">Accueil</a>
					<i class="fas fa-angle-right"></i>
					<a href="index.php?action=section">Programmes</a>
					<i class="fas fa-angle-right"></i>
					<a href="index.php?action=list&amp;id=<?=$section['id']?>"><?=$section['name']?></a>
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
					<?php if (isset($program['description']))
					{
					?>
						<div class="contentProgram">
							<h4 id="description"><i class="fas fa-bullseye"></i> La description : </h4>
							<p><?= nl2br($program['description']) ?></p>
						</div>
					<?php
					}
						
					if (isset($program['good_point']))
					{
					?>
						<div class="contentProgram">
							<h4 id="goodPoint"><i class="fas fa-bullseye"></i> Les bon points : </h4>
							<?= nl2br($program['good_point']) ?>
						</div>
					<?php
					}
						
					if (isset($program['bad_point']))
					{
					?>
						<div class="contentProgram">
							<h4 id="badPoint"><i class="fas fa-bullseye"></i> Les mauvais points : </h4>
							<?= nl2br($program['bad_point']) ?>
						</div>
					<?php
					}
						
					if (isset($program['program']))
					{
					?>
						<div class="contentProgram">
							<h4 id="program"><i class="fas fa-bullseye"></i> Le programme : </h4>
							<?= nl2br($program['program']) ?>
						</div>
					<?php
					}
					?>
					</div>
				</div>
			</div>
			<div class="col-lg-3 ">
				<nav id="asideProgram">
					<h6>Accéder à la rubrique :</h6>
					<?php if (isset($program['description']))
					{
					?>
						<p><i class="fas fa-angle-right"></i><a href="#description"> La description </a></p>
					<?php
					}
						
					if (isset($program['good_point']))
					{
					?>
						<p><i class="fas fa-angle-right"></i><a href="#goodPoint"> Les bon points </a></p>
					<?php
					}
						
					if (isset($program['bad_point']))
					{
					?>
						<p><i class="fas fa-angle-right"></i><a href="#badPoint"> Les mauvais points </a></p>
					<?php
					}
						
					if (isset($program['program']))
					{
					?>
						<p><i class="fas fa-angle-right"></i><a href="#program"> Le programme </a></p>
					<?php
					}
					?>
				</nav>
				
			</div>
		</div>		
	</div>
</div>

<div class="row">
	<div class="offset-lg-2 col-lg-8 formComment">
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
					<form action="index.php?action=addCommentP&amp;id=<?=$program['id']?>&amp;idsection=<?=$section['id']?>" method="post">
			        	<fieldset class="form-group">
			        		<div class="row">
			        			<legend class="col-form-label col-sm-2 pt-0">Commentaire</legend>
			        			<div class="col-sm-10">
			        				<div class="form-group">
			        					<input type="hidden" name="pseudo" value="<?=$_SESSION['pseudo']?>" />
			        					<input type="hidden" name="id_user" value="<?=$_SESSION['id_user']?>" />
			        					<textarea class="form-control" name="commentProgram" id="commentProgram" rows="3"></textarea>
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
							<a href="index.php?action=login" class="btn btn-outline-danger"> Identification </a>
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
	<div class="offset-lg-1 col-lg-10 cadreComment">
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
					<div class="offset-lg-1 col-lg-10">
						<div class="row headerComment" id="<?php $comment['id'] ?>">
							<div class="offset-lg-1 col-lg-3 pseudoComment">
								<a href="index.php?action=profil&amp;id=<?=$comment['id_user']?>"><?=$comment['pseudo']?></a>
							</div>
							<div class="offset-lg-2 col-lg-3 dateComment">
								<?php
								if (isset($comment['date_modification']))
								{
								?>
									<p> Modifié le <?=$comment['date_modification']?></p>
								<?php
								}
								else
								{
								?>
									<p> Écrit le <?=$comment['date_creation']?></p>
								<?php
								}
								?>
							</div>
							<div class="offset-lg-1 col-lg-2 btnComment">
								<a href="index.php?action=deleteCommentP&amp;id=<?=$comment['id']?>" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer ce commentaire ?');"><i class="fas fa-exclamation-triangle"></i> Supprimer</a>
							</div>
					
						</div>
						<div class="row contentComment">
							<div class="offset-lg-1 col-lg-10">
								<form action="index.php?action=editCommentP&amp;id=<?=$comment['id']?>" method="post">
									<div class="form-group">
										<textarea name="commentEdit" id="commentEdit" class="form-control" rows="3"><?= $comment['comment'] ?></textarea>
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
					<div class="offset-lg-1 col-lg-10">
						<div class="row headerComment" id="<?php $comment['id'] ?>">
							<div class="col-lg-4 pseudoComment">
								<a href="index.php?action=profil&amp;id=<?=$comment['id_user']?>"><?=$comment['pseudo']?></a>
							</div>
							<div class="offset-lg-2 col-lg-3 dateComment">
								<?php
									if (isset($comment['date_modification']))
									{
									?>
										<p> Modifié le <?=$comment['date_modification']?></p>
									<?php
									}
									else
									{
									?>
										<p> Écrit le <?=$comment['date_creation']?></p>
									<?php
									}
									?>
							</div>
							<div class="offset-lg-1 col-lg-2 btnComment">
								<a href="index.php?action=report&amp;id=<?=$comment['id']?>" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous signaler ce commentaire ?');"><i class="fas fa-exclamation-triangle"></i> Signaler</a>
							</div>
					
						</div>
						<div class="row contentComment">
							<div class="offset-lg-1 col-lg-10">
								<p><?= $comment['comment'] ?></p>
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
<?php

$content = ob_get_clean();

require('template.php');

?>