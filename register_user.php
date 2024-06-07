<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($conexao->query($sql) === TRUE) {
        $success_message = "Usuário registrado com sucesso";
    } else {
    }

    $conexao->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <title>Sistema de Mapeamento</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
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
                <div class="sidebar-brand-text mx-3">SysMap</div>
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

            <!-- Nav Item - Cadastros -->
            <li class="nav-item">
                <a class="nav-link" href="cadastro.php">
                    <i class="fas fa-fw fa-edit"></i>
                    <span>Cadastrar</span>
                </a>
            </li>

            <!-- Nav Item - Listar lideranças -->
            <li class="nav-item">
                <a class="nav-link" href="listar.php">
                    <i class="fas fa-fw fa-list-ul"></i>
                    <span>Listar</span>
                </a>
            </li>

            <!-- Nav Item - Editar lideranças -->
            <li class="nav-item">
                <a class="nav-link" href="editar.php">
                    <i class="fas fa-fw fa-pencil-alt"></i>
                    <span>Editar</span>
                </a>
            </li>

            <!-- Nav Item - Usuários -->
            <li class="nav-item">
                <a class="nav-link" href="register.php">
                    <i class="fas fa-fw fa-user-plus"></i>
                    <span>Usuários</span>
                </a>
            </li>

            <!-- Nav Item - Gráficos -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Gráficos</span>
                </a>
            </li>

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
                        <a class="collapse-item" href="esqueceu-senha.html">Esqueceu sua senha</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Outras páginas:</h6>
                        <a class="collapse-item" href="#">404 Page</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

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

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Formulário de Registro</h1>

                    <!-- Mensagem de sucesso ou erro -->
                    <div id="message" class="mt-4">
                        <?php
                        if (isset($success_message)) {
                            echo "<div class='alert alert-success'>$success_message</div>";
                        } elseif (isset($error_message)) {
                            echo "<div class='alert alert-danger'>$error_message</div>";
                        }
                        ?>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

</body>

</html>
