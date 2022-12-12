<?php $this->view("header", $data); ?>

        
    <section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form method="POST">
							<!--/php to not lose the name and email fields when submitting-->
							<input name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : ""; ?>" type="text" placeholder="Name"/>
							<input name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : ""; ?>" type="email" placeholder="Email Address"/>
							<input name="password" type="password" placeholder="Password"/>
                            <input name="password2" type="password" placeholder="Confirmer votre mot de passe"/>
							<?php check_error() ?>
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
						
					</div><!--/sign up form-->
					<br>
						<p class="">Vous avez déja un compte ? <a href="<?=ROOT?>login">Se connecter</a></p>
					
				</div>
			</div>
		</div>
	</section><!--/form-->
	
	<?php $this->view("footer",$data); ?>