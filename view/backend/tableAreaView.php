<?php

$title = 'Gestion des spots';

ob_start();

?>

<div class="row">
	<div class="col-lg-12">
		<div class="row">
			<h4 class="offset-lg-4 col-lg-4">Gestion des spots :</h4>
		</div>

		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th scope="col">N°</th>
					<th scope="col">Ville</th>
					<th scope="col">Nom</th>
					<th scope="col">Description</th>
					<th scope="col">Modifier</th>
					<th scope="col">Supprimer</th>
				</tr>
			</thead>
			<tbody>
				<?php
				while($area = $list->fetch())
				{
				?>
					<tr>
						<th scope="row"><a class="bulleNum" href="index.php?action=area&amp;id=<?= $area['id'] ?>&amp;search=<?= $area['city'] ?>"  target="_blank"><?= $area['id'] ?></a></th>
						<th scope="row"><?= $area['city'] ?></th>
						<th><?= $area['name'] ?></th>
						<th class="leftAlign"><?= nl2br($area['content']) ?></th>
						<th><a href="index.php?action=editSpot&amp;id=<?= $area['id'] ?>" class="btn btn-outline-info"><i class="fas fa-edit"></i></a></th>
							
						<?php
						if($_SESSION['role'] == 'superAdmin')
						{
						?>
							<th><a href="index.php?action=deleteSpot&amp;id=<?= $area['id'] ?>" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer le spot <?= $area['name'] ?>?')"><i class="fas fa-trash-alt"></i></a></th>
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