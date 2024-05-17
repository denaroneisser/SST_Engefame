<!DOCTYPE html>
<html lang="pt-br">
<head>
<?php
//IMPORTANDO BIBLIOTECAS/DEPENDENCIAS
require_once("../objects/Categorias.php");
require_once("../objects/Funcionarios.php");
?>
<link rel="stylesheet" href="../styles/CadastroFuncionario.css">
<script src="../scripts/CadastroFuncionario.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Funcionarios</title>
</head>
<body>
    <div class="container">
        <h2>Cadastro de Funcionarios</h2>
        <form action="CadastroFuncionario.php" method="POST">
            <div class="form-group">
                <label for="categoria">Categoria</label>
                <select id="categoria" name="categoria" required>
                    <option value="">Selecione</option>
                    <?php
                        // Chame a função getCategorias para obter todas as categorias
                        $categorias = GetCategoriasALL();
                        // Verifique se há categorias e exiba-as
                        if ($categorias) {
                            foreach ($categorias as $categoria) {
                                echo "<option value='" . $categoria["idCategoria"] . "'>" . $categoria["Nome"] . "</option>";;
                            }
                        } else {
                            echo "Erro ao obter categorias.";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" required maxlength="45">
            </div>
            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" required oninput="mascaraCPF(event)" maxlength="14">
            </div>
            <div class="form-group">
                <label for="situacao">Situação</label>
                <select id="situacao" name="situacao" required>
                    <option value="Ativo">Ativo</option>
                    <option value="Inativo">Inativo</option>
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