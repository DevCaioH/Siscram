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
    if (empty($_SERVER['HTTP_REFERER'])) {
        // Redireciona o usuário para outra página ou exibe uma mensagem de erro
        header('Location: index.php');
        exit;
    }

        include("menu.php"); 

        require("conexaobd.php");


        $dataAtual = date("d/m/Y");

        ?>
    </head>

    <body>

                <!-- Form Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="row g-4">              
                        <div class="col-sm-12 col-xl-12">
                            <div class="bg-secondary rounded h-100 p-4">
                                
                                <h6 class="mb-4">Atestado</h6>
                                <form name="atestado" id="atestadoForm" method="POST" action="atestadoPDF.php" target="_blank">
    <div class="form-floating mb-3">
        <input type="text" name="nome" class="form-control" id="floatingInput" placeholder="Caio Henrique Pereira">
        <label for="floatingInput">Nome do Paciente</label>
    </div>
    <div class="form-floating mb-3">
        <select class="form-select" name="ende" id="floatingSelect">
            <option selected>Selecione o Consultório</option>
            <?php
            require 'conexaobd.php';
            $sql = "SELECT * FROM consultorios";
            $resultado = mysqli_query($con, $sql);
            while ($cont = mysqli_fetch_array($resultado)) {
                echo "<option value=" . $cont['IDConsultorio'] . ">" . $cont['Nome_Consultorio'] . " - " . $cont['Endereco_Consultorio'] . "</option>";
            }
            ?>
        </select>
        <label for="floatingSelect">Consultórios</label>
    </div>

    <div class="input-group mb-3">
        <input type="text" name="data_atual" class="form-control" value="<?php echo $dataAtual; ?>" placeholder="Data da Consulta" aria-label="Data" readonly>
        <span class="input-group-text">/</span>
        <input type="text" name="cid" class="form-control" placeholder="CID" aria-label="CID">
    </div>

    <div class="form-floating mb-3">
        <select class="form-select" name="motivo" id="motivoSelect" aria-label=".form-select-sm example">
            <option selected>Motivo Atestado</option>
            <option value="1">Consulta</option>
            <option value="2">Exame</option>
            <option value="3">Acompanhar Paciente</option>
        </select>
        <label for="floatingSelect">Motivo</label>
    </div>

    <div class="form-floating mb-3" id="opcaoSelect" style="display: none;">
        <select class="form-select" name="opcao" id="novoSelect" name="novoSelect">
            <option selected>Selecione uma Opção</option>
            <option value="dia">Dia</option>
            <option value="horas">Horas</option>
            <option value="meio_periodo">Meio Período</option>
        </select>
        <label for="opcaoSelect">Opção</label>
    </div>

    <div class="form-floating mb-3" id="horariosInput" style="display: none;">

    <input type="text" name="horario_chegada" class="form-control"  placeholder="Horário de Chegada" aria-label="Data">
        <span class="input-group-text">Até</span>
        <input type="text" name="horario_saida" class="form-control" placeholder="Horário de Saída" aria-label="CID">

    </div>

    <div class="form-floating mb-3" id="quantidadeDiasInput" style="display: none;">
        <input type="text" name="quantidade_dias" class="form-control" placeholder="Quantidade de Dias">
        <label for="quantidadeDiasInput">Quantidade de Dias</label>
    </div>

    <div class="form-floating mb-3" id="meioPeriodoSelect" style="display: none;">
        <select class="form-select" name="periodo" id="meioPeriodo" name="meioPeriodo">
            <option selected>Selecione o Período</option>
            <option value="Manhã">Manhã</option>
            <option value="Tarde">Tarde</option>
            <option value="Noite">Noite</option>
        </select>
        <label for="meioPeriodoSelect">Meio Período</label>
    </div>

    <script>
        const motivoSelect = document.querySelector('#motivoSelect');
        const opcaoSelect = document.querySelector('#opcaoSelect');
        const novoSelectContainer = document.querySelector('#novoSelect');
        const horariosInput = document.querySelector('#horariosInput');
        const quantidadeDiasInput = document.querySelector('#quantidadeDiasInput');
        const meioPeriodoSelect = document.querySelector('#meioPeriodoSelect');

        motivoSelect.addEventListener('change', function () {
            const motivoSelecionado = motivoSelect.value;

            opcaoSelect.style.display = 'none';
            horariosInput.style.display = 'none';
            quantidadeDiasInput.style.display = 'none';
            meioPeriodoSelect.style.display = 'none';

            if (motivoSelecionado === '1' || motivoSelecionado === '2' || motivoSelecionado === '3') {
                opcaoSelect.style.display = 'block';
            }
        });

        novoSelectContainer.addEventListener('change', function () {
            const opcaoSelecionada = novoSelectContainer.value;

            horariosInput.style.display = 'none';
            quantidadeDiasInput.style.display = 'none';
            meioPeriodoSelect.style.display = 'none';

            if (opcaoSelecionada === 'horas') {
                horariosInput.style.display = 'block';
            }

            if (opcaoSelecionada === 'dia') {
                quantidadeDiasInput.style.display = 'block';
            }

            if (opcaoSelecionada === 'meio_periodo') {
                meioPeriodoSelect.style.display = 'block';
            }
        });
    </script>

    <div id="outputDiv"></div>
    <button class="btn btn-outline-success w-100 m-2" type="submit">Gerar!</button>
</form>




                        
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