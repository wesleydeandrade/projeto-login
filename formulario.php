<?php
if (isset($_POST["submit"])) {
    include_once('config.php');

    // Pega valores do formulário
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $genero = $_POST['genero'];
    $data_nascimento = $_POST['data_nascimento'];
    $cidade = $_POST['cidade'];
    $classe_docente = $_POST['classe_docente'];
    $nivel_acesso = intval($_POST['nivel_acesso']);

    // Insere no banco de dados
    $stmt = $conexao->prepare("INSERT INTO usuarios (nome, senha_hash, email, telefone, sexo, data_nasc, cidade, classe_docente, nivel_acesso) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssi", $nome, $senha_hash, $email, $telefone, $genero, $data_nascimento, $cidade, $classe_docente, $nivel_acesso);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo '<script>alert("Registro realizado com sucesso!");</script>';
        echo '<script>window.location.href = "index.php";</script>';
    } else {
        echo "Erro ao inserir no banco de dados.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Formulário | GN</title>
    <link rel="stylesheet" href="estilo/formulario.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="box">
        <form id="formRegistro" action="formulario.php" method="post" onsubmit="return validarSenha()">
            <fieldset>
                <legend><b>Formulário de Acesso</b></legend>

                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required>
                    <label for="nome" class="labelInput">Nome completo</label>
                </div>

                <div class="inputBox">
                    <input type="password" name="senha" id="senha" class="inputUser" required oninput="verificarRequisitosSenha()">
                    <label for="senha" class="labelInput">Senha</label>
                    <span class="toggle-password" onclick="togglePassword()">
                        <i id="toggleIcon" class="fas fa-eye"></i>
                    </span>
                </div>

                <div id="senhaRequisitos" class="password-instructions"></div>

                <div class="inputBox">
                    <input type="password" name="confirmar_senha" id="confirmar_senha" class="inputUser" required>
                    <label for="confirmar_senha" class="labelInput">Confirmar Senha</label>
                    <span id="senhaError" style="color: red;"></span>
                </div>

                <div class="inputBox">
                    <input type="text" name="email" id="email" class="inputUser" required>
                    <label for="email" class="labelInput">Email</label>
                </div>

                <div class="inputBox">
                    <input type="tel" name="telefone" id="telefone" class="inputUser" required>
                    <label for="telefone" class="labelInput">Telefone</label>
                </div>

                <div class="inputBox">
                    <p>Sexo:</p>
                    <input type="radio" id="feminino" name="genero" value="feminino" required>
                    <label for="feminino">Feminino</label><br>
                    <input type="radio" id="masculino" name="genero" value="masculino" required>
                    <label for="masculino">Masculino</label><br>
                    <input type="radio" id="outro" name="genero" value="outro" required>
                    <label for="outro">Outro</label>
                </div>

                <div class="inputBox">
                    <label for="data_nascimento"><b>Data de Nascimento:</b></label>
                    <input type="date" name="data_nascimento" id="data_nascimento" class="inputUser" required>
                </div>

                <div class="inputBox">
                    <input type="text" name="cidade" id="cidade" class="inputUser" required>
                    <label for="cidade" class="labelInput">Cidade</label>
                </div>

                <div class="inputBox">
                    <label for="classe_docente"><b>Classe de Docente:</b></label>
                    <select name="classe_docente" id="classe_docente" class="inputUser" required>
                        <option value="">Selecione uma opção</option>
                        <option value="Professor de Creche">Professor de Creche</option>
                        <option value="Professor de Atividades Complementares">Professor de Atividades Complementares</option>
                        <option value="Professor de Educação Infantil">Professor de Educação Infantil</option>
                        <option value="Professor de Ensino Fundamental I">Professor de Ensino Fundamental I</option>
                        <option value="Professor de Educação Básica I">Professor de Educação Básica I</option>
                        <option value="Professor de Educação Básica II - Música">Professor de Educação Básica II – Música</option>
                        <option value="Professor de Educação Básica II - Ciências">Professor de Educação Básica II – Ciências</option>
                        <option value="Professor de Educação Básica II - Educação Artística">Professor de Educação Básica II – Educação Artística</option>
                        <option value="Professor de Educação Básica II - Educação Física">Professor de Educação Básica II – Educação Física</option>
                        <option value="Professor de Educação Básica II - Espanhol">Professor de Educação Básica II – Espanhol</option>
                        <option value="Professor de Educação Básica II - Geografia">Professor de Educação Básica II – Geografia</option>
                        <option value="Professor de Educação Básica II - História">Professor de Educação Básica II – História</option>
                        <option value="Professor de Educação Básica II - Inglês">Professor de Educação Básica II – Inglês</option>
                        <option value="Professor de Educação Básica II - Matemática">Professor de Educação Básica II – Matemática</option>
                        <option value="Professor de Educação Básica II - Português">Professor de Educação Básica II – Português</option>
                        <option value="Professor de Educação Básica II - Educação Especial">Professor de Educação Básica II – Educação Especial</option>
                        <option value="Professor de Educação Básica II - Judô">Professor de Educação Básica II – Judô</option>
                        <option value="Professor Adjunto">Professor Adjunto</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Auditor">Auditor</option>
                    </select>
                </div>

                <input type="hidden" name="nivel_acesso" id="nivel_acesso" value="0">

                <input type="submit" name="submit" id="submit" value="Enviar">
                <p><button type="button" onclick="window.location.href='index.php'" class="voltar">Voltar</button></p>
            </fieldset>
        </form>
    </div>

    <script>
        function togglePassword() {
            const senhaInput = document.getElementById("senha");
            const toggleIcon = document.getElementById("toggleIcon");
            if (senhaInput.type === "password") {
                senhaInput.type = "text";
                toggleIcon.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                senhaInput.type = "password";
                toggleIcon.classList.replace("fa-eye-slash", "fa-eye");
            }
        }

        function verificarRequisitosSenha() {
            const senha = document.getElementById("senha").value;
            const senhaRequisitos = document.getElementById("senhaRequisitos");

            const requisitos = [
                "A senha deve ter pelo menos 8 caracteres",
                "Deve conter letras maiúsculas",
                "Deve conter letras minúsculas",
                "Deve conter números",
                "Deve conter caracteres especiais"
            ];

            const atendidos = [
                senha.length >= 8,
                /[A-Z]/.test(senha),
                /[a-z]/.test(senha),
                /\d/.test(senha),
                /[^A-Za-z0-9]/.test(senha)
            ];

            let html = "";
            for (let i = 0; i < requisitos.length; i++) {
                html += "- <span" + (atendidos[i] ? " style='color:green'" : "") + ">" + requisitos[i] + "</span>";
                html += atendidos[i] ? " ✓" : "";
                html += "<br>";
            }
            senhaRequisitos.innerHTML = html;
        }

        function validarSenha() {
            const senha = document.getElementById("senha").value;
            const confirmar = document.getElementById("confirmar_senha").value;
            if (senha !== confirmar) {
                document.getElementById("senhaError").innerText = "As senhas não coincidem";
                return false;
            }
            return true;
        }

        // Define o nível de acesso com base na classe selecionada
        document.getElementById("classe_docente").addEventListener("change", function () {
            const valor = this.value;
            let nivel = 0; // padrão para docentes
            if (valor === "Administrador") {
                nivel = 1;
            } else if (valor === "Auditor") {
                nivel = 2;
            }
            document.getElementById("nivel_acesso").value = nivel;
        });
    </script>
</body>
</html>
