<!DOCTYPE html>
<html lang="pt-br">
<head>
<?php
//IMPORTANDO BIBLIOTECAS/DEPENDENCIAS
require_once("../objects/Categorias.php");
require_once("../objects/Funcionarios.php");
require_once("../objects/Treinamentos.php");
require_once("../objects/Historico_Treinamentos.php");
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="../styles/Apagar.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APAGAR</title>
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
        <h2>Apagar</h2>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['idTreinamento'])){
            if(setTreinamentoExcluir($_POST['idTreinamento'])){
                echo "<div class='alert alert-success' role='alert'>Treinamento apagada!</div>";
                unset($_POST['idTreinamento']);
            }
        }
        if(isset($_POST['idHistoricoTreinamento'])){
            if(setHistoricoTreinamentoExcluir($_POST['idHistoricoTreinamento'])){
                echo "<div class='alert alert-success' role='alert'>Turma apagado!</div>";
                unset($_POST['idHistoricoTreinamento']);
            }
        }
        if(isset($_POST['cpf'])){
            if(setFuncionarioExcluir($_POST['cpf'])){
                echo "<div class='alert alert-success' role='alert'>Funcionário apagado!</div>";
                unset($_POST['cpf']);
            }
        }
        if(isset($_POST['idCategoria'])){
            if(setCategoriaExcluir($_POST['idCategoria'])){
                echo "<div class='alert alert-success' role='alert'>Categoria apagada!</div>";
                unset($_POST['idCategoria']);
            }
        }


    }else{

        echo "<div class='alert alert-danger' role='alert'>Parametros não recebidos!</div>";
        }

    ?>



    </div>
    
<?php
?>