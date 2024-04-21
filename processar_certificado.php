
<?php
include_once('config.php');

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar campos necessários foram preenchidos
    if (isset($_POST['titulo'], $_POST['data_certificacao'], $_POST['validade'], $_FILES['certificado_pdf'], $_POST['usuario_id'])) {
        // inserção no banco de dados
        $titulo = $_POST['titulo'];
        $data_certificacao = $_POST['data_certificacao'];
        $validade = $_POST['validade'];
        $certificado_pdf = file_get_contents($_FILES['certificado_pdf'] ['tmp_name']); // Aqui obtemos o conteúdo do arquivo como uma string de bytes
        $usuario_id = $_POST['usuario_id']; // Adiciona o usuario_id
        
        $data_vencimento = !empty($_POST['data_vencimento']) ? $_POST['data_vencimento'] : null;
        
        // Procurar no SQL 
        $sql = "INSERT INTO certificado (titulo, data_certificacao, validade, data_vencimento, certificado_pdf, usuario_id) VALUES (?, ?, ?, ?, ?, ?)";
        
        
        $stmt = $conexao->prepare($sql);
        
        // Verifica se houve erro 
        if ($stmt === false) {
            die("Erro na preparação da declaração: " . $conexao->error);
        }
        
        
        $stmt->bind_param("sssssi", $titulo, $data_certificacao, $validade, $data_vencimento, $certificado_pdf, $usuario_id);
        
        
        if ($stmt->execute()) {
            // dados foram inseridos com sucesso
            echo '<script>alert("Dados inseridos com sucesso!");</script>';
            // volta a página de registro
            echo '<script>window.location.href = "resumo.php";</script>';
            exit(); 
        } else {
            echo "Erro ao inserir dados: " . $stmt->error;
        }
        
        
        $stmt->close();
    } else {
        echo "Todos os campos obrigatórios devem ser preenchidos!";
    }
    // Fecha a conexão com o banco de dados
    $conexao->close();
}
?>
