<?php
function verificarPermissao($perfisPermitidos) {


    // Verificar se o usuário está logado
    if (!isset($_SESSION['user_name']) || !isset($_SESSION['user_pass'])) {
        header('Location: login.php');
        exit();
    }

    // Verificar o perfil do usuário
    $logado = $_SESSION['user_name'];
    require("conexaobd.php");
    $sql = mysqli_query($con, "SELECT Perfil_user_fk FROM login WHERE User_name = '$logado'");
    $row = mysqli_fetch_assoc($sql);
    $perfilUsuario = $row['Perfil_user_fk'];

    // Verificar se o perfil do usuário tem permissão para acessar a página
    if (!in_array($perfilUsuario, $perfisPermitidos)) {
        header('Location: index.php'); // Redirecionar para a página inicial
        exit();
    }
}

?>
