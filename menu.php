<?php  
session_start();
if ((!isset($_SESSION['user_name'])) && (!isset($_SESSION['user_pass']))) {
  unset($_SESSION['user_name']);
  unset($_SESSION['user_pass']);
  header('location: login.php');
}


$logado = $_SESSION['user_name'];

require("conexaobd.php");
$sql = mysqli_query($con, "SELECT login.Nome_Usuario, login.Perfil_user_fk, login.IMG, perfil.Descricao_Perfil FROM login INNER JOIN perfil on login.Perfil_user_fk = perfil.IdPerfil WHERE User_name = '$logado'");


while ($cont = mysqli_fetch_array($sql)) {

?>


  <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    <!-- Sidebar Start -->
    <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>SISCRAM</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="<?php echo $cont['IMG'];?>" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $cont['Nome_Usuario'];?></h6>
                        <span><?php echo $cont['Descricao_Perfil'];?></span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                <a href="index.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                <?php if ($cont['Perfil_user_fk'] == '1') { ?>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Solicitações</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="receituario.php" class="dropdown-item">Receituario</a>
                            <a href="listar_receitas.php" class="dropdown-item">Listar Receitas</a>
                            <a href="atestado.php" class="dropdown-item">Atestado</a>
                            <a href="listar_atestados.php" class="dropdown-item">Listar Atestado</a>
                            <a href="registro_usuario.php" class="dropdown-item">Cadastrar Usuário</a>
                            <a href="404.php" class="dropdown-item">Listar Usuário</a>
                            <a href="404.php" class="dropdown-item">Cadastrar Consultório</a>
                            <a href="404.php" class="dropdown-item">Listar Consultório</a>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($cont['Perfil_user_fk'] == '2') { ?>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Solicitações</a>
                        <div class="dropdown-menu bg-transparent border-0">
                        <a href="receituario.php" class="dropdown-item">Receituario</a>
                            <a href="listar_receitas.php" class="dropdown-item">Listar Receitas</a>
                            <a href="atestado.php" class="dropdown-item">Atestado</a>
                            <a href="listar_atestados.php" class="dropdown-item">Listar Atestado</a>
                            <a href="404.php" class="dropdown-item">Listar Consultório</a>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($cont['Perfil_user_fk'] == '3') { ?>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Solicitações</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="listar_receitas.php" class="dropdown-item">Listar Receitas</a>
                            <a href="listar_atestados.php" class="dropdown-item">Listar Atestado</a>
                            <a href="registro_usuario.php" class="dropdown-item">Cadastrar Usuário</a>
                            <a href="404.php" class="dropdown-item">Listar Usuário</a>
                            <a href="404.php" class="dropdown-item">Listar Consultório</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
               
                <div class="navbar-nav align-items-center ms-auto">
                   
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="<?php echo $cont['IMG'];?>" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><?php echo $cont['Nome_Usuario'];}?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="logout.php" class="dropdown-item">Sair</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->