<!DOCTYPE html>
<html lang="pt-br">
<head>
<?php
//IMPORTANDO BIBLIOTECAS/DEPENDENCIAS
require_once("../objects/categorias.php");
require_once("../objects/funcionarios.php");
?>
<link rel="stylesheet" href="../styles/AlterarFuncionario.css">
<script src="../scripts/AlterarFuncionario.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Funcionarios</title>
</head>
<body>
    <?php
    if(isset($_GET["cpf"])){
    $funcionario =GetFuncionarioByCPF($_GET["cpf"]);
    }else{
    //FAZER FUNÇÃO DE VOLTAR A PAGINA ANTERIOR
    }
    ?>
    <div class="container">
        <h2>Alterar Funcionario</h2>
        <form action="AlterarFuncionario.php" method="POST">
            <div class="form-group">
                <label for="categoria">Categoria</label>
                <select id="categoria" name="categoria" required>
                    <option value="">Selecione</option>
                    <?php
                        // Chame a função getCategorias para obter todas as categorias
                        $categorias = GetCategoriaALL();
                        // Verifique se há categorias e exiba-as
                        if ($categorias) {
                            foreach ($categorias as $categoria) {
                                if($categoria["idCategoria"]==$funcionario['Categorias_idCategoria']){
                                    echo "<option value='" . $categoria["idCategoria"] . "' selected>" . $categoria["Nome"] . "</option>";
                                }else{
                                    echo "<option value='" . $categoria["idCategoria"] . "'>" . $categoria["Nome"] . "</option>";
                                }
                            }
                        } else {
                            echo "Erro ao obter categorias.";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" value ="<?php if(Isset($funcionario['Nome'])){echo $funcionario['Nome']; }else{ echo "Erro ao Trazer Dados";} ?>" required maxlength="45">
            </div>
            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" id="cpf" disabled name="cpf" value ="<?php if(Isset($funcionario['CPF'])){echo $funcionario['CPF']; }else{ echo "Erro ao Trazer Dados";} ?>" required oninput="mascaraCPF(event)" maxlength="14">
            </div>
            <div class="form-group">
                <label for="situacao">Situação</label>
                <select id="situacao" name="situacao" required>
                    <option value="Ativo" <?php if($funcionario['Situacao']==1){echo "selected";}?>>Ativo</option>
                    <option value="Inativo" <?php if($funcionario['Situacao']==0){echo "selected";}?>>Inativo</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" onclick="VerificaCPF(event)">Salvar Alteração</button>
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