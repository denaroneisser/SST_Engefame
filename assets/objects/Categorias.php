<?php
//-----------------------------------------------------------------------
/*/{} Categorias.php
Funções de GET/SET para a Tabela Categoria

@author Vinicius Neisser
@since 15/05/2024
@version 1.0

@Tabela  idCategoria     Tipo de Entrada (0 = Empregado Engefame; 1 = Empregado Terceirizado; ...).
        C_Nome           Nome da Categoria.
@Tabela
/*/
//-----------------------------------------------------------------------



//FUNÇÃO DE INCLUIR CATEGORIA NO BANCO DE DADOS
function setCategorias($C_Nome){
//INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
    require "Conexao.php";
    // CRIANDO O INSERT PARA INCLUIR CATEGORIA
    $SetCategoriaSQL_Insert = "INSERT INTO Categorias (Nome) VALUES (?)";
    $SetCategoriaStament_Insert = $pdo->prepare($SetCategoriaSQL_Insert); 
     // SUBSTITUINDO O VALOR ? DO SQL PELA VARIAVEL
     $SetCategoriaStament_Insert->bindParam(1, $C_Nome); 
    // EXECUTANDO O SQL
        try {
            $SetCategoriaStament_Insert->execute(); 
            return true;

            }catch (PDOException $e) {
                
                echo "Erro PDO: " . $e->getMessage();
            }

}



//FUNÇÃO DE ALTERAR CATEGORIA NO BANCO DE DADOS
function setCategoriasAlterar($C_Nome,$C_idCategoria){
    //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
        require "Conexao.php";
                // CRIANDO O INSERT PARA INCLUIR CATEGORIA
                $setAlterarCategoriaSQL = "UPDATE Categorias SET Nome=? WHERE idCategoria= ?";
                $setAlterarCategoriaStament = $pdo->prepare($setAlterarCategoriaSQL); 
                // SUBSTITUINDO O VALOR :F_Nome,F_CPF,F_Situacao,F_Categoria DO SQL PELA VARIAVEL
                $setAlterarCategoriaStament->bindValue(1, $C_Nome,PDO::PARAM_STR); 
                $setAlterarCategoriaStament->bindValue(2, $C_idCategoria,PDO::PARAM_STR); 
                // EXECUTANDO O SQL
                try {
                    $setAlterarCategoriaStament->execute(); 
                    return true;
    
                }catch (PDOException $e) {
                    
                    echo "Erro PDO: " . $e->getMessage();
                }    
    }



//FUNÇÃO DE BUSCAR CATEGORIA NO BANCO DE DADOS POR ID
Function GetCategoriasById($C_idCategoria){
    //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
    require "Conexao.php";
    // CRIANDO O SELECT PARA CONSULTAR EXISTENCIA DO NOME NO SISTEMA
    $GetCategoriaSQL_Exists = "SELECT * FROM Categorias WHERE idCategoria = ?";
    $GetCategoriaStament = $pdo->prepare($GetCategoriaSQL_Exists); 
    // SUBSTITUINDO O VALOR ? DO SQL PELA VARIAVEL
    $GetCategoriaStament->bindValue(1,$C_idCategoria);
    // EXECUTANDO O SQL UTILIAZANDO UM TRY
    try {
      //SQL EXECUTADA
      $GetCategoriaStament->execute(); 
      //TRANSFORMANDO SQL EXECUTADA EM UM OBJETO ARRAY
      $GetCategoriaObject = $GetCategoriaStament->fetch(PDO::FETCH_ASSOC);
     return $GetCategoriaObject;

     }catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
    }
}


//FUNÇÃO DE BUSCAR CATEGORIA NO BANCO DE DADOS POR NOME
Function GetCategoriasByNome($C_Nome){
    //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
    require "Conexao.php";
    // CRIANDO O SELECT PARA CONSULTAR EXISTENCIA DO NOME NO SISTEMA
    $GetCategoriaSQL_Exists = "SELECT * FROM Categorias WHERE Nome LIKE ?";
    $GetCategoriaStament = $pdo->prepare($GetCategoriaSQL_Exists); 
    // SUBSTITUINDO O VALOR ? DO SQL PELA VARIAVEL
    $GetCategoriaStament->bindValue(1,'%'. $C_Nome.'%', PDO::PARAM_STR);
    // EXECUTANDO O SQL UTILIZANDO UM TRY
    try {
      //SQL EXECUTADA
      $GetCategoriaStament->execute(); 
      //TRANSFORMANDO SQL EXECUTADA EM UM OBJETO ARRAY
      $GetCategoriaObject = $GetCategoriaStament->fetchALL(PDO::FETCH_ASSOC);
     return $GetCategoriaObject;

     }catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
    }
}

//FUNÇÃO DE BUSCAR TODAS AS CATEGORIAS
Function GetCategoriasALL(){
    //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
    require "Conexao.php";
    // CRIANDO O SELECT
    $GetCategoriaSQL = "SELECT idCategoria, Nome FROM Categorias";
    $GetCategoriaStament = $pdo->query($GetCategoriaSQL); 
    // EXECUTANDO O SQL UTILIZANDO UM TRY
    try {
        //SQL EXECUTADA
        $GetCategoriaStament->execute(); 
        //TRANSFORMANDO SQL EXECUTADA EM UM OBJETO ARRAY
        $GetCategoriaObject = $GetCategoriaStament->fetchAll(PDO::FETCH_ASSOC);
       return $GetCategoriaObject;
  
       }catch (PDOException $e) {
        return $e->getMessage();
      }
}


//FUNÇÃO DE DELETAR CATEGORIA NO BANCO DE DADOS POR ID
Function setCategoriasExcluir($C_idCategoria){
    require "Conexao.php";
    // CRIANDO O SELECT PARA CONSULTAR EXISTENCIA DO NOME NO SISTEMA
    $setCateogiraExcluirSQL = "DELETE FROM Categorias WHERE idCategoria= ? ";
    $setCateogiraExcluirStament = $pdo->prepare($setCateogiraExcluirSQL); 
    // SUBSTITUINDO O VALOR ? DO SQL PELA VARIAVEL
    $setCateogiraExcluirStament->bindValue(1, $C_idCategoria, PDO::PARAM_STR);
    // EXECUTANDO O SQL UTILIAZANDO UM TRY
    try {
      //SQL EXECUTADA
      $setCateogiraExcluirStament->execute(); 
      return true;

     }catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
    }
    
}