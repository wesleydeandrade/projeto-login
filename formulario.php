<?php

if(isset($_POST["submit"])) {
   
    // print_r($_POST['nome']);
    // print_r('<br>');
    // print_r($_POST['email']);
    // print_r('<br>');
    // print_r($_POST['telefone']);
    // print_r('<br>');

 
    include_once('config.php');

    // Peg valores
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT); // Hash da senha
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $genero = $_POST['genero'];
    $data_nascimento = $_POST['data_nascimento'];
    $cidade = $_POST['cidade'];
 

    $stmt = $conexao->prepare("INSERT INTO usuarios(nome,senha, senha_hash, email, telefone, sexo, data_nasc, cidade) VALUES (?, ?, ?, ?, ?, ?, ?,?)");
    $stmt->bind_param("ssssssss", $nome,$senha, $senha_hash, $email, $telefone, $genero, $data_nascimento, $cidade);
    $stmt->execute();

    // Verifica se deu certo
    if ($stmt->affected_rows > 0) {
        echo '<script>alert("Registro foi realizado com Sucesso!");</script>';
        echo '<script>window.location.href = "index.html";</script>';
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário | GN</title>
    <link rel="stylesheet" href="estilo/formulario.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Importe os ícones do Font Awesome -->
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

                <div id="senhaRequisitos" class="password-instructions">
                  
                </div>

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
                    <label for="feminino">Feminino</label>
                    <br>
                    <input type="radio" id="masculino" name="genero" value="masculino" required>
                    <label for="masculino">Masculino</label>
                    <br>
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

                <input type="submit" name="submit" id="submit">
                <p>
                <button type="submit" onclick="window.location.href='index.php'" class="voltar">Voltar</button>
                </p>
            </fieldset>
        </form>
    </div>
    <script>
        function togglePassword() {
            var senhaInput = document.getElementById("senha");
            var toggleIcon = document.getElementById("toggleIcon");
            if (senhaInput.type === "password") {
                senhaInput.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                senhaInput.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }

        function verificarRequisitosSenha() {
    var senha = document.getElementById("senha").value;
    var senhaRequisitos = document.getElementById("senhaRequisitos");

    // Campo do srequiditos da senha
    var requisitos = [
        "A senha deve ter pelo menos 8 caracteres",
        "Deve conter letras maiúsculas",
        "Deve conter letras minúsculas",
        "Deve conter números",
        "Deve conter caracteres especiais"
    ];

    var requisitosAtendidos = [
        senha.length >= 8,
        /[A-Z]/.test(senha),
        /[a-z]/.test(senha),
        /\d/.test(senha),
        /[^A-Za-z0-9]/.test(senha)
    ];

    // Requisitos
    var requisitosString = "";
    for (var i = 0; i < requisitos.length; i++) {
        
        requisitosString += "- ";

     
        requisitosString += "<span";

        // ficar verde enquanto digita
        if (requisitosAtendidos[i]) {
            requisitosString += " style='color:green'";
        }

        
        requisitosString += ">" + requisitos[i] + "</span>";

        
        if (requisitosAtendidos[i]) {
            requisitosString += " ✓";
        }

        
        requisitosString += "<br>";
    }

    
    senhaRequisitos.innerHTML = requisitosString;

    // estilo dos requisitos
    senhaRequisitos.style.fontSize = "0.7em"; // Diminuir o tamanho da fonte
    senhaRequisitos.style.marginTop = "0px"; // Diminuir a margem superior
    senhaRequisitos.style.marginBottom = "15px"; // Diminuir a margem inferior
}


    </script>
</body>
</html>
