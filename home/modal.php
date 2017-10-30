<!-- Login form -->
	<div id="modal-login" class="modal fade">
		<div class="modal-dialog modal-xs">
			<div class="modal-content login-form">

				<!-- Form -->
				<form class="modal-body" id="myForm" method="POST" action="<?php echo base_url() ?>home/login">
					<div class="text-center">
						<div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
							<h5 class="content-group">Login to your account</h5>
						</div>

						<div class="form-group has-feedback has-feedback-left">
							<input type="text" class="form-control" name="username" placeholder="Username">
							<div class="form-control-feedback">
								<i class="icon-user text-muted"></i>
							</div>
						</div>

						<div class="form-group has-feedback has-feedback-left">
							<input type="password" class="form-control" name="password" placeholder="Password">
							<div class="form-control-feedback">
								<i class="icon-lock2 text-muted"></i>
							</div>
						</div>

						<div class="form-group">
							<button type="submit" id="login" class="btn bg-blue btn-block">Login <i class="icon-arrow-right14 position-right"></i></button>
						</div>
				</form>
								<!-- /form -->

			</div>
		</div>
	</div>
<!-- /login form -->