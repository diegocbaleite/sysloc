<?php
session_start();
include_once('config.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    header('Location: login.php');
    exit;
}

$logado = $_SESSION['username'];

// Verifica se há uma pesquisa
if (!empty($_GET['search'])) {
    $data = $_GET['search'];
    $sql = "SELECT * FROM users WHERE id LIKE '%$data%' OR username LIKE '%$data%' OR username LIKE '%$data%' ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM users ORDER BY id DESC";
}

// Executa a consulta
$result = $conexao->query($sql);

if ($result === false) {
    echo "Erro na consulta: " . $conexao->error;
    exit;
}

// Fechar a conexão
$conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="img/teste.png" type="image/x-icon">
    <title>Sistema ATT</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fa fa-sitemap"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SysATT</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="home.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Painel de Controle</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Nav Item - Cadastrar Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCadastros" aria-expanded="true" aria-controls="collapseCadastros">
                    <i class="fas fa-fw fa-folder-open"></i>
                    <span>Novo</span>
                </a>
                <div id="collapseCadastros" class="collapse" aria-labelledby="headingCadastros" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Cadastros:</h6>
                        <a class="collapse-item" href="cadastro.php">Cadastrar Novo</a>
                       
                    </div>
                </div>
            </li>

            <!-- Divisão -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Nav Item - Listar lideranças -->
            <li class="nav-item">
                <a class="nav-link" href="listar.php">
                    <i class="fas fa-fw fa-list-ul"></i>
                    <span>Listar</span>
                </a>
            </li>

            <!-- Nav Item - Usuários -->
            <li class="nav-item">
                <a class="nav-link" href="register.php">
                    <i class="fas fa-fw fa-user-plus"></i>
                    <span>Usuário</span>
                </a>
            </li>

             <!-- Divisão -->
             <hr class="sidebar-divider d-none d-md-block">

            <!-- Nav Item - Gráficos -->
    
            <div class="sidebar-heading">COMPLEMENTOS</div>

            <!-- Nav Item - Configurações -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Configurações</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Telas de Login:</h6>
                        <a class="collapse-item" href="login.php">Login</a>
                        <a class="collapse-item" href="register.php">Novo Usuário</a>
                        <a class="collapse-item" href="#">Esqueceu sua senha</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Outras páginas:</h6>
                        <a class="collapse-item" href="#">404 Page</a>
                    </div>
                </div>
            </li>

            <!-- Divisão -->
            <hr class="sidebar-divider d-none d-md-block">

             <!-- Nav Item - Sair -->
             <li class="nav-item">
                <a class="nav-link" href="sair.php">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Sair</span></a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Cabeçalho -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <h1 class="text-center">Cadastrar novo usúario</h1>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <body class="bg-gradient">

                        <div class="container">
                            <form action="register_user.php" method="POST">
                                <div class="form-group">
                                    <label for="username">Nome de usúario</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Senha</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                            </form>
                        </div>
        
            <!-- Bootstrap core JavaScript-->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin-2.min.js"></script>

            <!-- Page level plugins -->
            <script src="vendor/chart.js/Chart.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="js/demo/chart-area-demo.js"></script>
            <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>