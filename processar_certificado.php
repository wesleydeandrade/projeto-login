<?php
include_once('config.php');

// Verifica se o formulário foi enviado via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se todos os campos necessários foram preenchidos
    if (isset($_POST['titulo'], $_POST['data_certificacao'], $_POST['validade'])) {
        // Prepara os dados para inserção no banco de dados
        $titulo = $_POST['titulo'];
        $data_certificacao = $_POST['data_certificacao'];
        $validade = $_POST['validade'];
        
        // Verifica se o campo de data de vencimento foi preenchido
        $data_vencimento = !empty($_POST['data_vencimento']) ? $_POST['data_vencimento'] : null;
        
        // Prepara a consulta SQL de inserção
        $sql = "INSERT INTO certificado (titulo, data_certificacao, validade, data_vencimento) VALUES (?, ?, ?, ?)";
        
        // Prepara a declaração SQL
        $stmt = $conexao->prepare($sql);
        
        // Verifica se houve erro na preparação da declaração
        if ($stmt === false) {
            die("Erro na preparação da declaração: " . $conexao->error);
        }
        
        // Binda os parâmetros à declaração SQL
        $stmt->bind_param("ssss", $titulo, $data_certificacao, $validade, $data_vencimento);
        
        // Executa a declaração SQL
        if ($stmt->execute()) {
            // Exibe um pop-up informando que os dados foram inseridos com sucesso
            echo '<script>alert("Dados inseridos com sucesso!");</script>';
            // Redireciona o usuário de volta à página de registro
            echo '<script>window.location.href = "sistema.php";</script>';
            exit(); // Certifica-se de que o script não continue a ser executado após o redirecionamento
        } else {
            echo "Erro ao inserir dados: " . $stmt->error;
        }
        
        // Fecha a declaração
        $stmt->close();
    } else {
        echo "Todos os campos obrigatórios devem ser preenchidos!";
    }
    // Fecha a conexão com o banco de dados
    $conexao->close();
}
?>

