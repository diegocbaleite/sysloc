<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="shortcut icon" href="img/teste.png" type="image/x-icon">
    <title>Sistema ATT</title>
    <style>
        body {
            background-color: #242c74;
        }

        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .login-container h1 {
            margin-bottom: 20px;
        }

        .login-container .form-group {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h1>Sistema ATT</h1>
        <?php
        session_start();
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['error']) . '</div>';
            unset($_SESSION['error']);
        }
        ?>
        <form action="valida.php" method="POST">
            <div class="form-group">
                <label for="username">
                    <i class="fas fa-user"></i> Login
                </label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Digite seu usuário"
                    required>
            </div>
            <div class="form-group">
                <label for="password">
                    <i class="fas fa-lock"></i> Senha
                </label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha"
                    required>
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block" name="submit">Login</button>
        </form>
    </div>

    <!-- Bootstrap core JavaScript and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>