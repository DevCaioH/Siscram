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
</head>

<body>
    <?php include("menu.php");?>
    

            <!-- Blank Start -->
            <div class="container-fluid pt-4 px-4">
    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                        <div class="form-floating mb-3">
                            <input type="text" name="nome" class="form-control" id="searchInput" placeholder="Pesquisar na tabela">
                            <label for="floatingInput">Pesquisar Nome do Paciente</label>
                        </div>
                            <h6 class="mb-4">Receitas</h6>
                    
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nome do Paciente</th>
                                            <th scope="col">Idade</th>
                                            <th scope="col">Telefone</th>
                                            <th scope="col">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        /* Iniciando conexão com o banco */
                                        require 'conexaobd.php';

                                        /* Query SQL */
                                        $sql = "SELECT * FROM paciente";

                                        /* Conectando e enviando a query para o Banco de Dados */
                                        $resultado = mysqli_query($con, $sql);

                                        $inc = 0;
                                        while ($cont = mysqli_fetch_array($resultado)) {
                                            echo "
                                                        <tr>
                                                        <td>" . $cont['ID_Paciente'] . "</td>
                                                        <td>" . $cont['Nome_Paciente'] . "</td>
                                                        <td>" . $cont['Idade'] . "</td>
                                                        <td>" . $cont['Telefone'] . "</td>
                                                        <td><a href='gerarProntuario.php?ID_Paciente=".$cont['ID_Paciente']."'><button type='button' class='btn btn-outline-success btn-sm' target='_blank'>Iniciar Atendimento</button></a></td>
                                                        </tr>";
                                            $inc++;
                                        }

                                        if ($inc == 0) {
                                            echo '<script>
                                                        alert("Não existem dados nesta tabela");
                                                        </script>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
    </div>


  <!-- Footer Start -->
  <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">SISCRAM</a>, All Right Reserved. 
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