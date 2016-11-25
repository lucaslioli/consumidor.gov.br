<?php

/**
* View responsável por exibir as tabelas do BD
* @author Anthony Tailer
* @author Lucas Lima
**/

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv=”content-language” content=”pt-br” charset="utf-8">
	<title>Tabelas Normalizadas</title>
	<link rel="stylesheet" href="../utilities/css/bootstrap-flex.min.css">
	<!-- Script -->
	<script src="../utilities/js/jquery.min.js"></script>
	<script src="../utilities/js/jquery-1.12.3.js"> </script>
	<script src="../utilities/js/bootstrap.min.js"> </script>
	<script src="../utilities/js/jquery.dataTables.min.js"></script>
	<style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 500px;
      }
    </style>

</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
				<?php include_once "menu.php" ?>

			</div>
			<div class="col-md-9">
				<h1 align="center">Gráficos e Consultas</h1>
				<h4 align="center">Reclamações do consumidor.gov.br</h4>
				<br><br>
				<div id="map">

				</div>
				<!-- <div id="accordion" role="tablist" aria-multiselectable="true">
				  <div class="card">
				    <div class="card-header" role="tab" id="headingOne">
				      <h4 class="mb-0">
				        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">#1 Relação da Quantidade de Reclamações por Estado</a>
				      </h4>
				    </div>

				    <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
				      <div class="card-block" id="map">

				      </div>
				    </div>
				  </div>
				  <div class="card">
				    <div class="card-header" role="tab" id="headingTwo">
				      <h4 class="mb-0">
				        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">#2 Relação da Quantidade de Reclamações por Estado</a>
				      </h5>
				    </div>
				    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
				      <div class="card-block">

				      </div>
				    </div>
				  </div>
				  <div class="card">
				    <div class="card-header" role="tab" id="headingThree">
				      <h4 class="mb-0">
				        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">#3 Relação da Quantidade de Reclamações por Estado</a>
				      </h4>
				    </div>
				    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
				      <div class="card-block">
				        SELECT E.NOME AS UF, COUNT(*) <br>
				    	FROM RECLAMACOES R <br>
				    	JOIN CONSUMIDOR CO ON CO.IDCONSUMIDOR = R.IDCONSUMIDOR <br>
				    	JOIN CIDADE CI ON CI.IDCIDADE = CO.IDCIDADE <br>
				    	JOIN ESTADO E ON E.IDESTADO = CI.IDESTADO <br>
				    	GROUP BY UF;
				      </div>
				    </div>
				  </div>
				</div> -->
			</div>
		</div>
	</div>
	<script>

	var map;
	var infoWindow;
	var queryReturn;


	$.ajax({
	  url: "../controller/Graficos.php?query=geomap",
	  dataType: "json",
	  type: 'GET',
	  success: function(msg){
	    queryReturn = msg;
	    //console.log(queryReturn);
	  }
	});

	// GEOMAPA - RELAÇÃO DA QUANTIDADE DE RECLAMAÇÕES POR ESTADO
		function initMap() {

			geocoder = new google.maps.Geocoder();
			map = new google.maps.Map(document.getElementById('map'), {
				zoom: 4,
				center: {lat: -14.235004, lng: -51.92527999999999},
				mapTypeId: google.maps.MapTypeId.VIEWPORT
			});
			var i = 0;

			  var interval = setInterval(function(){
					if (i < queryReturn.length){
						converteEndereco(queryReturn[i][0], queryReturn[i][1]);
						i++;
					}else
						clearInterval(interval);
				}, 1900);
		}

		function converteEndereco(endereco, reclamacoes) {
			geocoder.geocode( { 'address': endereco+', Brazil'} , function(resultado, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					var cityCircle = new google.maps.Marker({
						map: map,
						position: resultado[0].geometry.location,
						title: endereco+" "+reclamacoes
					});
				} else {
					//alert('Erro ao converter endereço: ' + status);
				}
			});
		}


	</script>
	<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADS0fKiiywkMiPxF6nbfpfpHosf8SEAdI&signed_in=true&callback=initMap"></script>
</body>
</html>
