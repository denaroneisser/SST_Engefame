<!DOCTYPE html>
<html lang="pt-br">
<head>
<?php
//IMPORTANDO BIBLIOTECAS/DEPENDENCIAS
require_once("../objects/Treinamentos.php");
?>
<link rel="stylesheet" href="../styles/AlterarCategoria.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Treinamento</title>
</head>
<body>
    <?php
    if(isset($_GET["idTreinamento"])){
    $treinamento =GetTreinamentoById($_GET["idTreinamento"]);
    }else{
    //FAZER FUNÇÃO DE VOLTAR A PAGINA ANTERIOR
    }
    ?>
    <div class="container">
        <h2>Alterar Treinamento</h2>
        <form action="AlterarTreinamento.php" method="POST">
            <div class="form-group">
                <label for="idTreinamento">ID do Treinamento</label>
                <input type="number" disabled value ="<?php if(Isset($treinamento['idTreinamento'])){echo $treinamento['idTreinamento']; }else{ echo "Erro ao Trazer Dados";} ?>" required>
                <input type="hidden" id="idTreinamento" name="idtreinamento" value ="<?php if(Isset($treinamento['idTreinamento'])){echo $treinamento['idTreinamento']; }else{ echo "Erro ao Trazer Dados";} ?>" required>
            </div>
            <div class="form-group">
                <label for="nome">Nome do Treinamento</label>
                <input type="text" id="nome" name="nome" value ="<?php if(Isset($treinamento['Nome'])){echo $treinamento['Nome']; }else{ echo "Erro ao Trazer Dados";} ?>" required maxlength="45">
            </div>
            <div class="form-group">
                <label for="nome">Descrição</label>
                <textarea id="Descricao" name="descricao" required  rows="4" cols="40" maxlength="200"><?php if(Isset($treinamento['Descricao'])){echo $treinamento['Descricao']; }else{ echo "Erro ao Trazer Dados";} ?></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Salvar Alteração</button>
            </div>
        </form>
    </div>
    
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $resultado = setTreinamentoAlterar($_POST['idtreinamento'],$_POST['nome'],$_POST['descricao']);
            if($resultado==true){
                echo("<script>alert('Treinamento alterada com Sucesso!');</script>");
                echo("<script>window.close();</script>");
            }else{
                echo("<script>alert('FALHA ao alterar Treinamento!');</script>");
                echo($resultado);
            }
 
        } else {
            }


?>