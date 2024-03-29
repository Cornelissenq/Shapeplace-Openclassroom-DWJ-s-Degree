<?php 

$title = 'Carte';

ob_start();

?>
<div class="container contenant">
	

	<div class="row">
		<div class="col-lg-12">
			<div class="row">
				<div class="offset-1 col-11 offset-lg-1 col-lg-6 formMap" id="formMap">
					<form action='carte' method='post'>
						<div class="form-group row">
							<?php
							if (isset($location))
							{
							?>
								<input type="text" name="search" id="search" class="col-9 form-control" value="<?= htmlspecialchars($location) ?>" required="required">
							<?php
							}
							else
							{
							?>
								<input type="text" name="search" id="search" class="col-9 form-control" value="" placeholder="Adresse, Ville CP" required="required">
							<?php
							}
							?>
							<button type="submit" class="btn btn-outline-success"><i class="fas fa-search"></i></button>
						</div>
					</form>
				</div>
			</div>
			<div class="row">	
				<div class="col-lg-12" id="map">
					
					<script type="text/javascript">
						<?php
						if (isset($location))
						{
						?>
							var map = L.map('map', {
				  				layers: MQ.mapLayer()
							});
						
							MQ.geocode().search('<?= htmlspecialchars($location) ?>').on('success', function(e) 
							{
				  				var best = e.result.best,
				    			latlng = best.latlng;

				 				map.setView(latlng, 14);
							});
						<?php
						}
						else
						{
						?>
							var map = L.map('map', {
				  				layers: MQ.mapLayer()
							});
							map.setView([<?=$lat?>,<?=$lng?>], 14)
						<?php
						}
						?>
			
						var markerOne = L.icon
						({
							iconUrl: "public/images/marker/1.png",
							iconSize: [50,50]
						});
						var markerTwo = L.icon
						({
							iconUrl: "public/images/marker/2.png",
							iconSize: [50,50]
						});
						var markerThree = L.icon
						({
							iconUrl: "public/images/marker/3.png",
							iconSize: [50,50]
						});
						var markerFour = L.icon
						({
							iconUrl: "public/images/marker/4.png",
							iconSize: [50,50]
						});
						var markerAddIcon = L.icon
						({
							iconUrl: "public/images/marker/markerAdd.png",
							iconSize: [50,50]
						});

						var markerAdd = null;

						function onMapClick(e) {
							
							if (markerAdd != null) 
							{
			              		map.removeLayer(markerAdd);
			              		markerAdd = null;
			        		};
							markerAdd = L.marker([e.latlng.lat,e.latlng.lng], {icon:markerAddIcon}).addTo(map);
							$( "#areaAddBtn" ).prop( "disabled", false );
							$('#lat').val(e.latlng.lat);
							$('#lng').val(e.latlng.lng);
						}

						map.on('click', onMapClick);

						<?php
						while($marker = $markers->fetch())
						{
							if($marker['id_category'] === "1")
							{
							?>
								var marker = L.marker([<?= $marker['lat']?>,<?= $marker['lng'] ?>], {icon:markerOne}).addTo(map);

								marker.addEventListener("click",function()
								{
									$(location).attr('href', 'spot-<?=$marker['url_slug']?>-<?=$marker['id']?>');	
								});

							<?php
							}
							elseif($marker['id_category'] === "2")
							{
							?>
								var marker = L.marker([<?= $marker['lat']?>,<?= $marker['lng'] ?>], {icon:markerTwo}).addTo(map);

								marker.addEventListener("click",function()
								{
									$(location).attr('href', 'spot-<?=$marker['url_slug']?>-<?=$marker['id']?>');	
								});
							<?php
							}
							elseif($marker['id_category'] === "3")
							{
							?>
								var marker = L.marker([<?= $marker['lat']?>,<?= $marker['lng'] ?>], {icon:markerThree}).addTo(map);

								marker.addEventListener("click",function()
								{
									$(location).attr('href', 'spot-<?=$marker['url_slug']?>-<?=$marker['id']?>');	
								});
							<?php
							}
							elseif($marker['id_category'] === "4")
							{
							?>
								var marker = L.marker([<?= $marker['lat']?>,<?= $marker['lng'] ?>], {icon:markerFour}).addTo(map);

								marker.addEventListener("click",function()
								{
									$(location).attr('href', 'spot-<?=$marker['url_slug']?>-<?=$marker['id']?>');	
								});
							<?php
							}
						}
						?>
						
					</script>	
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-5">
			<form action="ajouterSpot" method="post">
				<input type="hidden" name="lat" id="lat" value="">
				<input type="hidden" name="lng" id="lng" value="">
				<button type="submit" id="areaAddBtn"disabled><i class="fas fa-plus-circle"></i> Ajouter un spot</button>
			</form>
		</div>
	</div>
</div>
<?php

$content = ob_get_clean();

require('template.php');
