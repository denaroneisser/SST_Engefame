<!DOCTYPE html>
<html lang="pt-br">
<head>
<?php
//IMPORTANDO BIBLIOTECAS/DEPENDENCIAS
require_once("../objects/Categorias.php");
require_once("../objects/Funcionarios.php");
require_once("../objects/Treinamentos.php");
require_once("../objects/Empresas.php");
?>
<link rel="stylesheet" href="../styles/CadastroFuncionario.css">
<script src="../scripts/CadastroFuncionario.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Funcionarios</title>
</head>
<body>
    <div class="container">
        <h2>Cadastro de Turmas do Treinamento</h2>
        <form action="CadastroFuncionario.php" method="POST">
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
                <input type="hour" id="carga_horaria" name="carga_horaria" required>
            </div>
            <div class="form-group">Valor do Treinamento por Pessoa</label>
            <label for="curso_pago">É pago?</label>
                <select id="comprovacao" name="curso_pago" required>
                    <option value="1">SIM</option>
                    <option value="0">Não</option>
                </select>
                <input type="number" id="preco_unitario" name="preco_unitario" required>
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
                <button type="submit" onclick="VerificaCPF(event)">Cadastrar</button>
            </div>
        </form>
    </div>
    
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $resultado = setFuncionario($_POST['nome'],$_POST['cpf'],$_POST['situacao'],$_POST['categoria']);
            if($resultado==true){
                echo("<script>alert('Usuário Cadastrado com Sucesso!');</script>");
                echo("<script>window.close();</script>");
            }else{
                echo("<script>alert('CPF Já Existente na Base de Dados');</script>");
                echo($resultado);
            }
 
        } else {
            }


?>