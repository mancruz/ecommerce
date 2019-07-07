<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="row">
		<div class="col-md-6">
			<div class="card ">
				<div class="card-header card-header-primary card-header-icon">
					<div class="card-icon">
						<i class="material-icons">lock_outline</i>
					</div>
					<h4 class="card-title">Trocar Senha</h4>
				</div>
				<div class="card-body ">
						<?php if( $changePassError != '' ){ ?>
						<div class="alert alert-danger">
							<?php echo htmlspecialchars( $changePassError, ENT_COMPAT, 'UTF-8', FALSE ); ?>
						</div>
						<br>
						<?php } ?>

						<?php if( $chagePassSucess != '' ){ ?>
						<div class="alert alert-success">
								<?php echo htmlspecialchars( $chagePassSucess, ENT_COMPAT, 'UTF-8', FALSE ); ?>
							</div>
							
						<br>
						<?php } ?>
					<form method="POST" action="/admin/trocar-senha">
						<div class="form-group bmd-form-group">
							<label for="current_pass" class="bmd-label-floating">Senha atual</label>
							<input type="password" class="form-control" id="current_pass" name="current_pass" requerid autofocus>
						</div>
						<div class="form-group bmd-form-group">
							<label for="new-pass" class="bmd-label-floating">Nova senha</label>
							<input type="password" class="form-control" id="new-pass" name="new-pass">
						</div>
						<div class="form-group bmd-form-group">
								<label for="confirm-pass" class="bmd-label-floating">Confirme a nova senha</label>
								<input type="password" class="form-control" id="confirm-pass" name="confirm-pass">
							</div>

					
				</div>
				<div class="card-footer ">
						<button class="btn btn-primary pull-right">
								<span class="btn-label">
									<i class="material-icons">save</i>
								</span>
								Atualizar
							</button>
				</div>
			</form>
			</div>
		</div>

	</div>