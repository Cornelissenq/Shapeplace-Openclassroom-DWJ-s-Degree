<?php

$title = $area['name'];

ob_start();

?>

<div class="container contenant">
	<div class="row">
		<div class="col-lg-12" id="areaView">
			<div class="row">
				<div class="col-5 col-lg-3 buttonBack">
					<form action="../carte/" method="post">
						<input type="hidden" name="lat" value="<?= $area['lat'] ?>">
						<input type="hidden" name="lng" value="<?= $area['lng'] ?>">
						<button type="submit" class="btn btn-info"> Retour à la carte </button>
					</form>
				</div>
				<div class="offset-2 col-5 offset-lg-2 col-lg-7 categoryArea">
					<p>Catégorie : <?= $area['type'] ?></p>
				</div>
			</div>
			<div class="row">
				<div class="offset-2 col-8 offset-lg-3 col-lg-6">
					
					<h4 id="hArea"><?= $area['name'] ?></h4>
				</div>
			</div>
			<div class="row">
				<div class="offset-1 col-10 offset-lg-3 col-lg-6" id="mymap">
					<script type="text/javascript">
						var mymap = L.map('mymap', {
				  				layers: MQ.mapLayer()
						});
	        			mymap.setView([<?=$area['lat'] ?>,<?=$area['lng']?>], 15)

	        			<?php
	        			if ($area['id_category'] === "1")
	        			{
	        			?>
	        				var markerIcon = L.icon
							({
								iconUrl: "../public/images/marker/1.png",
								iconSize: [50,50]
							});
	        				var marker = L.marker([<?=$area['lat'] ?>,<?=$area['lng']?>], {icon:markerIcon}).addTo(mymap);
	        			<?php
	        			}
	        			elseif ($area['id_category'] === "2")
	        			{
	        			?>
	        				var markerIcon = L.icon
							({
								iconUrl: "../public/images/marker/2.png",
								iconSize: [50,50]
							});
	        				var marker = L.marker([<?=$area['lat'] ?>,<?=$area['lng']?>], {icon:markerIcon}).addTo(mymap);
	        			<?php
	        			}
	        			elseif ($area['id_category'] === "3")
	        			{
	        			?>
	        				var markerIcon = L.icon
							({
								iconUrl: "../public/images/marker/3.png",
								iconSize: [50,50]
							});
	        				var marker = L.marker([<?=$area['lat'] ?>,<?=$area['lng']?>], {icon:markerIcon}).addTo(mymap);
	        			<?php
	        			}
	        			elseif ($area['id_category'] === "4")
	        			{
	        			?>
	        				var markerIcon = L.icon
							({
								iconUrl: "../public/images/marker/4.png",
								iconSize: [50,50]
							});
	        				var marker = L.marker([<?=$area['lat'] ?>,<?=$area['lng']?>], {icon:markerIcon}).addTo(mymap);
	        			<?php
	        			}
	        			?>
	        				
					</script>
				</div>
			</div>

			<div class="row">
				<div class="offset-lg-1 col-lg-10" id="textArea">
					<?php 
					if (isset($avgNote['avg']))
					{
					?>
						<div class="row">
							<div class="offset-3 col-6 offset-lg-5 col-lg-2">
								<div class="starSpot">
									<div class="starNote" style="width: calc( (<?= $avgNote['avg'] ?> * 100%) / 5 )"></div>
								</div>
							</div>
						</div>
					<?php
					}
					?>
					
					<div class="row">
						<h6 class="offset-1 col-6 col-lg-3">La description du spot :</h6>
					</div>
					<div class="row">
						<div class="offset-1 col-10 offset-lg-2 col-lg-8" id="contentArea">
							<p><?= nl2br($area['content']) ?></p>
						</div>
					</div>

						
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 formComment">
			<div class="row">
				<div class="offset-lg-4 col-lg-4">
					<button type="button" id="enableFormComment" class="btn btn-info">Ajouter un avis</button>
				</div>
			</div>	
			<div class="row">
				<div class="col-lg-12" id="formComment">
					<?php if (isset($_SESSION['id_user']))
					{	
					?>
						<form action="../ajouterNote/<?=$area['id']?>" method="post">
							<fieldset class="form-group">
	    						<div class="row">
	      							<legend class="col-form-label col-sm-2 pt-0">Note</legend>
	      							<div class="col-sm-10">
	      								<div class="form-check-inline">
					       					<input class="form-check-input" type="radio" name="noteArea" id="noteArea0" value="0" checked>
					   						<label class="form-check-label" for="noteArea0">0</label>
					       				</div>
										<div class="form-check-inline">				       					
											<input class="form-check-input" type="radio" name="noteArea" id="noteArea1" value="1" checked>
					   						<label class="form-check-label" for="noteArea1">1</label>
					       				</div>
				        				<div class="form-check-inline">
				          					<input class="form-check-input" type="radio" name="noteArea" id="noteArea2" value="2" checked>
				          					<label class="form-check-label" for="noteArea2">2</label>
				        				</div>
					        			<div class="form-check-inline">
				          					<input class="form-check-input" type="radio" name="noteArea" id="noteArea3" value="3" checked>
				       						<label class="form-check-label" for="noteArea3">3</label>
					       				</div>
					       				<div class="form-check-inline">
				       						<input class="form-check-input" type="radio" name="noteArea" id="noteArea4" value="4" checked>
				       						<label class="form-check-label" for="noteArea4">4</label>
					       				</div>
					   	   				<div class="form-check-inline">
					   						<input class="form-check-input" type="radio" name="noteArea" id="noteArea5" value="5" checked>
				          					<label class="form-check-label" for="noteAream5">5</label>
				       					</div>
				        			</div>
				        		</div>
				        	</fieldset>
				        	<fieldset class="form-group">
				        		<div class="row">
				        			<legend class="col-form-label col-sm-2" id="commentArea">Avis</legend>
				        			<div class="col-sm-10">
				        				<div class="form-group">
				        					<textarea class="form-control" name="content" id="commentArea" rows="3"></textarea>
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
						<p class="noLogin">Vous devez vous identifier afin de pouvoir publier un avis.</p>
						<div class="row">
							<div class="offset-lg-4 col-lg-4">
								<a href="../login/" class="btn btn-outline-danger"> Identification </a>
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
		<div class="col-lg-12 cadreNote">
			<div class="titleNote">
				<h5> Avis : </h5>
			</div>
			<?php 	
			while($note = $notes->fetch())
			{
			?>
				<div class="row">
					<div class="offset-1 col-10 offset-lg-0 col-lg-12">
						<div class="row headerNote">
							<div class="star" id="star">
								<div class="starNote" style="width: calc( (<?= $note['note'] ?> * 100%) / 5 )"></div>
							</div>
							<div class="col-3 col-lg-4 pseudoNote">
								<a href="../profil/<?=$note['id_user']?>" target="_blank"><?=$note['pseudo']?></a>
							</div>
							<div class="col-5 col-lg-3 dateNote">
								<p> Écrit le <?=$note['date_creation_fr']?></p>
							</div>
							<?php
							if (isset($_SESSION['id_user']))
							{
								if ($_SESSION['id_user'] === $note['id_user'])
								{
								?>
									<div class="col-1 offset-lg-2 col-lg-2 btnNote">
										<a href="../supprimerNote/<?=$note['id']?>" class="btn btn-outline-danger" onclick="return confirm('Voulez-vous supprimer votre avis ?');"><i class="far fa-trash-alt"></i></a>
									</div>
								<?php
								}	
							}
							?>
						</div>
						<div class="row contentNote">
							<a href="../profil/<?=$note['id_user']?>" target="_blank" class="col-1 col-lg-1"><img src="../<?=$note['avatar']?>" alt="<?=$note['pseudo']?>" class="imgNote"></a>
							<div class="offset-1 col-9 offset-lg-1 col-lg-9">
								<p><?= nl2br($note['content']) ?></p>
							</div>
						</div>
					</div>
				</div>
			<?php 
			}
			?>
		</div>
	</div>
</div>

<?php

$content = ob_get_clean();

require('template.php');