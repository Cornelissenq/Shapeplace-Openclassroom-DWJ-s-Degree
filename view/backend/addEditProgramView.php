<?php
if (isset($program))
{
	$title = 'Modifier le programme ' .$program['name'];
}
else
{
	$title = 'Ajout d\'un programme';
}

ob_start();

?>
<div class="row">
	<div class="col-lg-12">
		<div class="row">
			<?php
			if (isset($program))
			{
			?>
				<h4 class="offset-lg-2 col-lg-8	">Modifier le programme "<?=$program['name']?>" :</h4>
			<?php
			}
			else
			{
			?>
				<h4 class="offset-lg-4 col-lg-4">Ajout d'un programme :</h4>
			<?php	
			}
			?>
		</div>
		<div class="row">
		<?php
		if (isset($edit))
		{
		?>
			<form action="index.php?action=editProgram&amp;id=<?= $program['id'] ?>" method="post" class="offset-lg-1 col-lg-10" enctype="multipart/form-data">
		<?php	
		}
		else
		{
		?>
			<form action="index.php?action=addProgram" method="post" class="offset-lg-1 col-lg-10" enctype="multipart/form-data">
		<?php
		}
				if (isset($program['avatar']))
				{
				?>
					<img src="<?=$program['avatar']?>" alt="<?=$program['name']?>" class="offset-lg-4 col-lg-4">
				<?php
				}
				?>
				<div class="form-group">
					<label for="image">Image :</label>
					<input type="file" name="image" id="image" class="form-control-file">
				</div>
				<div class="form-group">
					<label for="name">Nom du programme :</label>
					<?php 
					if(isset($program))
					{
					?>
						<input type="text" class="form-control" name="name" id="name" required="required" value="<?=$program['name']?>">
					<?php
					}
					else
					{
					?>
						<input type="text" class="form-control" name="name" id="name" required="required" value="">
					<?php
					} 
					?>
					
				</div>
				<div class="form-group">
					<label for="category">Choix de la catégorie :</label>
					<select class="form-control" id="category" name="category">
				      <?php
				      while($category = $categoryList->fetch())
				      {
				      ?>
				      	<option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
				      <?php
				      }
				      ?>
				    </select>
				</div>
				<div class="form-group">
					<label for="extract">Extrait (255 caractères max) :</label>
					<?php 
					if(isset($program['extract']))
					{
					?>
						<textarea class="form-control" name="extract" id="extract" maxlength="255" rows="3" required="required"><?=$program['extract'];?></textarea>
					<?php
					}
					else
					{
					?>
						<textarea class="form-control" name="extract" id="extract" maxlength="255" rows="3" required="required"></textarea>
					<?php
					} 
					?>
				</div>
				<div class="form-group">
					<label for="description">Description :</label>
					<?php 
					if(isset($program['description']))
					{
					?>
						<textarea class="form-control" name="description" id="description" rows="5" required="required"><?=$program['description']?></textarea>
					<?php
					}
					else
					{
					?>		
						<textarea class="form-control" name="description" id="description" rows="5" required="required"></textarea>
					<?php
					}
					?>			
				</div>
				<div class="form-group">
					<label for="good_point">Les bons points :</label>
					<?php 
					if(isset($program['good_point']))
					{
					?>
						<textarea class="form-control" name="good_point" id="good_point" rows="3"><?=$program['good_point']?></textarea>
					<?php
					}
					else
					{
					?>
						<textarea class="form-control" name="good_point" id="good_point" rows="3"></textarea>
					<?php
					}
					?>
				</div>
				<div class="form-group">
					<label for="bad_point">Les mauvais points :</label>
					<?php 
					if(isset($program['bad_point']))
					{
					?>
						<textarea class="form-control" name="bad_point" id="bad_point" rows="3"><?=$program['bad_point']?></textarea>
					<?php
					}
					else
					{
					?>
						<textarea class="form-control" name="bad_point" id="bad_point" rows="3"></textarea>
					<?php
					}
					?>
				</div>
				<div class="form-group">
					<label for="program">Le programme :</label>
					<?php 
					if(isset($program['program']))
					{
					?>
						<textarea class="form-control" name="program" id="program" rows="8" required="required"><?=$program['program']?></textarea>
					<?php
					}
					else
					{
					?>
						<textarea class="form-control" name="program" id="program" rows="8" required="required"></textarea>
					<?php
					}
					?>
				</div>
				<?php
				if (isset($edit))
				{
				?>
					<button type="submit" class="btn btn-dark">Modifier <i class="fas fa-edit"></i></button>
				<?php
				}
				else
				{
				?>
					<button type="submit" class="btn btn-dark">Ajouter <i class="fas fa-plus-circle"></i></button>
				<?php
				}
				?>
			</form>
		</div>

<?php

$content = ob_get_clean();

require('template.php');