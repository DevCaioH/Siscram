<?php 
// session_start inicia a sessão
session_start();
// as variáveis login e senha recebem os dados digitados na página anterior
$login = $_POST['user_name'];
$senha = $_POST['pass_user'];
// as próximas 3 linhas são responsáveis em se conectar com o bando de dados.

// A variavel $result pega as varias $usuario e $senha, faz uma 
//pesquisa na tabela de usuarios

  require("conexaobd.php");
  $result = mysqli_query($con, "SELECT * FROM login WHERE User_name ='$login' AND User_pass = '$senha'");


/* Logo abaixo temos um bloco com if e else, verificando se a variável $result foi 
bem sucedida, ou seja se ela estiver encontrado algum registro idêntico o seu valor
será igual a 1, se não, se não tiver registros seu valor será 0. Dependendo do 
resultado ele redirecionará para a página site.php ou retornara  para a página 
do formulário inicial para que se possa tentar novamente realizar o usuario */
if(mysqli_num_rows ($result) > 0 )
{
$_SESSION['user_name'] = $login;
$_SESSION['pass_user'] = $senha;
header('location:index.php');
}
else{
  unset ($_SESSION['user_name']);
  unset ($_SESSION['pass_user']);
  header('location:login.php');
   
  }
?>
