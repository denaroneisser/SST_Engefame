<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php
    // Importando bibliotecas/dependências
    require_once("../objects/Treinamentos.php");
    ?>
    <link rel="stylesheet" href="../styles/AlterarCategoria.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Treinamento</title>
</head>
<body>
    <?php
    // Verifica se há um parâmetro "idTreinamento" na URL
    if (isset($_GET["idTreinamento"])) {
        // Se existir, obtém os detalhes do treinamento com base no ID
        $treinamento = GetTreinamentoById($_GET["idTreinamento"]);
    } else {
        // Se não houver, redireciona o usuário para a página anterior
        echo "<script>history.back();</script>";
        // Encerra o script para evitar que o restante da página seja processado
        exit;
    }
    ?>
    <div class="container">
        <h2>Alterar Treinamento</h2>
        <!-- Formulário para alterar os dados do treinamento -->
        <form id="alterarTreinamentoForm" action="AlterarTreinamento.php" method="POST">
            <div class="form-group">
                <label for="idTreinamento">ID do Treinamento</label>
                <!-- Campo para exibir o ID do treinamento (desabilitado para edição) -->
                <input type="number" disabled value="<?php echo isset($treinamento['idTreinamento']) ? $treinamento['idTreinamento'] : 'Erro ao Trazer Dados'; ?>" required>
                <!-- Campo oculto para enviar o ID do treinamento no formulário -->
                <input type="hidden" id="idTreinamento" name="idTreinamento" value="<?php echo isset($treinamento['idTreinamento']) ? $treinamento['idTreinamento'] : 'Erro ao Trazer Dados'; ?>" required>
            </div>
            <div class="form-group">
                <label for="nome">Nome</label>
                <!-- Campo de entrada para o nome do treinamento -->
                <input type="text" id="nome" name="nome" value="<?php echo isset($treinamento['Nome']) ? $treinamento['Nome'] : 'Erro ao Trazer Dados'; ?>" required maxlength="45">
            </div>
            <div class="form-group">
                <label for="empresa_fornecedora">Empresa Fornecedora</label>
                <!-- Campo de entrada para a empresa fornecedora do treinamento -->
                <input type="text" id="empresa_fornecedora" name="empresa_fornecedora" value="<?php echo isset($treinamento['Empresa_Fornecedora']) ? $treinamento['Empresa_Fornecedora'] : 'Erro ao Trazer Dados'; ?>" required maxlength="45">
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <!-- Campo de entrada para a descrição do treinamento -->
                <textarea id="descricao" name="descricao" required><?php echo isset($treinamento['Descricao']) ? $treinamento['Descricao'] : 'Erro ao Trazer Dados'; ?></textarea>
            </div>
            <div class="form-group">
                <!-- Botão para salvar as alterações (type="button" para evitar envio direto) -->
                <button type="button" id="salvarAlteracaoBtn">Salvar Alteração</button>
            </div>
        </form>
    </div>

    <?php
    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Certifique-se de que os dados estão sendo recebidos corretamente
        $nome = $_POST['nome'];
        $empresa_fornecedora = $_POST['empresa_fornecedora'];
        $descricao = $_POST['descricao'];
        $idTreinamento = $_POST['idTreinamento'];

        // Verifica se todos os campos estão preenchidos
        if (!empty($nome) && !empty($empresa_fornecedora) && !empty($descricao) && !empty($idTreinamento)) {
            // Chame a função para atualizar os dados do treinamento
            $resultado = setTreinamentoAlterar($nome, $empresa_fornecedora, $descricao, $idTreinamento);
            if ($resultado == true) {
                // Exibe mensagem de sucesso e fecha a janela
                echo "<script>alert('Treinamento alterado com Sucesso!');</script>";
                echo "<script>window.close();</script>";
            } else {
                // Exibe mensagem de falha
                echo "<script>alert('FALHA ao alterar Treinamento!');</script>";
                echo $resultado;
            }
        } else {
            // Exibe alerta se algum campo estiver vazio
            echo "<script>alert('Todos os campos são obrigatórios!');</script>";
        }
    }

    // Função para atualizar o treinamento no banco de dados
    function setTreinamentoAlterar($nome, $empresa_fornecedora, $descricao, $idTreinamento) {
        // Supondo que a conexão com o banco de dados esteja definida em $conn
        global $conn;

        // Prepara a consulta SQL para atualização
        $sql = "UPDATE Treinamentos SET Nome = ?, Empresa_Fornecedora = ?, Descricao = ? WHERE idTreinamento = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssi", $nome, $empresa_fornecedora, $descricao, $idTreinamento);
            if ($stmt->execute()) {
                return true;
            } else {
                return "Erro ao executar a consulta: " . $stmt->error;
            }
        } else {
            return "Erro ao preparar a consulta: " . $conn->error;
        }
    }
    ?>

    <!-- JavaScript para submeter o formulário quando o botão "Salvar Alteração" for clicado -->
    <script>
        document.getElementById("salvarAlteracaoBtn").addEventListener("click", function() {
            document.getElementById("alterarTreinamentoForm").submit();
        });
    </script>
</body>
</html>
