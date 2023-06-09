<div class="container">
	<div>
		<h3>Gestionnaire de réinitialisation de mot de passe</h3>
		<small class="text-muted">
			S'il vous plaît fournir l'adresse email valide que vous avez utilisé pour vous inscrire
		</small>
	</div>
	<hr />
	<div class="row">
		<div class="col-md-8">
			<?php 
				$this :: display_page_errors(); 
			?>
			<form method="post" action="<?php print_link("passwordmanager/postresetlink"); ?>">
				<div class="row">
					<div class="col-9">
						<input value="<?php echo get_form_field_value('email'); ?>" placeholder="Enter Your Email Address" required="required" class="form-control default" name="email" type="email" />
					</div>
					<div class="col-3">
						<button class="btn btn-success" type="submit"> Envoyer <i class="fa fa-envelope"></i></button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<br />
	<div class="text-info">
		Un lien sera envoyé à votre email contenant les informations dont vous avez besoin pour votre mot de passe
	</div>
</div>




