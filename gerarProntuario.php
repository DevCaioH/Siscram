<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SISCRAM</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <?php
    // Verifica se o referenciador não está vazio

    include("menu.php");

    require('conexaobd.php');

    $Paciente = $_GET['ID_Paciente'];

    
    $sql = "SELECT Descricao_Detalhes FROM detalhes_consulta WHERE ID_Paciente = '$Paciente' ";
    $sqlNome = "SELECT Nome_Paciente FROM paciente WHERE ID_Paciente = '$Paciente'";

    $resultado = mysqli_query($con, $sql);
    $resultadoNome = mysqli_query($con, $sqlNome);

    $inc = 0;
    // Verifique se a consulta foi bem-sucedida
    if ($resultado) {
        $Descricao = "";
           // Percorre os resultados da consulta e concatena os detalhes em uma única string
        while ($row = mysqli_fetch_assoc($resultado)) {
            $Descricao .= $row['Descricao_Detalhes'] . "\n"."\n"; // Adicione uma nova linha para separar cada detalhe
        }};

    $Descricao = preg_replace('/<br\s*\/?>/i', ' ', $Descricao);


    while ($cont = mysqli_fetch_array($resultadoNome)) {
        $Nome = $cont['Nome_Paciente'];}


    // Definir o fuso horário para GMT-3
    $timezone = new DateTimeZone('America/Sao_Paulo');

    // Obter a data e hora atual no fuso horário definido
    $datetime = new DateTime('now', $timezone);

    // Obter a data formatada
    $dataAtual = $datetime->format('d/m/Y');


    ?>
</head>

<body>

    <!-- Form Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-secondary rounded h-100 p-4">

                    <h6 class="mb-4">Prontuário</h6>
                    <form name="prontuario" id="prontuarioForm" method="POST" action="salvarProntuario.php" target="_blank">
                    <h7 class="mb-4">Paciente: </p><input type="text" name="nome" value = "<?php echo $Nome; ?>" class="form-control" placeholder="CID" aria-label="Nome" readonly></p></h7>
                
                    <div class="form-floating">
                            <textarea class="form-control" id="floatingTextarea"  style="height: 250px;" readonly><?php echo $Descricao; ?></textarea>
                      
                        </div>
                        <div></p></div>
    
                        <div class="input-group mb-3">
                            <input type="text" name="data_atual" class="form-control" value="<?php echo $dataAtual; ?>" placeholder="Data da Consulta" aria-label="Data" readonly>
                            <span class="input-group-text">/</span>
                            <input type="text" name="cid" class="form-control" placeholder="CID" aria-label="CID">
            
                        </div>

                        <div class="form-floating">
                            <textarea class="form-control" name="prontuario" placeholder="Leave a comment here" id="floatingTextarea" style="height: 250px;"></textarea>
                            <label for="floatingTextarea">Escreva aqui sobre a consulta</label>
                        </div>
                        <script>
                            const textarea = document.querySelector('#floatingTextarea');
                            const outputDiv = document.querySelector('#outputDiv');

                            textarea.addEventListener('keydown', function(event) {
                                if (event.key === 'Enter') {
                                    event.preventDefault();
                                    const startPos = this.selectionStart;
                                    const endPos = this.selectionEnd;
                                    this.value = this.value.substring(0, startPos) + '\n' + this.value.substring(endPos);
                                    this.selectionStart = startPos + 1;
                                    this.selectionEnd = startPos + 1;
                                }
                            });

                            textarea.addEventListener('input', function() {
                                outputDiv.innerHTML = this.value.replace(/\n/g, '<br>');
                            });
                        </script>

                        <div id="outputDiv"></div>
                        <button class="btn btn-outline-success w-100 m-2" type="submit">Salvar!</button>
                    </form>

                    <script>

                    </script>
                </div>
            </div>


        </div>
    </div>
    <!-- Form End -->


    <!-- Footer Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary rounded-top p-4">
            <div class="row">
                <div class="col-12 col-sm-6 text-center text-sm-start">
                    &copy; <a href="#">Your Site Name</a>, All Right Reserved.
                </div>
                <div class="col-12 col-sm-6 text-center text-sm-end">
                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                    <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->
    </div>
    <!-- Content End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
