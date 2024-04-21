<?php

if(isset($_POST["submit"])) {
    // Evite comentários desnecessários
    // print_r($_POST['nome']);
    // print_r('<br>');
    // print_r($_POST['email']);
    // print_r('<br>');
    // print_r($_POST['telefone']);
    // print_r('<br>');

    // inclui a conexao com os servidor
    include_once('config.php');

    // Pega os valores
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

    // Verifique se deu certo
    if ($stmt->affected_rows > 0) {
        echo '<script>alert("Registro foi realizado com Sucesso!");</script>';
        echo '<script>window.location.href = "index.php";</script>';
    } else {
        echo "Erro ao inserir no banco de dados.";
    }

    // encerra
    $stmt->close();
}

?>
