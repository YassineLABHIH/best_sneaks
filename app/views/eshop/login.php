<?php $this->view("header", $data); ?>

	<section id="form"><!--form-->
		<div class="container">
			<div class="row mx-auto">
				<div class="col-sm-4 col-sm-offset-4">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<?php check_signup_message() ?>
						<form method="POST">
							<input type="email" name="email" placeholder="Email" />
							<input type="password" name="password" placeholder="Password" />
							<span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span>
							<button type="submit" class="btn btn-default">Login</button>
						</form>
						<br>
						 <p>Vous n'avez pas de compte ? <a href="<?=ROOT?>signup">S'inscrire ici</a></p>
					</div><!--/login form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
	<?php $this->view("footer",$data); ?>