<?php 
include_once('config.php');

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['titulo'], $_POST['data_certificacao'], $_POST['validade'], $_FILES['certificado_pdf'], $_POST['usuario_id'], $_POST['tipo_certificado'])) {
        
        $titulo = $_POST['titulo'];
        $data_certificacao = $_POST['data_certificacao'];
        $validade = $_POST['validade'];
        $usuario_id = $_POST['usuario_id'];
        $tipo_certificado = $_POST['tipo_certificado'];

        if (empty($tipo_certificado)) {
            echo "Erro: Tipo de Certificado não foi selecionado corretamente.";
            exit();
        }

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

        $quantidade_horas = !empty($_POST['quantidade_horas']) ? (int)$_POST['quantidade_horas'] : 0;
        
        // Como o formulário não envia 'dias', consideramos zero para certidao_tempo_servico
        $dias = 0;

        // Cálculo da pontuação conforme o tipo de certificado
        switch ($tipo_certificado) {
            case 'certificado_aprovacao_concurso_outros':
                $pontuacao = 10;
                break;
            case 'certificado_aprovacao_concurso_municipio':
                $pontuacao = 1;
                break;
            case 'diploma_licenciatura':
            case 'certificado_pos_graduacao':
                $pontuacao = 1;
                break;
            case 'diploma_mestrado':
                $pontuacao = 3;
                break;
            case 'diploma_doutorado':
                $pontuacao = 5;
                break;
            case 'certificados_cursos_nao_secretaria':
                $pontuacao = 0.005 * $quantidade_horas;
                break;
            case 'certificados_cursos_secretaria':
                $pontuacao = 0.010 * $quantidade_horas;
                break;
            case 'certidao_tempo_servico':
                $pontuacao = 0.005 * $dias; // sempre 0 pois formulário não envia
                break;
            case 'certidao_assiduidade':
                $pontuacao = 3;
                break;
            case 'certidao_frequencia_htpc':
                $pontuacao = 2;
                break;
            default:
                $pontuacao = 0;
        }

        $data_vencimento = !empty($_POST['data_vencimento']) ? $_POST['data_vencimento'] : null;

        $certificado_pdf = file_get_contents($_FILES['certificado_pdf']['tmp_name']);

        $sql = "INSERT INTO certificado (titulo, data_certificacao, validade, data_vencimento, certificado_pdf, usuario_id, tipo_certificado, quantidade_horas, pontuacao) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conexao->prepare($sql);

        if ($stmt === false) {
            die("Erro na preparação da declaração: " . $conexao->error);
        }

        $stmt->bind_param("sssssssid", $titulo, $data_certificacao, $validade, $data_vencimento, $certificado_pdf, $usuario_id, $tipo_certificado, $quantidade_horas, $pontuacao);

        if ($stmt->execute()) {
            echo '<script>alert("Dados inseridos com sucesso!");</script>';
            echo '<script>window.location.href = "resumo.php";</script>';
            exit(); 
        } else {
            echo "Erro ao inserir dados: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Todos os campos obrigatórios devem ser preenchidos!";
    }

    $conexao->close();
}
?>
