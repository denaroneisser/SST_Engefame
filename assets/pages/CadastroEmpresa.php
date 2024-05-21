<!DOCTYPE html>
<html lang="pt-br">
<head>
<?php
//IMPORTANDO BIBLIOTECAS/DEPENDENCIAS
require_once("../objects/Empresas.php");
?>
<link rel="stylesheet" href="../styles/CadastroEmpresa.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Empresas</title>
</head>
<body>
    <div class="container">
        <h2>Cadastro Empresas</h2>
        <form action="CadastroEmpresa.php" method="POST">
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
require_once("../objects/Empresas.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$resultado = setEmpresas($_POST['nome']);
 if($resultado== true){
    echo("<script>alert('Empresa Cadastrada');</script>");
 
 }else{
    echo("<script>alert('Falha ao Cadastrar');</script>");
 }
 
} else {
}

?>