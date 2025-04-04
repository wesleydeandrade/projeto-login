<?php
session_start();

if(isset($_POST['email']) && isset($_POST['senha'])) {
    include_once('config.php');
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

  
    $sql = "SELECT id, nome, senha_hash, nivel_acesso FROM usuarios WHERE email = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        // Procura os dados no banco
        $row = $result->fetch_assoc();
        $senha_hash_banco = $row['senha_hash'];
        $nome = $row['nome'];
        $usuario_id = $row['id'];
        $permissao = $row['nivel_acesso'];


        if (password_verify($senha, $senha_hash_banco)) {
            

            // guarda as informações na sessão
            $_SESSION['email'] = $email;
            $_SESSION['nome'] = $nome;
            $_SESSION['id'] = $usuario_id;
            $_SESSION['nivel_acesso'] = $permissao;

            // controle de acesso
            if ($permissao == 1) {
                header('Location: administrador.php'); 
                exit();
            }elseif ($permissao == 2) {
                header('Location: auditar.php');
                exit();
            }else{
            header('Location: resumo.php');
            exit();
            }

            //header('Location: resumo.php');
            //exit(); 
        } else {
            // A senha está incorreta
            echo '<script>alert("Senha incorreta!");</script>';
            echo '<script>window.location.href = "index.html";</script>';
            exit();
        }
    } else {
        // Email não encontrado
        echo '<script>alert("Email não encontrado!");</script>';
        echo '<script>window.location.href = "index.html";</script>';
            exit();
    }
}
?>