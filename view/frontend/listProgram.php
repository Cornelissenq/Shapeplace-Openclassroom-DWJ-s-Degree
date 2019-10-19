<?php
$title = $section['name'] ;

session_start();

ob_start();

?>

<div class="row">
	<div class="col-lg-12 cadreTitle">
		<div class="row">
			<div class="col-lg-3 backSection">
				<a href="index.php?action=section" class="btn btn-light"><i class="fas fa-arrow-circle-left"></i></a>
			</div>
		</div>
		<div class='row'>
			<div class="offset-lg-3 col-lg-6">
				<h2 class="titreSection"><?= $section['name'] ?> : </h2>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 contentSection">
		<div class="row">
			<div class="offset-lg-1 col-lg-10">
				<p><?= nl2br($section['content']) ?></p>
			</div>
		</div>		
	</div>
</div>

<div class="row">
	<?php 
	while($program = $programs->fetch())
	{
	?>
		<div class="col-lg-4">
			<div class="row">
				<div class="offset-lg-2 col-lg-8 cadreProgram">
					<div class="row">
						<div class="offset-lg-1">
							<h5 class="titleProgram"><i class="fas fa-angle-right"></i> <?= $program['name'] ?> : </h5>
						</div>
					</div>
					<div class="row">
						<div class="offset-lg-1 col-lg-10">
							<p class="extractProgram"> <?= nl2br($program['extract']) ?> </p>
						</div>
					</div>
					<div class="row linkPgm">
						<div class="linkProgram offset-lg-5 col-lg-7 ">
							<a href="index.php?action=program&amp;id=<?=$program['id']?>&amp;section=<?=$program['id_section']?>" class="btn btn-info "><i class="fas fa-plus-circle"> Accéder</i></a>
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