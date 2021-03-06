<?php if(!class_exists('Rain\Tpl')){exit;}?>
<div class="content">

	<div class="col-md-12">
		<form role="form" action="/admin/funcionario/create" method="post">
			<input type="hidden" id="cod_func" name="cod_func" value = "<?php echo htmlspecialchars( $funcionario["cod_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
			<!-- card personal data -->
			<div class="card">
				<div class="card-header card-header-primary card-header-icon">
					<div class="card-icon">
						<i class="material-icons">perm_identity</i>
					</div>
					<h4 class="card-title">Dados Pessoais
					</h4>
				</div>
				<div class="card-body">            
					<!-- first line -->
					<div class="row">
						<div class="col-md-6">
							<div class="form-group bmd-form-group">
								<label class="bmd-label bmd-label-floating"> Nome *</label>
								<input
								id      ="nome_func"
								name    ="nome_func"
								type    ="text"
								class   ="form-control"
								required="true"
								value="<?php echo htmlspecialchars( $funcionario["nome_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
								autofocus
								>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group bmd-form-group">
								<label class="bmd-label-floating"> Nome Pessoal</label>
								<input
								id      ="apelido_func"
								name    ="apelido_func"
								type    ="text"
								class   ="form-control"
								value="<?php echo htmlspecialchars( $funcionario["apelido_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
								>
							</div>
						</div>
					</div>

					<!-- second line -->
					<div class="row">
						<div class="col-md-2">
							<div class="form-group bmd-form-group">
								<label class="bmd-label-floating"> Tel Residencial *</label>
								<input
								id      ="telefone_func"
								name    ="telefone_func"
								type    ="text"
								class   ="form-control maskPhone"
								value="<?php echo htmlspecialchars( $funcionario["telefone_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
								>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group bmd-form-group">
								<label class="bmd-label-floating"> Tel Celular</label>
								<input
								id      ="telefone_cel_func"
								name    ="telefone_cel_func"
								type    ="text"
								class   ="form-control maskCellPhone"
								value="<?php echo htmlspecialchars( $funcionario["telefone_cel_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"

								>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group bmd-form-group">
								<label class="bmd-label-floating"> Data Nascimento</label>
								<input
								id      ="dt_nasc_func"
								name    ="dt_nasc_func"
								type    ="text"
								class   ="form-control maskData"
								value	="<?php echo htmlspecialchars( $funcionario["dt_nasc_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"

								>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group bmd-form-group">
								<label class="bmd-label-floating"> RG</label>
								<input
								id      ="rg_func"
								name    ="rg_func"
								type    ="text"
								class   ="form-control maskRG"
								value="<?php echo htmlspecialchars( $funcionario["rg_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
								>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group bmd-form-group">
								<label class="bmd-label-floating"> CPF</label>
								<input
								id      ="cpf_func"
								name    ="cpf_func"
								type    ="text"
								class   ="form-control maskCPF"
								value	="<?php echo htmlspecialchars( $funcionario["cpf_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"

								>
							</div>
						</div>
					</div>            
				</div>
				<br>
			</div>

			<!-- card work data -->
			<div class="card">
				<div class="card-header card-header-primary card-header-icon">
					<div class="card-icon">
						<i class="material-icons">gavel</i>
					</div>
					<h4 class="card-title">Dados trabalhista
					</h4>
				</div>
				<div class="card-body">            
					<!-- first line -->
					<div class="row">
						<div class="col-md-2">
							<div class="form-group bmd-form-group">
								<label class="bmd-label bmd-label-floating"> Departamento</label>
								<input
								id      ="depart_func"
								name    ="depart_func"
								type    ="text"
								class   ="form-control"
								value="<?php echo htmlspecialchars( $funcionario["depart_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
								>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group bmd-form-group">
								<label class="bmd-label-floating"> Nº de Registro</label>
								<input
								id      ="num_func"
								name    ="num_func"
								type    ="text"
								class   ="form-control"
								value="<?php echo htmlspecialchars( $funcionario["num_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
								>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group bmd-form-group">
								<label class="bmd-label-floating"> Nº CTPS</label>
								<input
								id      ="num_cart_func"
								name    ="num_cart_func"
								type    ="text"
								class   ="form-control"
								value="<?php echo htmlspecialchars( $funcionario["num_cart_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
								>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group bmd-form-group">
								<label class="bmd-label-floating"> Nº INPS</label>
								<input
								id      ="num_inps_func"
								name    ="num_inps_func"
								type    ="text"
								class   ="form-control"
								value="<?php echo htmlspecialchars( $funcionario["num_inps_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
								>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group bmd-form-group">
								<label class="bmd-label-floating"> Salário</label>
								<input
								id      ="salario_func"
								name    ="salario_func"
								type    ="text"
								class   ="form-control maskMoney"
								value="<?php echo htmlspecialchars( $funcionario["salario_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
								>
							</div>
						</div>
					</div>           
				</div>
				<br>
			</div>

			<!-- adreess data-->
			<div class="card">
				<div class="card-header card-header-primary card-header-icon">
					<div class="card-icon">
						<i class="material-icons">home</i>
					</div>
					<h4 class="card-title">Endereço
					</h4>
				</div>
				<div class="card-body">

					<!-- first nivel -->
					<div class="row">
                        <div class="col-md-6">
                          <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating"> Logradouro</label>
                            <input
                              id      ="logradouro_func"
                              name    ="logradouro_func"
                              type    ="text"
							  class   ="form-control"
							  value="<?php echo htmlspecialchars( $funcionario["logradouro_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                            >
                          </div>
                        </div>
  
                        <div class="col-md-1">
                          <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating"> Número</label>
                            <input
                              id      ="num_logr_func"
                              name    ="num_logr_func"
                              type    ="text"
							  class   ="form-control"
							  value="<?php echo htmlspecialchars( $funcionario["num_logr_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                            >
                          </div>
                        </div>
  
                        <div class="col-md-5">
                          <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating"> Complemento</label>
                            <input
                              id      ="Comp_logr_func"
                              name    ="Comp_logr_func"
                              type    ="text"
							  class   ="form-control"
							  value="<?php echo htmlspecialchars( $funcionario["Comp_logr_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                            >
                          </div>
                        </div>                               
                      </div>
                      <div class="row">
                        <div class="col-md-2">
                          <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating"> CEP</label>
                            <input
                              id      ="cep_func"
                              name    ="cep_func"
                              type    ="text"
							  class   ="form-control maskCEP"
							  value="<?php echo htmlspecialchars( $funcionario["cep_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                            >
                          </div>
                        </div> 
  
                        <div class="col-md-3">
                          <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating"> Bairro</label>
                            <input
                              id      ="bairro_func"
                              name    ="bairro_func"
                              type    ="text"
							  class   ="form-control"
							  value="<?php echo htmlspecialchars( $funcionario["bairro_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                            >
                          </div>
                        </div> 
  
                        <div class="col-md-6">
                          <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating"> Cidade</label>
                            <input
                              id      ="cidade_func"
                              name    ="cidade_func"
                              type    ="text"
							  class   ="form-control"
							  value="<?php echo htmlspecialchars( $funcionario["cidade_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                            >
                          </div>
                        </div>
                        <div class="col-md-1">
                          <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating"> UF</label>
                            <input
                              id      ="estado"
                              name    ="estado"
                              type    ="text"
							  class   ="form-control maskUf"
							  value="<?php echo htmlspecialchars( $funcionario["estado"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
                            >
                          </div>
                        </div> 
					</div>
					<br>
					<!-- third nivel --> 
				</div>
			</div>

			<!-- Access to system data -->
			<div class="card">
				<div class="card-header card-header-primary card-header-icon">
					<div class="card-icon">
						<i class="material-icons">important_devices</i>
					</div>
					<h4 class="card-title">Dados Para Acesso ao Sistema
					</h4>
				</div>
				<div class="card-body">            
					<!-- first line -->
					<div class="row">
						<div class="col-md-3">
							<div class="form-group bmd-form-group">
								<label class="bmd-label bmd-label-floating"> E-mail</label>
								<input
								id      ="email_func"
								name    ="email_func"
								type    ="email"
								class   ="form-control"
								value="<?php echo htmlspecialchars( $funcionario["email_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
								required="true"
								>
							</div>                  
						</div>

						<div class="form-group col-md-2">
							<select id="acesso_sistema" name="acesso_sistema" class="form-control" required="true">
								<option value="<?php echo htmlspecialchars( $funcionario["acesso_sistema"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" selected><?php echo htmlspecialchars( $funcionario["acesso_sistema"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
								<option value="">Permitir acesso...</option>
								<option value="Sim">Sim</option>
								<option value="Não">Não</option>
							</select>
						</div>

						<div class="form-group col-md-4">
							<select id="tipo_usu" name="tipo_usu" class="form-control" required="true">
								<option value="" selected>Perfil de Acesso...</option>
								
								<?php $counter1=-1;  if( isset($perfis) && ( is_array($perfis) || $perfis instanceof Traversable ) && sizeof($perfis) ) foreach( $perfis as $key1 => $value1 ){ $counter1++; ?>
									
									<?php if( $value1["COD_PERFIL"] == $funcionario["tipo_usu"] ){ ?>

										<option value="<?php echo htmlspecialchars( $value1["COD_PERFIL"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" selected><?php echo htmlspecialchars( $value1["PERFIL"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
									
									<?php }else{ ?>

										<option value=<?php echo htmlspecialchars( $value1["COD_PERFIL"], ENT_COMPAT, 'UTF-8', FALSE ); ?>><?php echo htmlspecialchars( $value1["PERFIL"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>

									<?php } ?>

								<?php } ?>

							</select>
						</div>
						
						<div class="form-group col-md-2">
							<select id="revogado" name="revogado" class="form-control" required="true">
								<option value="<?php echo htmlspecialchars( $funcionario["revogado"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" selected><?php echo htmlspecialchars( $funcionario["revogado"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
								<option value="">Funcnionário revogado...</option>
								<option value="Sim">Sim</option>
								<option value="Não">Não</option>
							</select>
						</div>

					</div>           
				</div>
				<br>
			</div>

			<!-- Emergency -->
			<div class="card">
				<div class="card-header card-header-primary card-header-icon">
					<div class="card-icon">
						<i class="material-icons">record_voice_over</i>
					</div>
					<h4 class="card-title"> Em Caso de Emergência
					</h4>
				</div>
				<div class="card-body">            
					<!-- first line -->
					<div class="row">
						<div class="col-md-4">
							<div class="form-group bmd-form-group">
								<label class="bmd-label bmd-label-floating"> Contato</label>
								<input
								id      ="CONTATO_EMERGENCIA_FUNC"
								name    ="CONTATO_EMERGENCIA_FUNC"
								type    ="text"
								class   ="form-control"
								value="<?php echo htmlspecialchars( $funcionario["CONTATO_EMERGENCIA_FUNC"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
								>
							</div>
						</div>

						<div class="col-md-2">
							<div class="form-group bmd-form-group">
								<label class="bmd-label-floating"> Tel. Fixo</label>
								<input
								id      ="TEL_FIXO_EMERGENCIA_FUNC"
								name    ="TEL_FIXO_EMERGENCIA_FUNC"
								type    ="text"
								class   ="form-control maskPhone"
								value="<?php echo htmlspecialchars( $funcionario["TEL_FIXO_EMERGENCIA_FUNC"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
								>
							</div>
						</div>

						<div class="col-md-2">
							<div class="form-group bmd-form-group">
								<label class="bmd-label-floating"> Tel. Celular</label>
								<input
								id      ="TEL_CEL_EMERGENCIA_FUNC"
								name    ="TEL_CEL_EMERGENCIA_FUNC"
								type    ="text"
								class   ="form-control maskCellPhone"
								value="<?php echo htmlspecialchars( $funcionario["TEL_CEL_EMERGENCIA_FUNC"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"
								>
							</div>
						</div>

						<div class="form-group col-md-2">
							<select id="TIPO_SANGUE" name="TIPO_SANGUE" class="form-control" required="true">
								<option value="<?php echo htmlspecialchars( $funcionario["TIPO_SANGUE"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" selected><?php echo htmlspecialchars( $funcionario["TIPO_SANGUE"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
								<option value="A+">A+</option>
								<option value="A-">A-</option>
								<option value="AB+">AB+</option>
								<option value="AB-">AB-</option>
								<option value="O+">O+</option>
								<option value="O-">O-</option>
							</select>
						</div>

					</div>           
				</div>
				<br>
			</div>

			<!-- adreess data-->
			<div class="card">
				<div class="card-header card-header-primary card-header-icon">
					<div class="card-icon">
						<i class="material-icons">aspect_ratio</i>
					</div>
					<h4 class="card-title"> Observação
					</h4>
				</div>
				<div class="card-body"> 
					<div class="row">
						<div class="form-group col-md-2">
							<label for="cargo_func">Cargo</label>
							<select
							class="form-control selectpicker"
							data-style="btn btn-link"
							id="cargo_func"
							name="cargo_func"
							required="true">
								<option value="">Selecione o Cargo...</option>
								<?php $counter1=-1;  if( isset($cargo) && ( is_array($cargo) || $cargo instanceof Traversable ) && sizeof($cargo) ) foreach( $cargo as $key1 => $value1 ){ $counter1++; ?>
									<option value=<?php echo htmlspecialchars( $value1["COD_CARGO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>><?php echo htmlspecialchars( $value1["CARGO"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
								<?php } ?>

								<?php $counter1=-1;  if( isset($cargo) && ( is_array($cargo) || $cargo instanceof Traversable ) && sizeof($cargo) ) foreach( $cargo as $key1 => $value1 ){ $counter1++; ?>
									
									<?php if( $value1["COD_CARGO"] == $funcionario["cargo_func"] ){ ?>

										<option value="<?php echo htmlspecialchars( $value1["COD_CARGO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" selected><?php echo htmlspecialchars( $value1["CARGO"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
									
									<?php }else{ ?>

										<option value=<?php echo htmlspecialchars( $value1["COD_CARGO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>><?php echo htmlspecialchars( $value1["CARGO"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>

									<?php } ?>
									
								<?php } ?>
							</select>
						</div>

						<div class="form-group col-md-3">
								<label for="cod_func">Status do Cadastro</label>
								<select
								  class="form-control selectpicker"
								  data-style="btn btn-link"
								  id="status_func"
								  name="status_func"
								  required="true"
								  >
								  <option value="<?php echo htmlspecialchars( $funcionario["status_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" selected><?php echo htmlspecialchars( $funcionario["status_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
								  <option value="">Status do Cadastro...</option> 
								  <option value="Ativado">Ativado</option>
								  <option value="Bloqueado">Bloqueado</option>
								  <option value="Cancelado">Cancelado</option>
								</select>
							</div>


					</div>

					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<label>Observações</label>
								<div class="form-group bmd-form-group">
									<label class="bmd-label-floating"></label>
									<textarea id="obs_func" name="obs_func" class="form-control" rows="5"><?php echo htmlspecialchars( $funcionario["obs_func"], ENT_COMPAT, 'UTF-8', FALSE ); ?></textarea>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6 text-left">
							<a class="btn" href="/admin/funcionario">
								<i class="material-icons">undo</i>
								<span class="sidebar-normal"> Voltar a lista de funcionario</span>
							</a>
						</div>

						<div class="col-md-6 text-right">
							<button class="btn btn-success pull-right">
								<span class="btn-label">
									<i class="material-icons">check</i>
								</span>
								Ataualizar
							</button>                     
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>

</div>

