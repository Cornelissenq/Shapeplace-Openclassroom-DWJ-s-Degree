<?php
$title = 'Les sections';

ob_start();

?>
<div class="row">
	<div class="offset-lg-2 col-lg-8">
		<h2 class="mainTitleSection"> Trouver le programme adapté :</h2>
	</div>
</div>
<div class="row">
	<?php
	while ($section = $sections->fetch())
	{
	?>
		<div class="col-lg-4 Section">
			<div class="row">
				<div class="offset-lg-2 col-lg-8 cadreSection">
					<div class="row ">
						<div class="col-lg-12 imgSection">
							<a href="index.php?action=list&amp;id=<?=$section['id']?>"><img src="<?= $section['img']?>" alt="<?= $section['name'] ?>"</></a>
						</div>
					</div>
					<div class="row whiteBg">
						<div class="col-lg-12 blockSection section<?=$section['id']?>">
							<div class="row">
								<div class="offset-lg-1 col-lg-10">
									<h5 class="titleSection"><i class="fas fa-angle-right"></i> <?= $section['name']?> :</h5>
								</div>
							</div>
							<div class="row">
								<div class="offset-lg-1 col-lg-10">
									<p class="extractSection"><?=$section['extract']?></p>
								</div>
							</div>
							<div class="row btnSection">
								<div class="offset-lg-6 col-lg-5">
									<a href="index.php?action=list&amp;id=<?=$section['id']?>" class="btn btn-info">Accéder</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
	?>
</div>

<?php

$content = ob_get_clean();

require('template.php');
?>