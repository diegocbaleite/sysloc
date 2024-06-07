<?php
include 'config.php';

$error_message = '';
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se todos os campos foram preenchidos
    if (!empty($_POST['municipio']) && !empty($_POST['operador']) && !empty($_POST['data_inicio']) && !empty($_POST['data_fim'])) {
        // Limpa os dados de entrada para evitar injeção de SQL
        $municipio = mysqli_real_escape_string($conexao, $_POST['municipio']);
        $operador = mysqli_real_escape_string($conexao, $_POST['operador']);
        $data_inicio = mysqli_real_escape_string($conexao, $_POST['data_inicio']);
        $data_fim = mysqli_real_escape_string($conexao, $_POST['data_fim']);
        
        // Prepara e executa a consulta SQL usando uma consulta preparada
        $sql = "INSERT INTO fiscalizacao (municipio, operador, data_inicio, data_fim) VALUES (?, ?, ?, ?)";
        $stmt = $conexao->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssss", $municipio, $operador, $data_inicio, $data_fim);
            if ($stmt->execute()) {
                // Se a inserção for bem-sucedida, redirecione para a página desejada
                $success_message = "Cadastro concluído com sucesso!";
                header('Location: listar.php?success_message=' . urlencode($success_message));
                exit;
            } else {
                // Se houver um erro na inserção, exiba uma mensagem de erro
                $error_message = "Erro ao inserir dados: " . $stmt->error;
            }
            // Fecha o statement
            $stmt->close();
        } else {
            // Se houver um erro na preparação da consulta, exiba uma mensagem de erro
            $error_message = "Erro na preparação da consulta: " . $conexao->error;
        }
    } else {
        // Se algum campo estiver em falta, exiba uma mensagem de erro
        $error_message = "Todos os campos devem ser preenchidos.";
    }
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

<body id="page-top">
    <!-- Wrapper da página -->
    <div id="wrapper">
        <!-- Barra lateral -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Barra lateral - Brand -->
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
                    <span>Painel de Controle</span></a>
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
            <!-- Divisor -->
            <hr class="sidebar-divider">
            <!-- Nav Item - Listar lideranças -->
            <li class="nav-item">
                <a class="nav-link" href="listar.php">
                    <i class="fas fa-fw fa-list-ul"></i>
                    <span>Listar</span></a>
            </li>

            <!-- Nav Item - Usuário -->
            <li class="nav-item">
                <a class="nav-link" href="register.php">
                    <i class="fas fa-fw fa-user-plus"></i>
                    <span>Usuário</span></a>
            </li>
            <!-- Divisor -->
            <hr class="sidebar-divider d-none d-md-block">
            <div class="sidebar-heading">
                COMPLEMENTOS
            </div>
            <!-- Nav Item - Configurações Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseConfiguracoes"
                    aria-expanded="true" aria-controls="collapseConfiguracoes">
                    <i class="fas fa-fw fa-cog"></i><span>Configurações</span>
                </a>
                <div id="collapseConfiguracoes" class="collapse" aria-labelledby="headingConfiguracoes"
                    data-parent="#accordionSidebar">
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
            <!-- Divisor -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Item de navegação- Sair -->
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

        <!-- Wrapper de conteúdo -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Conteúdo principal -->
            <div id="content">

                <!-- Cabeçalho -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <h1 class="text-center">Fiscalização</h1>
                </nav>
                <!-- Fim do Topbar -->

                <!-- Conteúdo da página inicial -->
                <div class="container-fluid">

                    <!-- Formulario de cadastro -->
                    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <form action="save.php" method="POST">
                                        <div class="form-group">
                                            <label for="municipio">Municípios</label>
                                            <select class="form-control" id="municipio" name="municipio" required>
                                                <option value="">Selecione uma opção</option>
                                                <option>Cuiabá</option>
                                                <!--<option>Várzea Grande</option>-->
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="operador">Operador</label>
                                            <select class="form-control" id="operador" name="operador" required>
                                                <option value="">Selecione uma opção</option>
                                                <option>Águas Cuiabá</option>
                                               <!--<option>Energisa</option>-->
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="data_inicio">Data de Início da Fiscalização</label>
                                            <input type="date" class="form-control" id="data_inicio" name="data_inicio"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="data_fim">Data de Término da Fiscalização</label>
                                            <input type="date" class="form-control" id="data_fim" name="data_fim"
                                                required>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Próximo</button>
                                            <button type="button" class="btn btn-success"
                                                onclick="history.back()">Voltar ao início</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fim do Formulario -->
                </div>
                

            </div>
            <!-- Fim do wrapper de conteúdo -->

        </div>
        <!-- Wrapper da página final-->

        <!-- Role até o botão superior -->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- JavaScript principal do Bootstrap-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Plug-in principal JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Scripts personalizados para todas as páginas-->
        <script src="js/sb-admin-2.min.js"></script>

</body>

</html>