<!DOCTYPE html>
<html lang="pt-br">
<head>
<?php
//IMPORTANDO BIBLIOTECAS/DEPENDENCIAS
require_once("../objects/Treinamentos.php");
?>
<link rel="stylesheet" href="../styles/CadastroTreinamento.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Treinamento</title>
</head>
<body>
    <div class="container">
        <h2>Cadastro</h2>
        <form action="CadastroTreinamento.php" method="POST">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" required maxlength="45">
            </div>
            <div class="form-group">
                <label for="nome">Descrição</label>
                <textarea id="Descricao" name="descricao" required  rows="4" cols="40" maxlength="200"></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Cadastrar</button>
            </div>
        </form>
    </div>
    
<?php
require_once("../objects/categorias.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$resultado = setTreinamento($_POST['nome'],$_POST['descricao']);
 if($resultado== true){
    echo("<script>alert('Treinamento Cadastrado!');</script>");
 
 }else{
    echo("<script>alert('Falha ao Cadastrar');</script>");
 }
 
} else {
}

?>