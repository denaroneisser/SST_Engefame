<!DOCTYPE html>
<html lang="pt-br">
<head>
<?php
//IMPORTANDO BIBLIOTECAS/DEPENDENCIAS
require_once("../objects/Categorias.php");
?>
<link rel="stylesheet" href="../styles/AlterarCategoria.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Categoria</title>
</head>
<body>
    <?php
    if(isset($_GET["idCategoria"])){
    $categoria =GetCategoriaById($_GET["idCategoria"]);
    }else{
    //FAZER FUNÇÃO DE VOLTAR A PAGINA ANTERIOR
    }
    ?>
    <div class="container">
        <h2>Alterar Categoria</h2>
        <form action="AlterarCategoria.php" method="POST">
            <div class="form-group">
                <label for="idcategoria">ID da Categoria</label>
                <label for="idcategoria">CPF</label>
                <input type="text" id="idcategoria" disabled name="idcategoria" value ="<?php if(Isset($categoria['idCategoria'])){echo $categoria['idCategoria']; }else{ echo "Erro ao Trazer Dados";} ?>" required>
            </div>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" value ="<?php if(Isset($categoria['Nome'])){echo $categoria['Nome']; }else{ echo "Erro ao Trazer Dados";} ?>" required maxlength="45">
            </div>
            <div class="form-group">
                <button type="submit">Salvar Alteração</button>
            </div>
        </form>
    </div>
    
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $resultado = setCategoriaAlterar($_POST['nome'],$_POST['idcategoria']);
            if($resultado==true){
                echo("<script>alert('Categoria alterada com Sucesso!');</script>");
                echo("<script>window.close();</script>");
            }else{
                echo("<script>alert('FALHA ao alterar Categoria!');</script>");
                echo($resultado);
            }
 
        } else {
            }


?>