<?php

$title = 'Gestion des utilisateurs';

ob_start();

?>

	<div class="row">
		<div class="col-lg-12">
			<div class="row">
				<h4 class="offset-lg-4 col-lg-4">Gestion des utilisateurs :</h4>
			</div>
			<table class="table table-striped">
				<thead class="thead-dark">
					<tr>
						<th scope="col">Avatar</th>
						<th scope="col">Pseudo</th>
						<th scope="col">Promouvoir</th>
						<th scope="col">Rétrograder</th>
						<th scope="col">Supprimer</th>
					</tr>
				</thead>
				<tbody>
					<?php
					while($user = $list->fetch())
					{
						if($user['role'] != 'superAdmin')
						{
						?>
							<tr>
								<th scope="row" class="imgTableUser"><a href="../profil-<?= $user['id'] ?>"><img src="../<?= $user['avatar'] ?>" alt="<?= $user['pseudo'] ?>" /></a></th>
								<th><?= $user['pseudo'] ?></th>
								<?php
								if($user['role'] != 'admin')
								{
								?>
									<th><a href="../donnerDroits/<?= $user['id'] ?>" class="btn btn-outline-success" onclick="return confirm('Voulez-vous promouvoir <?= $user['pseudo'] ?>?')";><i class="fas fa-user-plus"></i></a></th>
								<?php
								}
								else
								{
								?>
									<th></th>
								<?php
								}
								if($user['role'] != 'user')
								{
								?>
									<th><a href="../enleverDroits/<?= $user['id'] ?>" class="btn btn-outline-warning" onclick="return confirm('Voulez-vous rétrograder <?= $user['pseudo'] ?>?')";><i class="fas fa-user-minus"></i></a></th>
								<?php
								}
								else
								{
								?>
									<th></th>
								<?php
								}
								?>
								<th><a href="../supprimerUtilisateur/<?= $user['id'] ?>" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer <?= $user['pseudo'] ?>?')"><i class="fas fa-trash-alt"></i></a></th>
							</tr>
						<?php
						}
					}
					?>	
				</tbody>
			</table>
		</div>
	</div>



<?php

$content = ob_get_clean();

require('template.php');