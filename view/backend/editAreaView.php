<?php

$title = 'Modifier le spot ' .$area['name'];

ob_start();

?>
<div class="row">
	<div class="col-lg-12">
		<div class="row">
			<div class="offset-lg-1 col-lg-3 btnBack">
				<a href='../adminSection/' class="btn btn-info">Revenir à la gestion des spots</a>
			</div>
		</div>
		<div class="row">
			<h4 class="offset-lg-2 col-lg-8">Modifier le spot "<?= $area['name'] ?>" :</h4>
		</div>
		<div class="row">
			<div class="offset-lg-3 col-lg-6" id="mymap">
				<script type="text/javascript">
					var osmLayer = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', { 
	       				attribution: '© OpenStreetMap contributors',
	        			maxZoom: 19,
	        			accessToken:'pk.eyJ1IjoiZmlzaDgxMTAwIiwiYSI6ImNqdzdxN2NnbDBuNDI0Ym80cnoxbzVicnIifQ.DTl4y65RoISbbNt1RtTzQg'
	        		});
	        		var mymap = L.map('mymap').setView([<?=$area['lat'] ?>,<?=$area['lng']?>], 15)
	        			mymap.addLayer(osmLayer);

	        		<?php
	        		if ($area['id_category'] === "1")
	        		{
	        		?>
	        			var markerIcon = L.icon
						({
							iconUrl: "public/images/marker/1.png",
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
							iconUrl: "public/images/marker/2.png",
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
							iconUrl: "public/images/marker/3.png",
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
							iconUrl: "public/images/marker/4.png",
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
			<form action="" method="post" class="offset-lg-1 col-lg-10">
				<div class="form-group">
					<label for="name">Nom du spot :</label>
					<input type="text" class="form-control" name="name" id="name" value="<?= $area['name'] ?>" required="required">
				</div>
				<div class="form-group">
					<label for="content">Description :</label>
					<textarea class="form-control" name="content" id="content" rows="3" required="required"><?= $area['content'] ?></textarea>
				</div>
				<div class="form-group">
					<label for="city">Ville :</label>
					<input type="text" class="form-control" name="city" id="city" value="<?= $area['city'] ?>" required="required">
				</div>
				<div class="form-group">
					<label for="id_category">Catégorie du spot :</label>
					<select class="form-control" id="id_category" name="id_category">
				      <option value="1">Barre de tractions</option>
				      <option value="2">Barre parallèles</option>
				      <option value="3">Parc de workout</option>
				      <option value="4">Escaliers</option>
				    </select>
				</div>
				<button type="submit" class="btn btn-dark">Modifier <i class="fas fa-edit"></i></button>
			</form>
		</div>

<?php

$content = ob_get_clean();

require('template.php');