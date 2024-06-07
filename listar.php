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

$sql = "SELECT * FROM fiscalizacao";
$result = $conexao->query($sql);
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

    <!-- Fontes personalizadas para este modelo-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Estilos personalizados para este modelo-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<style>
    .table-bordered {
         background-color: rgba(0, 0, 0, 0.03);
        border-radius: 15px 15px 0 0;
        overflow: hidden;
    }

    .table thead th {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }
</style>

<body id="page-top">

    <!-- Wrapper de página -->
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

            <!-- Divisor -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="home.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Painel de Controle</span>
                </a>
            </li>

            <!-- Divisor -->
            <hr class="sidebar-divider">
            <!-- Nav Item - Cadastrar Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCadastros"
                    aria-expanded="true" aria-controls="collapseCadastros">
                    <i class="fas fa-fw fa-folder-open"></i>
                    <span>Novo</span>
                </a>
                <div id="collapseCadastros" class="collapse" aria-labelledby="headingCadastros"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Cadastros:</h6>
                        <a class="collapse-item" href="cadastro.php">Cadastrar Novo</a>

                    </div>
                </div>
            </li>

            <!-- Divisão -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Nav Item - Listar Fiscalizadas -->
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

            <div class="sidebar-heading">COMPLEMENTOS</div>

            <!-- Nav Item - Configurações -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
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

            <!-- Alternador da barra lateral (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- Fim  Sidebar -->

        <!-- Wrapper de conteúdo-->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Conteúdo principal-->
            <div id="content">

                <!-- Cabeçalho -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <h1 class="text-center">Lista de Fiscalização</h1>
                </nav>
                <!-- Fim da barra superior -->

                <!-- Conteúdo da Tabela-->
                <div class="container-fluid">
                    <!-- Exibir mensagem de alerta -->
                    <?php if (!empty($_GET['message']) && !empty($_GET['alertClass'])): ?>
                        <div class="alert alert-<?php echo htmlspecialchars($_GET['alertClass']); ?> alert-dismissible fade show" role="alert">
                            <?php echo htmlspecialchars($_GET['message']); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Município</th>
                                    <th>Operador</th>
                                    <th>Data de Início da Fiscalização</th>
                                    <th>Data de Término da Fiscalização</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($user_data = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $user_data['id'] . "</td>";
                                    echo "<td>" . $user_data['municipio'] . "</td>";
                                    echo "<td>" . $user_data['operador'] . "</td>";
                                    echo "<td>" . date('d/m/Y', strtotime($user_data['data_inicio'])) . "</td>";
                                    echo "<td>" . date('d/m/Y', strtotime($user_data['data_fim'])) . "</td>";
                                    echo "<td>
                                    <a class='btn btn-sm btn-primary' href='edit.php?id=$user_data[id]'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                            <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325'/>
                                        </svg>
                                    </a>
                                    <a class='btn btn-sm btn-danger' href='delete.php?id=$user_data[id]'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                                        <path d=1M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z'/>
                                        <path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z'/>
                                        </svg>
                                    </a>
                                </td>";
                                echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Fim do Tabela -->
                 
            </div>
            <!-- Fim do conteúdo principal -->
        </div>
        <!-- Fim do wrapper de conteúdo -->
    </div>
    <!-- Wrapper de fim de página -->

    <!-- JavaScript principal do Bootstrap-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plug-in principal JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Scripts personalizados para todas as páginas-->
    <script src="js/sb-admin-2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Esconde o alerta após 2 segundos (2000 milissegundos)
            setTimeout(function() {
                $(".alert").alert('close');
            }, 2000);
        });
    </script>

</body>

</html>
