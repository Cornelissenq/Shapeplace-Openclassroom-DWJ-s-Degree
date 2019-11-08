<?php

$title = 'Gestion des avis';

ob_start();

?>

<div class="row">
	<div class="col-lg-12">
		<div class="row">
			<h4 class="offset-lg-4 col-lg-4">Gestion des avis :</h4>
		</div>
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th scope="col">N°</th>
					<th scope="col">Pseudo</th>
					<th scope="col">Avis</th>
					<th scope="col">Note</th>
					<th scope="col">Supprimer</th>
				</tr>
			</thead>
			<tbody>
				<?php
				while($note = $list->fetch())
				{
				?>
					<tr>
						<th scope="row"><a class="bulleNum" href="../spot/<?= $note['id_area'] ?>" target="_blank"><?= $note['id'] ?></th>
						<th><?= $note['pseudo'] ?></th>
						<th class="leftAlign"><?= nl2br($note['content']) ?></th>
						<th>
							<div class="star">
								<div class="starNote" style="width: calc( (<?= $note['note'] ?> * 100%) / 5 )"></div>
							</div>
						</th>	
						<?php
						if($_SESSION['role'] == 'superAdmin')
						{
						?>
							<th><a href="../supprimerAvis/<?= $note['id'] ?>" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer l\'avis de <?= $note['pseudo'] ?>?')"><i class="fas fa-trash-alt"></i></a></th>
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