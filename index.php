<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de login</title>
    <!-- Link para o Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link para o seu estilo CSS -->
    <link rel="stylesheet" href="estilo/index.css">
    <!-- Link para Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Sistema de Certificação</h1>
        <form action="testLogin.php" method="post">
            <div class="mb-3">
                <input type="email" class="form-control form-control-sm" name="email" placeholder="Email">
            </div>
            <div class="mb-3 position-relative d-flex align-items-start">
                <input type="password" id="senha" class="form-control form-control-sm me-2" name="senha" placeholder="Senha">
                <button type="button" class="btn btn-outline-secondary align-self-end" id="showPasswordBtn">
                    <i class="fas fa-eye olho_aberto"></i> <!-- Ícone do olho aberto -->
                    <i class="fas fa-eye-slash olho_fechado d-none"></i> <!-- Ícone do olho fechado (inicialmente oculto) -->
                </button>
            </div>
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary">Entrar</button>
            </div>
            <div class="d-grid mb-3">
                <a href="formulario.php" class="btn btn-secondary">Registrar</a>
            </div>
        </form>
    </div>

    <!-- Script para alternar entre mostrar e ocultar a senha -->
    <script>
        const senhaInput = document.getElementById('senha');
        const showPasswordBtn = document.getElementById('showPasswordBtn');

        showPasswordBtn.addEventListener('click', function() {
            if (senhaInput.type === 'password') {
                senhaInput.type = 'text';
                showPasswordBtn.querySelector('.olho_aberto').classList.add('d-none');
                showPasswordBtn.querySelector('.olho_fechado').classList.remove('d-none');
            } else {
                senhaInput.type = 'password';
                showPasswordBtn.querySelector('.olho_aberto').classList.remove('d-none');
                showPasswordBtn.querySelector('.olho_fechado').classList.add('d-none');
            }
        });
    </script>
</body>
</html>
