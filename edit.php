<?php
session_start();
include_once ('config.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    header('Location: login.php');
    exit;
}

$id = $_GET['id'];
$sql = "SELECT * FROM fiscalizacao WHERE id = $id";
$result = $conexao->query($sql);
$user_data = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $municipio = $_POST['municipio'];
    $operador = $_POST['operador'];
    $data_inicio = $_POST['data_inicio'];
    $data_fim = $_POST['data_fim'];

    $sql = "UPDATE fiscalizacao SET municipio='$municipio', operador='$operador', data_inicio='$data_inicio', data_fim='$data_fim' WHERE id=$id";
    if ($conexao->query($sql) === TRUE) {
        header('Location: listar.php');
    } else {
        echo "Erro ao atualizar o registro: " . $conexao->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="img/teste.png" type="image/x-icon">
    <title>Sistema ATT</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
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

    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fa fa-sitemap"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SysATT</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="home.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Painel de Controle</span>
                </a>
            </li>
            <hr class="sidebar-divider">
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
            <hr class="sidebar-divider d-none d-md-block">
            <li class="nav-item">
                <a class="nav-link" href="listar.php">
                    <i class="fas fa-fw fa-list-ul"></i>
                    <span>Listar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="editar.php">
                    <i class="fas fa-fw fa-clipboard-check"></i>
                    <span>Categorias Fiscalizadas</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="register.php">
                    <i class="fas fa-fw fa-user-plus"></i>
                    <span>Usuário</span>
                </a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <div class="sidebar-heading">COMPLEMENTOS</div>
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
            <hr class="sidebar-divider d-none d-md-block">
            <li class="nav-item">
                <a class="nav-link" href="sair.php">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Sair</span></a>
            </li>
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <h1 class="text-center">Editar Fiscalização</h1>
                </nav>
                <div class="container-fluid">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <form method="POST">
                                <div class="form-group">
                                    <label for="municipio">Município:</label>
                                    <input type="text" class="form-control" id="municipio" name="municipio"
                                        value="<?php echo $user_data['municipio']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="operador">Operador:</label>
                                    <input type="text" class="form-control" id="operador" name="operador"
                                        value="<?php echo $user_data['operador']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="data_inicio">Data de Início:</label>
                                    <input type="date" class="form-control" id="data_inicio" name="data_inicio"
                                        value="<?php echo $user_data['data_inicio']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="data_fim">Data de Término:</label>
                                    <input type="date" class="form-control" id="data_fim" name="data_fim"
                                        value="<?php echo $user_data['data_fim']; ?>" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>