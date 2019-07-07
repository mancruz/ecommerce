<?php if(!class_exists('Rain\Tpl')){exit;}?><?php if( $drawMenu["0"]['PERMISSAO_VISUALIZAR']== 'SIM' ){ ?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/JavaScript"> 
  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(chartQtdFreteMes);
  

  function chartQtdFreteMes()
  {
	var qtdFreithMonth = google.visualization.arrayToDataTable([
	  ['Mês', 'Fretes Concluídos', 'Fretes Cancelados', 'Fretes em Processos'],
	  <?php $counter1=-1;  if( isset($chartQtdFreightMonth) && ( is_array($chartQtdFreightMonth) || $chartQtdFreightMonth instanceof Traversable ) && sizeof($chartQtdFreightMonth) ) foreach( $chartQtdFreightMonth as $key1 => $value1 ){ $counter1++; ?>
	  ['<?php echo htmlspecialchars( $value1["MES_FRETE"], ENT_COMPAT, 'UTF-8', FALSE ); ?>', <?php echo htmlspecialchars( $value1["CONCLUIDO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, <?php echo htmlspecialchars( $value1["CANCELADO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, <?php echo htmlspecialchars( $value1["EM_PROCESSO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>],
	  <?php } ?>
	  ]);

	var sumFreithResult = google.visualization.arrayToDataTable([
	  ['Mês', 'Resultado'],
	  <?php $counter1=-1;  if( isset($dadosChartsBarResult) && ( is_array($dadosChartsBarResult) || $dadosChartsBarResult instanceof Traversable ) && sizeof($dadosChartsBarResult) ) foreach( $dadosChartsBarResult as $key1 => $value1 ){ $counter1++; ?>
	  ['<?php echo htmlspecialchars( $value1["MES_FRETE"], ENT_COMPAT, 'UTF-8', FALSE ); ?>', (<?php echo htmlspecialchars( $value1["RESULTADO"], ENT_COMPAT, 'UTF-8', FALSE ); ?>)],
	  <?php } ?>
	  ]);


	var qtdFreithMonthOptions = {
	  chart: {
		title:		'Perfomance de Frete - Qtd Mensal',
		subtitle:	'Análise por Status',

	  }
	};
	var sumFreithResultOptions = {
	  chart: {
		title:		'Perfomance de Frete - Resultado Mensal',
		subtitle: 	'Análise por Status: Fretes Concluídos'
	  }
	};

	var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
	chart.draw(qtdFreithMonth, google.charts.Bar.convertOptions(qtdFreithMonthOptions));

	var chart = new google.charts.Bar(document.getElementById('columnchart_material2'));
	chart.draw(sumFreithResult, google.charts.Bar.convertOptions(sumFreithResultOptions));

  }

</script>
<div class="row">
	<div class="col-lg-4 col-md-6 col-sm-6">
		<div class="card card-stats">
			<div class="card-header card-header-warning card-header-icon">
				<div class="card-icon">
					<i class="material-icons">commute</i>
				</div>
				<p class="card-category">Quantidade da Frota</p>
				<h3 class="card-title"><?php echo htmlspecialchars( $TotalFrota["TotalFrota"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
					<small>Veículos</small>
				</h3>
			</div>
			<div class="card-footer">
				<div class="stats">
					<i class="material-icons text-danger">input</i>
					<a href="/admin/frota">Verificar Veículos...</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-6 col-sm-6">
		<div class="card card-stats">
			<div class="card-header card-header-success card-header-icon">
				<div class="card-icon">
					<i class="material-icons">supervisor_account</i>
				</div>
				<p class="card-category">Quantidade de Clientes</p>
				<h3 class="card-title"><?php echo htmlspecialchars( $TotalClientes["QtdClientes"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
			</div>
			<div class="card-footer">
				<div class="stats">
					<i class="material-icons">input</i>
					<a href="/admin/cliente-fornecedor">Visualizar Clientes</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-6 col-sm-6">
		<div class="card card-stats">
			<div class="card-header card-header-info card-header-icon">
				<div class="card-icon">
					<i class="fa fa-twitter"></i>
				</div>
				<p class="card-category">Quantidade de Fretes Neste Mês</p>
				<h3 class="card-title"><?php echo htmlspecialchars( $TotalFrete["QtdeFreteMes"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
			</div>
			<div class="card-footer">
				<div class="stats">
					<i class="material-icons">input</i>
					<a href="/admin/frete">Ir para Fretes</a>
				</div>
			</div>
		</div>
	</div>
</div>	
<!-- area of charts -->
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
		<div class="card card-stats">
			<div class="card-header card-header-warning card-header-icon">
				<div class="card-icon">
					<i class="material-icons">commute</i>
				</div>
			</div>
			<!-- -->
			<br>
			<div class="col-md-12">
				
				<div id="columnchart_material" style="width: 100%; height: 300px;"></div>
				<div id="columnchart_material2" style="width: 100%; height: 300px;"></div>

			</div>
		</div>
	</div>
</div>
<!-- area of charts close-->

<?php }else{ ?>
  <div class="alert alert-danger" role="alert">
    <h3>Ops! Seu perfil não tem acesso a esta funcionalidade!</h3>
  </div>
<?php } ?>