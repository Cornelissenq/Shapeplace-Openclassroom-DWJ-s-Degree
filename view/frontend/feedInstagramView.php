<?php

$title = 'Espace Communautaire';

ob_start();

?>
<div class="container contenant">
	<div class="cadreSocialNetwork col-lg-12">
		<div class="row">
			<div class="offset-lg-2 col-lg-8">
				<h4>Intéragit avec les membres de la communauté !</h4>
			</div>
		</div>
		<div class="row">
			<div class="offset-lg-1 col-lg-10">
				<p>A l'aide de ton compte instagram partage ton évolution ou ta session avec le hashtag #shaplace et il sera affiché sur le site !</p>
			</div>
		</div>
		<div class="row">
			<div class="offset-lg-1 col-lg-10">
				<iframe src="//lightwidget.com/widgets/a843d8b8d2dd5011bc9d6f90797f50a3.html" scrolling="no" allowtransparency="true" class="lightwidget-widget" style="width:100%;border:0;overflow:hidden;"></iframe>
			</div>
		</div>
	</div>
</div>



<?php

$content = ob_get_clean();

require('template.php');

