<?php
require_once('tcpdf/tcpdf.php');
require('conexaobd.php');

$user = $_POST['user'];
$nome = $_POST['nome'];
$senha = $_POST['senha'];
$perfil_acesso = $_POST['perfil'];

// Verifica se foi enviado um arquivo
if(isset($_FILES['imagem'])){
    $nomeArquivo = $_FILES['imagem']['name'];
    $caminhoArquivo = 'img/' . $nomeArquivo;
    
    // Move o arquivo para a pasta desejada
    move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoArquivo);
    
    // Verifica se o arquivo foi salvo corretamente
    if(file_exists($caminhoArquivo)){
        // Prepara a consulta SQL com um marcador de posição para os valores
        $sqldados = "INSERT INTO login (User_name, User_pass, Nome_Usuario, IMG, Perfil_user_fk) VALUES (?, ?, ?, ?, ?)";

        // Prepara a declaração
        $stmt = mysqli_prepare($con, $sqldados);

        // Vincula os parâmetros à declaração
        mysqli_stmt_bind_param($stmt, "sssss", $user, $senha, $nome, $caminhoArquivo, $perfil_acesso);

        // Executa a declaração
        if (mysqli_stmt_execute($stmt)) {
            // Redireciona de volta para a página inicial
            header("Location: index.php");
            exit(); // Certifique-se de incluir um exit() após o redirecionamento
        } else {
            // Caso ocorra algum erro no INSERT, exibe uma mensagem de erro
            echo "<script>alert('Não foi possível salvar. Por favor, tente novamente mais tarde.');</script>";
            echo "Não foi possível salvar. Por favor, tente novamente mais tarde.";
            exit();
        }

        // Fecha a declaração
        mysqli_stmt_close($stmt);
    } else {
        echo 'Erro ao salvar a imagem.';
    }
} else {
    // Caso nenhum arquivo tenha sido enviado, exibe uma mensagem de erro
    echo "Nenhum arquivo de imagem foi enviado.";
    exit();
}
?>
