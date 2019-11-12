<?php
$title = $section['name'] ;

ob_start();

?>
<div class="container contenant">
	<div class="row">
		<div class="col-lg-12 cadreTitle">
			<div class="row">
				<div class="col-lg-3 backListProgram">
					<a href="section" class="btn btn-light backSection"><i class="fas fa-arrow-circle-left"></i></a>
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
		$id = 1;
		while($program = $programs->fetch())
		{
		?>
			<div class="col-sm-6 col-lg-4 col-xl-3">
				<div class="row">
					<div class="offset-1 col-10 offset-lg-0 col-lg-12 cadreProgram">
						<div class="row">
							<div class="col-lg-12 imgProgram">
								<a href="programme-<?=$program['id']?>-<?=$program['id_section']?>"><img src="<?= $program['avatar']?>" alt="<?= $program['name'] ?>"/></a>
							</div>
						</div>
						<div class="row whiteBg">
							<div class="col-lg-12 blockProgram program<?=$id?>">
								<div class="row">
									<div class="offset-lg-1 col-lg-10">
										<h5 class="titleProgram"><i class="fas fa-angle-right"></i> <?= $program['name'] ?> : </h5>
									</div>
								</div>
								<div class="row">
									<div class="offset-lg-1 col-lg-10">
										<p class="extractProgram"> <?= nl2br($program['extract']) ?> </p>
									</div>
								</div>
								<div class="row linkPgm">
									<div class="offset-lg-4 col-lg-7 offset-xl-3 col-xl-8">
										<a href="programme-<?=$program['id']?>-<?=$program['id_section']?>" class="btn btn-info "><i class="fas fa-plus-circle"></i> Accéder</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php
		$id++;
		}
		?>
	</div>
</div>

<?php

$content = ob_get_clean();

require('template.php');

?>