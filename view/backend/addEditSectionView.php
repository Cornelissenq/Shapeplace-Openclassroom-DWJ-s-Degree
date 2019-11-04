<?php
if (isset($section))
{
	$title = 'Modifier la section ' .$section['name'];
}
else
{
	$title = 'Ajout d\'une section';
}

ob_start();

?>
<div class="row">
	<div class="col-lg-12">
		<div class="row">
			<?php
			if (isset($section))
			{
			?>
				<h4 class="offset-lg-2 col-lg-8	">Modifier la section "<?=$section['name']?>" :</h4>
			<?php
			}
			else
			{
			?>
				<h4 class="offset-lg-4 col-lg-4">Ajout d'une section :</h4>
			<?php	
			}
			?>
		</div>
		<div class="row">
		<?php
		if (isset($edit))
		{
		?>
			<form action="index.php?action=editSection&amp;id=<?= $section['id'] ?>" method="post" class="offset-lg-1 col-lg-10" enctype="multipart/form-data">
		<?php	
		}
		else
		{
		?>
			<form action="index.php?action=addSection" method="post" class="offset-lg-1 col-lg-10" enctype="multipart/form-data">
		<?php
		}
				if (isset($section['img']))
				{
				?>
					<img src="<?=$section['img']?>" alt="<?=$section['name']?>" class="offset-lg-4 col-lg-4">
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
					if(isset($edit))
					{
					?>
						<input type="text" class="form-control" name="name" id="name" required="required" value="<?=$section['name']?>">
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
					<label for="extract">Extrait (255 caractères max) :</label>
					<?php 
					if(isset($section['extract']))
					{
					?>
						<textarea class="form-control" name="extract" id="extract" maxlength="255" rows="3" required="required"><?=$section['extract'];?></textarea>
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
					<label for="content">Description :</label>
					<?php 
					if(isset($section['content']))
					{
					?>
						<textarea class="form-control" name="content" id="content" rows="7" required="required"><?=$section['content']?></textarea>
					<?php
					}
					else
					{
					?>		
						<textarea class="form-control" name="content" id="content" rows="7" required="required"></textarea>
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