<?php
require('conexaobd.php');



$nome = $_POST['nome'];
$descritivo = $_POST['prontuario'];
$data = $_POST['data_atual'];
$CID = $_POST['cid'];


$sqlID = "SELECT ID_Paciente FROM paciente WHERE Nome_Paciente = '$nome'";
$resultadoId = mysqli_query($con, $sqlID);

while ($cont = mysqli_fetch_array($resultadoId)) {
    $Paciente = $cont['ID_Paciente'];}

$prontuario = $descritivo ." \nCID: ".$CID." Data da Consulta: ".$data."\n";

$sqldados = "INSERT INTO detalhes_consulta (Descricao_Detalhes, ID_Paciente, Data_Consulta) VALUES ('$prontuario','$Paciente', '$data')";

// Executar a consulta
$resultado = mysqli_query($con, $sqldados);

// Verifique se a consulta foi bem-sucedida
if ($resultado) {
    // Redirecionar para index.php
    "<script>alert('Dados Salvos! Retornando ao Menu!');</script>";
    header("Location: index.php");
    exit; // Certifique-se de sair do script após o redirecionamento
} else {
    die("<script>alert('Não foi possível salvar. Por favor, tente novamente mais tarde.');</script>");
}

?>