<?php 
include_once('config.php');

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se todos os campos necessários foram preenchidos
    if (isset($_POST['titulo'], $_POST['data_certificacao'], $_POST['validade'], $_FILES['certificado_pdf'], $_POST['usuario_id'], $_POST['tipo_certificado'])) {
        
        // Captura dos dados
        $titulo = $_POST['titulo'];
        $data_certificacao = $_POST['data_certificacao'];
        $validade = $_POST['validade'];
        $usuario_id = $_POST['usuario_id']; // Adiciona o usuario_id
        $tipo_certificado = $_POST['tipo_certificado']; // Novo campo

        // **Depuração:** Verificar o valor de tipo_certificado
        // var_dump($_POST); exit();

        // Valida se o tipo de certificado foi selecionado corretamente
        if (empty($tipo_certificado)) {
            echo "Erro: Tipo de Certificado não foi selecionado corretamente.";
            exit();
        }

        // Verifica se o tipo de certificado é válido
        $tipos_validos = [
            'certificado_aprovacao_concurso_outros',
            'certificado_aprovacao_concurso_municipio',
            'diploma_licenciatura',
            'certificado_pos_graduacao',
            'diploma_mestrado',
            'diploma_doutorado',
            'certificados_cursos_nao_secretaria',
            'certificados_cursos_secretaria',
            'certidao_tempo_servico',
            'certidao_assiduidade',
            'certidao_frequencia_htpc',
            'outros_documentos'
        ];
        
        if (!in_array($tipo_certificado, $tipos_validos)) {
            echo "Erro: Tipo de Certificado inválido.";
            exit();
        }

        // Se o campo 'quantidade_horas' não for preenchido, atribui NULL
        $quantidade_horas = !empty($_POST['quantidade_horas']) ? (int)$_POST['quantidade_horas'] : null;
        $data_vencimento = !empty($_POST['data_vencimento']) ? $_POST['data_vencimento'] : null;

        // Lê o arquivo PDF
        $certificado_pdf = file_get_contents($_FILES['certificado_pdf']['tmp_name']);

        // SQL para inserir os dados
        $sql = "INSERT INTO certificado (titulo, data_certificacao, validade, data_vencimento, certificado_pdf, usuario_id, tipo_certificado, quantidade_horas) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepara a declaração SQL
        $stmt = $conexao->prepare($sql);

        // Verifica se houve erro na preparação da declaração
        if ($stmt === false) {
            die("Erro na preparação da declaração: " . $conexao->error);
        }

        // Bind dos parâmetros
        // A sequência de tipos para bind_param:
        // s -> string
        // i -> inteiro
        // b -> blob (para arquivos binários)
        $stmt->bind_param("sssssssi", $titulo, $data_certificacao, $validade, $data_vencimento, $certificado_pdf, $usuario_id, $tipo_certificado, $quantidade_horas);

        // Executa a inserção
        if ($stmt->execute()) {
            // Dados foram inseridos com sucesso
            echo '<script>alert("Dados inseridos com sucesso!");</script>';
            // Redireciona para a página de resumo
            echo '<script>window.location.href = "resumo.php";</script>';
            exit(); 
        } else {
            // Exibe erro, caso a execução da consulta falhe
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
