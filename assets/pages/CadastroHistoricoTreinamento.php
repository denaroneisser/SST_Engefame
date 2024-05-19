<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php
    // IMPORTANDO BIBLIOTECAS/DEPENDENCIAS
    require_once("../objects/Categorias.php");
    require_once("../objects/Funcionarios.php");
    require_once("../objects/Treinamentos.php");
    require_once("../objects/Historico_Treinamentos.php");
    require_once("../objects/Empresas.php");
    ?>
    <link rel="stylesheet" href="../styles/CadastroFuncionario.css">
    <script src="../scripts/CadastroHistoricoTreinamento.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Turmas do Treinamento</title>
</head>
<body>
    <div class="container">
        <h2>Cadastro de Turmas do Treinamento</h2>
        <form id="treinamentoForm" action="CadastroHistoricoTreinamento.php" method="POST">
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
                            echo "<option value='" . $empresa["idEmpresas"] . "'>" . $empresa["Nome"] . "</option>";
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
                <label for="funcionario">Funcionarios Participantes</label>
                <input type="text" id="funcionario" name="funcionario" oninput="buscarFuncionarios(this.value)">
                <div id="funcionario-lists" class="funcionario-lists"></div>
                <div id="informacoes-selecionadas" class="informacoes-selecionadas"></div>
            </div>
            <input type="hidden" id="informacoesSelecionadas" name="informacoesSelecionadas">
            <div class="form-group">
                <button type="submit">Cadastrar</button>
            </div>
        </form>
    </div>

    <script>
        const informacoesSelecionadas = [];

        function buscarFuncionarios(nome) {
            if (nome === '') {
                document.getElementById('funcionario-lists').innerHTML = '';
                return;
            }
            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('funcionario-lists').innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", `buscarFuncionarios.php?nome=${nome}`, true);
            xhttp.send();
        }

        function adicionarInformacao(cpf, nome) {
            if (!informacoesSelecionadas.includes(cpf)) {
                informacoesSelecionadas.push(cpf);
                const container = document.getElementById('informacoes-selecionadas');
                const div = document.createElement('div');
                div.className = 'informacao-selecionada';
                div.textContent = `${nome} - ${cpf}`;

                const button = document.createElement('button');
                button.textContent = 'Remover';
                button.onclick = () => removerInformacao(cpf, div);

                div.appendChild(button);
                container.appendChild(div);

                // Atualiza o campo hidden com os CPFs selecionados
                document.getElementById('informacoesSelecionadas').value = JSON.stringify(informacoesSelecionadas);
            } else {
                alert('Esta informação já foi adicionada.');
            }
        }

        function removerInformacao(cpf, element) {
            const index = informacoesSelecionadas.indexOf(cpf);
            if (index !== -1) {
                informacoesSelecionadas.splice(index, 1);
                element.remove();
                
                // Atualiza o campo hidden com os CPFs selecionados
                document.getElementById('informacoesSelecionadas').value = JSON.stringify(informacoesSelecionadas);
            }
        }
    </script>

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
        $funcionarios = json_decode($_POST['informacoesSelecionadas'], true); // Decodifica os funcionários selecionados

        if ($funcionarios) {
            foreach ($funcionarios as $cpf) {
                $categoria =GetFuncionarioByCPF($cpf);
                $Funcionario_Categoria = $categoria['Categorias_idCategoria'];
                $result = setHistoricoTreinamento(
                    $idTreinamento,
                    $cpf,
                    $instrutor,
                    $data_realizacao,
                    $data_validade,
                    $comprovacao,
                    $modalidade,
                    $carga_horaria,
                    $curso_pago,
                    $preco_unitario,
                    $idEmpresa,
                    $Funcionario_Categoria
                );
            }
        }
        if ($result) {
                echo("<script>alert('Histórico de Treinamento Cadastrado com Sucesso!');</script>");
            } else {
                echo("<script>alert('ERRO!');</script>");
            }
}
?>