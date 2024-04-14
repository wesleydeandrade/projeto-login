<?php
include_once("config.php");

if (isset($_GET['certificado_id'])) {
    $certificado_id = $_GET['certificado_id'];
    
    $stmt = $conexao->prepare("SELECT certificado_pdf FROM certificado WHERE id = ?");
    $stmt->bind_param("i", $certificado_id);
    $stmt->execute();
    $stmt->bind_result($pdf_content);
    $stmt->fetch();
    $stmt->close();

    if ($pdf_content) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="certificado.pdf"'); // Nome padrão do arquivo
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . strlen($pdf_content));
        // Envie o conteúdo do arquivo para o navegador
        echo $pdf_content;
        exit;
    } else {
        echo "Certificado não encontrado.";
    }
} else {
    echo "ID do certificado não fornecido.";
}

$conexao->close();
?>
