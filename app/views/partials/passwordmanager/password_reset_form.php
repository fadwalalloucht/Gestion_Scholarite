<div class="container">
	<h3>Gestionnaire de réinitialisation de mot de passe</h3>
	<hr />
	<div class="row">
		<div class="col-sm-6">
			<h4>Fournir un nouveau mot de passe</h4>
			<hr />
			<form method="post" action="<?php print_link(get_current_url()); ?>">
				<?php 
					$this :: display_page_errors();			
				?>
				<div class="form-group">
					<label>nouveau mot de passe</label>
					<input placeholder="Your New Password" required="required" value="" class="form-control default" name="password" id="txtpass" type="password" />
					<strong class="help-block">Astuces: Pas moins de 6 caractères </strong>
				</div>
				<div class="form-group">
					<label>Confirmer le nouveau mot de passe</label>
					<input placeholder="Confirm Password" required="required" class="form-control default" name="cpassword" id="txtcpass" type="password" />
				</div>
				<div class="mt-2 "><button  class="btn btn-success" type="submit">Changer le mot de passe</button></div>
			</form>
		</div>
	</div>
</div>
