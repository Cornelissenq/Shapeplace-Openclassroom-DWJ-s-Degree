<?php

$title = 'Gestion des programmes';

ob_start();

?>

<div class="row">
	<div class="col-lg-12">

		<div class="row">
			<h4 class="offset-lg-4 col-lg-4">Gestion des programmes :</h4>
		</div>
		<div class="row">
			<a href="../ajouterProgramme/" class="offset-lg-10 col-lg-2 btn btn-dark addBtn">Ajouter <i class="fas fa-plus-circle"></i></a>
		</div>
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th scope="col">N°</th>
					<th scope="col">N°Section</th>
					<th scope="col">Nom</th>
					<th scope="col">Extrait</th>
					<th scope="col">Modifier</th>
					<th scope="col">Supprimer</th>
				</tr>
			</thead>
			<tbody>
				<?php
				while($program = $list->fetch())
				{
				?>
					<tr>
						<th scope="row"><a class="bulleNum" href="../programme/<?= $program['id_section'] ?>-<?= $program['id'] ?>" target="_blank"><?= $program['id'] ?></a></th>
						<th scope="row"><a class="bulleNum" href="../section/<?= $program['id_section'] ?>" target="_blank"><?= $program['id_section'] ?></a></th>
						<th><?= $program['name'] ?></th>
						<th class="leftAlign"><?= nl2br($program['extract']) ?></th>
						<th><a href="../modifierProgramme/<?= $program['id'] ?>" class="btn btn-outline-info"><i class="fas fa-edit"></i></a></th>
							
						<?php
						if($_SESSION['role'] == 'superAdmin')
						{
						?>
							<th><a href="../supprimerProgramme/<?= $program['id'] ?>" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer <?= $program['name'] ?>?')"><i class="fas fa-trash-alt"></i></a></th>
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