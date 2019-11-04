<?php

$title = 'Gestion des sections';

ob_start();

?>

<div class="row">
	<div class="col-lg-12">
		<div class="row">
			<h4 class="offset-lg-4 col-lg-4">Gestion des sections :</h4>
		</div>
		<div class="row">
			<a href="index.php?action=addSection" class="offset-lg-10 col-lg-2 btn btn-dark addBtn">Ajouter <i class="fas fa-plus-circle"></i></a>
		</div>
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th scope="col">N°</th>
					<th scope="col">Nom</th>
					<th scope="col">Extrait</th>
					<th scope="col">Modifier</th>
					<th scope="col">Supprimer</th>
				</tr>
			</thead>
			<tbody>
				<?php
				while($section = $list->fetch())
				{
				?>
					<tr>
						<th scope="row"><a class="bulleNum" href="index.php?action=list&amp;id=<?= $section['id'] ?>" target="_blank"><?= $section['id'] ?></a></th>
						<th><?= $section['name'] ?></th>
						<th class="leftAlign"><?= nl2br($section['extract']) ?></th>
						<th><a href="index.php?action=editSection&amp;id=<?= $section['id'] ?>" class="btn btn-outline-info"><i class="fas fa-edit"></i></a></th>
							
						<?php
						if($_SESSION['role'] == 'superAdmin')
						{
						?>
							<th><a href="index.php?action=deleteSection&amp;id=<?= $section['id'] ?>" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer <?= $section['name'] ?>?')"><i class="fas fa-trash-alt"></i></a></th>
						<?php
						}
						else
						{
						?>
							<th></th>
						<?php
						}
						?>
					</tr>
				<?php
				}
				?>	
			</tbody>
		</table>
	</div>
</div>

<?php

$content = ob_get_clean();

require('template.php');