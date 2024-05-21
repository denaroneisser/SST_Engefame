<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php
    // IMPORTANDO BIBLIOTECAS/DEPENDENCIAS
    require_once("../objects/Categorias.php");
    require_once("../objects/Treinamentos.php");
    require_once("../objects/Turmas.php");
    require_once("../objects/Empresas.php");
    ?>
    <link rel="stylesheet" href="../styles/CadastroFuncionario.css">
    <script src="../scripts/CadastroHistoricoTreinamento.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Turmas</title>
</head>
<body>
    <div class="container">
        <h2>Cadastro de Turmas</h2>
        <form id="treinamentoForm" action="CadastroTurma.php" method="POST">
            <div class="form-group">
                <label for="idTreinamento">Nome do Treinamento</label>
                <select id="idTreinamento" name="idTreinamento" required>
                    <option value="">Selecione</option>
                    <?php
                    $treinamentos = GetTreinamentosALL();
                    if ($treinamentos) {
                        foreach ($treinamentos as $treinamento) {
                            echo "<option value='" . $treinamento["idTreinamento"] . "'>" . $treinamento["Nome"] . "</option>";
                        }
                    } else {
                        echo "Erro ao obter Treinamentos.";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="idEmpresa">Nome da Empresa Ministrante</label>
                <select id="idEmpresa" name="idEmpresa" required>
                    <option value="">Selecione</option>
                    <?php
                    $empresas = GetEmpresasALL();
                    if ($empresas) {
                        foreach ($empresas as $empresa) {
                            echo "<option value='" . $empresa["idEmpresa"] . "'>" . $empresa["Nome"] . "</option>";
                        }
                    } else {
                        echo "Erro ao obter Empresas.";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="data_realizacao">Data da Realização do Treinamento</label>
                <input type="date" id="data_realizacao" name="data_realizacao" required value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="form-group">
                <label for="data_validade">Data da Expiração do Treinamento</label>
                <input type="date" id="data_validade" name="data_validade" required>
            </div>
            <div class="form-group">
                <label for="instrutor">Nome do Instrutor</label>
                <input type="text" id="instrutor" name="instrutor" required>
            </div>
            <div class="form-group">
                <label for="carga_horaria">Carga Horária</label>
                <input type="time" id="carga_horaria" name="carga_horaria" required>
            </div>
            <div class="form-group">
                <label for="curso_pago">É pago?</label>
                <select id="curso_pago" name="curso_pago" required>
                    <option value="1">SIM</option>
                    <option value="0">Não</option>
                </select>
                <label for="preco_unitario">Valor do Treinamento por Pessoa</label>
                <input type="number" id="preco_unitario" name="preco_unitario" required placeholder="0.00">
            </div>
            <div class="form-group">
                <label for="modalidade">Modalidade</label>
                <select id="modalidade" name="modalidade" required>
                    <option value="1">Presencial</option>
                    <option value="0">Online</option>
                </select>
            </div>
            <div class="form-group">
                <label for="comprovacao">Precisa de Comprovação?</label>
                <select id="comprovacao" name="comprovacao" required>
                    <option value="1">SIM</option>
                    <option value="0">Não</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Cadastrar</button>
            </div>
        </form>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $idTreinamento = $_POST['idTreinamento'];
        $idEmpresa = $_POST['idEmpresa'];
        $data_realizacao = $_POST['data_realizacao'];
        $data_validade = $_POST['data_validade'];
        $instrutor = $_POST['instrutor'];
        $carga_horaria = $_POST['carga_horaria'];
        $curso_pago = $_POST['curso_pago'];
        $preco_unitario = $_POST['preco_unitario'];
        $modalidade = $_POST['modalidade'];
        $comprovacao = $_POST['comprovacao'];
        echo 'A EMPRESA:'.$_POST['idEmpresa'];
        if ($result=SetTurmas($idEmpresa,$idTreinamento,$instrutor,$data_realizacao,$data_validade,$comprovacao,$modalidade,$carga_horaria,$preco_unitario,$curso_pago)) {
                echo("<script>alert('Turma Cadastrada com Sucesso!');</script>");
            } else {
                echo("<script>alert('ERRO!');</script>");
            }
}
?>