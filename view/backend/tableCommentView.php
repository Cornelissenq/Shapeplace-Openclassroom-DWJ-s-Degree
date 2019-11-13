<?php

$title = 'Gestion des commentaires';

ob_start();

?>

<div class="row">
	<div class="col-lg-12">
		<div class="row">
			<h4 class="offset-lg-4 col-lg-4">Gestion des commentaires :</h4>
		</div>
		<div class="row">
			<a href="../adminReportedComment/" class="offset-lg-10 col-lg-2 btn btn-dark addBtn"><?= $count['nbr'] ?> Commentaire(s) signalé(s)</a>
		</div>
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th scope="col">N°</th>
					<th scope="col">Programme</th>
					<th scope="col">Pseudo</th>
					<th scope="col">Commentaire</th>
					<th scope="col">Supprimer</th>
				</tr>
			</thead>
			<tbody>
				<?php
				while($comment = $list->fetch())
				{
				?>
					<tr>
						<th scope="row"><p><?= $comment['id'] ?></p></th>
						<th scope="row"><a class="bulleNum" href="../programme-<?= $comment['id_program'] ?>-<?= $comment['id_section'] ?>#<?= $comment['id'] ?>" target="_blank"> <?= $comment['id_program'] ?></a></th>
						<th><?= $comment['pseudo'] ?></th>
						<th class="leftAlign"><?= nl2br($comment['comment']) ?></th>	
						<?php
						if($_SESSION['role'] == 'superAdmin')
						{
						?>
							<th><a href="../deleteAdminComment/<?= $comment['id'] ?>" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer le commentaire de <?= $comment['pseudo'] ?>?')"><i class="fas fa-trash-alt"></i></a></th>
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