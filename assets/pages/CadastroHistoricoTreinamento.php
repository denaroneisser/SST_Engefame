<!DOCTYPE html>
<html lang="pt-br">
<head>
<?php
//IMPORTANDO BIBLIOTECAS/DEPENDENCIAS
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
    <title>Cadastro Funcionarios</title>
</head>
<body>
    <div class="container">
        <h2>Cadastro de Turmas do Treinamento</h2>
        <form action="CadastroHistoricoTreinamento.php" method="POST">
            <div class="form-group">
                <label for="idtreinamento">Nome do Treinamento</label>
                <select id="idtreinamento" name="idtreinamento" required>
                    <option value="">Selecione</option>
                    <?php
                        // Chame a função getCategorias para obter todas as categorias
                        $treinamentos = GetTreinamentosALL();
                        // Verifique se há categorias e exiba-as
                        if ($treinamentos) {
                            foreach ($treinamentos as $treinamento) {
                                echo "<option value='" . $treinamento["idTreinamento"] . "'>" . $treinamento["Nome"] . "</option>";;
                            }
                        } else {
                            echo "Erro ao obter Treinamentos.";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="idtreinamento">Nome da Empresa Ministrante</label>
                <select id="idtreinamento" name="idtreinamento" required>
                    <option value="">Selecione</option>
                    <?php
                        // Chame a função getCategorias para obter todas as categorias
                        $empresas = GetEmpresasALL();
                        // Verifique se há categorias e exiba-as
                        if ($empresas) {
                            foreach ($empresas as $empresa) {
                                echo "<option value='" . $empresa["idEmpresas"] . "'>" . $empresa["Nome"] . "</option>";;
                            }
                        } else {
                            echo "Erro ao obter Treinamentos.";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="nome">Data da Realização do Treinamento</label>
                <input type="date" id="data_realizacao" name="data_realizacao" required value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="form-group">
                <label for="nome">Data da Expiração do Treinamento</label>
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
            <div class="form-group">Valor do Treinamento por Pessoa</label>
            <label for="curso_pago">É pago?</label>
                <select id="comprovacao" name="curso_pago" required>
                    <option value="1">SIM</option>
                    <option value="0">Não</option>
                </select>
                <input type="number" id="preco_unitario" name="preco_unitario" required placeholder="0.00">
            </div>
            <div class="form-group">
                <label for="modalidade">Modalide</label>
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
                <label for="comprovacao">Funcionarios Participantes</label>
            <input type="text" id="funcionario" name="funcionario" oninput="buscarFuncionarios(this.value)">
            <div id="funcionario-lists" class="funcionario-lists"></div>
            <div id="informacoes-selecionadas" class="informacoes-selecionadas"></div>
            </div>
            <div cform-group">
                <button type="submit" >Cadastrar</button>
            </div>
        </form>
    </div>





    <script>
        //=============================================================================================
        // Array para armazenar as informações selecionadas
        const informacoesSelecionadas = [];

        // Função para buscar funcionários por nome
        function buscarFuncionarios(nome) {
            // Verifica se o campo de busca está vazio
            if (nome === '') {
                document.getElementById('funcionario-lists').innerHTML = '';
                return;
            }
            // Faz uma requisição AJAX para buscar os funcionários
            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('funcionario-lists').innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", `buscarFuncionarios.php?nome=${nome}`, true);
            xhttp.send();
        }

        // Função para adicionar uma informação selecionada
        function adicionarInformacao(cpf, nome) {
            // Verifica se a informação já foi adicionada
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
            } else {
                alert('Esta informação já foi adicionada.');
            }
        }

        // Função para remover uma informação selecionada
        function removerInformacao(cpf, element) {
            const index = informacoesSelecionadas.indexOf(cpf);
            if (index !== -1) {
                informacoesSelecionadas.splice(index, 1);
                element.remove();
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

    foreach ($funcionarios as $cpf) {
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
            $idEmpresa
        );
    }

    if ($result) {
        echo("<script>alert('Histórico de Treinamento Cadastrado com Sucesso!');</script>");
    } else {
        echo("<script>alert('Erro ao Cadastrar Histórico de Treinamento');</script>");
    }
}

?>