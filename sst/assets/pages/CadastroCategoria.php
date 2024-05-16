<!DOCTYPE html>
<html lang="pt-br">
<head>
<?php
//IMPORTANDO BIBLIOTECAS/DEPENDENCIAS
require_once("../objects/categorias.php");
?>
<link rel="stylesheet" href="../styles/CadastroCategoria.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Categorias</title>
</head>
<body>
    <div class="container">
        <h2>Cadastro</h2>
        <form action="CadastroCategoria.php" method="POST">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" required maxlength="45">
            </div>
            <div class="form-group">
                <button type="submit">Cadastrar</button>
            </div>
        </form>
    </div>
    
<?php
require_once("../objects/categorias.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$resultado = setCategoria($_POST['nome']);
 if($resultado== true){
    echo("<script>alert('Categoria de Funcionário Cadastrada');</script>");
 
 }else{
    echo("<script>alert('Falha ao Cadastrar');</script>");
 }
 
} else {
}

?>