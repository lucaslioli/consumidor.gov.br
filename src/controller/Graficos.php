<?php
/**
* Arquivo por exibir os dados de cada tabela
* em seus respectivos DataTables
* @author Anthony Tailer
* @author Lucas Lima
*/

function __autoload($classe){
    include_once "../model/{$classe}.class.php";
}

$conex = new MySQLiConsumidor();
$mysqli = $conex->getConnection();
$desnormalizada = new MagicDesnormalizada();
$DAODesnormalizada = new DAODesnormalizada();

$output  = array();
$request = $_GET['query'];

if ($request == "geomap1") {
  $query = "SELECT E.NOME AS UF, COUNT(*) AS QTDRECLAMACOES FROM RECLAMACAO R
              JOIN CONSUMIDOR CO ON CO.IDCONSUMIDOR = R.IDCONSUMIDOR
              JOIN CIDADE CI ON CI.IDCIDADE = CO.IDCIDADE
              JOIN ESTADO E ON E.IDESTADO = CI.IDESTADO
              GROUP BY UF;";
  $result = $conex->executeQuery($query);
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
      array_push(
          $output, array($row["UF"],$row["QTDRECLAMACOES"])
      );
  }
  echo json_encode($output);
}elseif ($request == "geomap2") {
  $query = "SELECT CI.NOME AS CIDADE, E.NOME AS UF, COUNT(*) AS QTDRECLAMACOES,
            (SELECT COUNT(*) FROM RECLAMACAO) AS TOTALRECLAMACOES FROM RECLAMACAO R
              JOIN CONSUMIDOR CO ON CO.IDCONSUMIDOR = R.IDCONSUMIDOR
              JOIN CIDADE CI ON CI.IDCIDADE = CO.IDCIDADE
              JOIN ESTADO E ON E.IDESTADO = CI.IDESTADO
              WHERE E.NOME = 'RS'
              GROUP BY CIDADE;";
  $result = $conex->executeQuery($query);
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
      array_push(
          $output, array($row["CIDADE"],$row["UF"],$row["QTDRECLAMACOES"], $row["TOTALRECLAMACOES"])
      );
  }
  echo json_encode($output);
}else{
  echo 'Error';
}


?>
