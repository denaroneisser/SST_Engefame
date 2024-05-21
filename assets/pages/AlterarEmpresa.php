<!DOCTYPE html>
<html lang="pt-br">
<head>
<?php
//IMPORTANDO BIBLIOTECAS/DEPENDENCIAS
require_once("../objects/Empresas.php");
?>
<link rel="stylesheet" href="../styles/AlterarEmpresa.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Empresa</title>
</head>
<body>
    <?php
    if(isset($_GET["idEmpresa"])){
    $categoria =GetEmpresasById($_GET["idEmpresa"]);
    }else{
    //FAZER FUNÇÃO DE VOLTAR A PAGINA ANTERIOR
    }
    ?>
    <div class="container">
        <h2>Alterar Empresa</h2>
        <form action="AlterarEmpresa.php" method="POST">
            <div class="form-group">
                <label for="idempresa">ID da Empresa</label>
                <input type="number" disabled value ="<?php if(Isset($categoria['idEmpresa'])){echo $categoria['idEmpresa']; }else{ echo "Erro ao Trazer Dados";} ?>" required>
                <input type="hidden" id="idempresa" name="idempresa" value ="<?php if(Isset($categoria['idEmpresa'])){echo $categoria['idEmpresa']; }else{ echo "Erro ao Trazer Dados";} ?>" required>
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
        $resultado = setEmpresasAlterar($_POST['nome'],$_POST['idempresa']);
            if($resultado==true){
                echo("<script>alert('Empresa alterada com Sucesso!');</script>");
                echo("<script>window.close();</script>");
            }else{
                echo("<script>alert('FALHA ao alterar Empresa!');</script>");
                echo($resultado);
            }
 
        } else {
            }


?>