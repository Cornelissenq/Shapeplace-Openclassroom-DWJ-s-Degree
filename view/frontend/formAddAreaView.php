<?php 

$title = 'Ajouter un lieu';

ob_start();

?>

<div class="container contenant">
	<div class="row">
		<div class="col-12 col-lg-12" id="formAdd">
			<div class="row">
				<div class="col-lg-3">
					<form action="carte" method="post" class="buttonBack">
						<input type="hidden" name="lat" value="<?= $lat ?>">
						<input type="hidden" name="lng" value="<?= $lng ?>">
						<button type="submit" class="btn btn-info"> Retour à la carte </button>
					</form>
				</div>
			</div>
			<div class="row">
				<h4 class="offset-lg-3 col-lg-6" id="hArea">Ajouter un spot :</h4> 
			</div>
			
			<div class="row">
				<div class="offset-lg-1 col-lg-10">
					<form action="ajouterSpot" class="formAddV" method="post">
						<div class="row">
							<div class="offset-1 col-10 offset-lg-3 col-lg-6" id="mymap">
								<script type="text/javascript">
									var mymap = L.map('mymap', {
				  						layers: MQ.mapLayer()
									});
	        						mymap.setView([<?=$lat ?>,<?=$lng?>], 15)
				        			var markerAddIcon = L.icon
									({
										iconUrl: "public/images/marker/markerAdd.png",
										iconSize: [50,50]
									});
				        			var markerAdd = L.marker([<?=$lat ?>,<?=$lng?>], {icon:markerAddIcon}).addTo(mymap);
								</script>
							</div>
						</div>
						<input type="hidden" name="lat" value="<?= $lat ?>">
						<input type="hidden" name="lng" value="<?= $lng ?>">

						<div class="form-group row">
							<label for="name" class="col-lg-3"> Nom du spot : </label>
							<div class="col-lg-9">
								<input type="text" id="name" name="name" class="form-control" required>
							</div> 
						</div>

						
						<div class="form-group row">
							<label for="content" class="col-lg-3">Description du spot :</label>
							<div class="col-lg-9">
								<textarea id="content" name="content" class="form-control" rows="3" required></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="city" class="col-lg-3">Ville :</label>
							<div class="col-lg-9">
								<input type="text" id="city" name="city" class="form-control" required>
							</div>
						</div>
						
						<fieldset class="form-group">
			    			<div class="row"> 
			      				<legend class="col-form-label col-lg-3">Catégorie :</legend>
			      				<div class="col-lg-9">
			      					<select class="form-control" id="category" name="category">
				      					<?php
				      					while($category = $listCategory->fetch())
				      					{
				      					?>
									       	<option value="<?= $category['id'] ?>"><?= $category['type'] ?></option>
									    <?php
				      					}
										?>
									</select>
							    </div>
							</div>
						</fieldset>
						<button type="submit" class="btn btn-outline-info">Ajouter <i class="fas fa-plus-circle"></i></button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php

$content=ob_get_clean();

require('template.php');