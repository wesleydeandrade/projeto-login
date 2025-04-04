<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilo/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Sistema de Certificação</h1>
        <form action="testLogin.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email">
            </div>
            <div class="mb-3 position-relative">
                <label for="senha" class="form-label">Senha</label>
                <div class="d-flex">
                    <input type="password" id="senha" class="form-control me-2" name="senha" placeholder="Senha">
                    <button type="button" class="btn btn-outline-secondary" id="showPasswordBtn">
                        <i class="fas fa-eye olho_aberto"></i> 
                        <i class="fas fa-eye-slash olho_fechado d-none"></i> 
                    </button>
                </div>
            </div>
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary">Entrar</button>
            </div>
            <div class="d-grid mb-3">
                <a href="formulario.php" class="btn btn-secondary">Registrar</a>
            </div>
        </form>
    </div>
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

