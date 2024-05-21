<!DOCTYPE html>
<html lang="pt-br">
<head>
<?php
//IMPORTANDO BIBLIOTECAS/DEPENDENCIAS
require_once("../objects/Categorias.php");
require_once("../objects/Funcionarios.php");
require_once("../objects/Treinamentos.php");
require_once("../objects/Empresas.php");
require_once("../objects/Turmas.php");
require_once("../objects/Turmas_has_Funcionarios.php");
require_once("../objects/Acompanhamento_Turmas.php");
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="../styles/Apagar.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APAGAR</title>
</head>
<body>
    <?php
    ?>
    <div class="container">
        <h2>Apagar</h2>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['idTreinamento'])){
            if(setTreinamentosExcluir($_POST['idTreinamento'])){
                echo "<div class='alert alert-success' role='alert'>Treinamento apagada!</div>";
                unset($_POST['idTreinamento']);
            }
        }
        if(isset($_POST['idTurma'])){
            if(setTurmasExcluir($_POST['idTurma'])){
                echo "<div class='alert alert-success' role='alert'>Turma apagada!</div>";
                unset($_POST['idTurma']);
            }
        }
        if(isset($_POST['cpf'])){
            if(setFuncionariosExcluir($_POST['cpf'])){
                echo "<div class='alert alert-success' role='alert'>Funcionário apagado!</div>";
                unset($_POST['cpf']);
            }
        }
        if(isset($_POST['idCategoria'])){
            if(setCategoriasExcluir($_POST['idCategoria'])){
                echo "<div class='alert alert-success' role='alert'>Categoria apagada!</div>";
                unset($_POST['idCategoria']);
            }
        }
        if(isset($_POST['idempresa'])){
            if(setEmpresasExcluir($_POST['idempresa'])){
                echo "<div class='alert alert-success' role='alert'>Empresa apagada!</div>";
                unset($_POST['idempresa']);
            }
        }
        if(isset($_POST['idTurma'])){
            if(setTurmasExcluir($_POST['idTurma'])){
                echo "<div class='alert alert-success' role='alert'>Turma apagada!</div>";
                unset($_POST['idTurma']);
            }
        }


    }else{

        echo "<div class='alert alert-danger' role='alert'>Parametros não recebidos!</div>";
        }

    ?>



    </div>
    
<?php
?>