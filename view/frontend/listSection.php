<?php
$title = 'Les sections';

ob_start();

?>
<div class="container contenant">
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
					<div class="offset-1 col-10 offset-lg-0 col-lg-12 cadreSection">
						<div class="row ">
							<div class="col-lg-12 imgSection">
								<a href="../section/<?=$section['id']?>"><img src="../<?= $section['img']?>" alt="<?= $section['name'] ?>"</></a>
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
										<a href="../section/<?=$section['id']?>" class="btn btn-info">Accéder</a>
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
</div>

<?php

$content = ob_get_clean();

require('template.php');
?>