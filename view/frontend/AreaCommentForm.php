
					<form action="index.php?action=addCommentA&amp;id=<?=$area['id']?>" method="post">
						<fieldset class="form-group">
    						<div class="row">
      							<legend class="col-form-label col-sm-2 pt-0">Note</legend>
      							<div class="col-sm-10">
      								<div class="form-check-inline">
				       					<input class="form-check-input" type="radio" name="noteArea" id="noteArea0" value="option0" checked>
				   						<label class="form-check-label" for="noteArea0">0</label>
				       				</div>
									<div class="form-check-inline">				       					
										<input class="form-check-input" type="radio" name="noteArea" id="noteArea1" value="option2" checked>
				   						<label class="form-check-label" for="noteArea1">1</label>
				       				</div>
			        				<div class="form-check-inline">
			          					<input class="form-check-input" type="radio" name="noteArea" id="noteArea2" value="option3" checked>
			          					<label class="form-check-label" for="noteArea2">2</label>
			        				</div>
				        			<div class="form-check-inline">
			          					<input class="form-check-input" type="radio" name="noteArea" id="noteArea3" value="option4" checked>
			       						<label class="form-check-label" for="noteArea3">3</label>
				       				</div>
				       				<div class="form-check-inline">
			       						<input class="form-check-input" type="radio" name="noteArea" id="noteArea4" value="option5" checked>
			       						<label class="form-check-label" for="noteArea4">4</label>
				       				</div>
				   	   				<div class="form-check-inline">
				   						<input class="form-check-input" type="radio" name="noteArea" id="noteArea5" value="option6" checked>
			          					<label class="form-check-label" for="noteAream5">5</label>
			       					</div>
			        			</div>
			        		</div>
			        	</fieldset>
			        	<fieldset class="form-group">
			        		<div class="row">
			        			<legend class="col-form-label col-sm-2 pt-0">Avis</legend>
			        			<div class="col-sm-10">
			        				<div class="form-group">
			        					<textarea class="form-control" name="comment" id="commentArea" rows="3"></textarea>
			        				</div>
			        			</div>
			        		</div>
			        	</fieldset>
			        	<button type="submit" class="btn btn-outline-info">Envoyer</button>
			        </form>