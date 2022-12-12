<?php $this->view("header", $data); ?>

	<section id="form"><!--form-->
		<div class="container">
			<div class="row mx-auto">
				<div class="col-sm-4 col-sm-offset-4">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<?php check_signup_message() ?>
						<form method="POST">
							<!--/php to not lose the name and email fields when submitting-->
							<input type="email" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : ""; ?>" placeholder="Email" />
							<input type="password" name="password" value="<?= isset($_POST['password']) ? $_POST['password'] : ""; ?>" placeholder="Password" />
							<button type="submit" class="btn btn-default">Login</button>
						</form>
						<br>
						 <p class="">Vous n'avez pas de compte ? <a href="<?=ROOT?>signup">S'inscrire ici</a></p>

						 <div class="text-center text-danger">
							<?php check_error() ?>
							</div>
					</div><!--/login form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
	<?php $this->view("footer",$data); ?>