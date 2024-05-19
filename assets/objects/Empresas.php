<?php
//-----------------------------------------------------------------------
/*/{} Funcionarios.php
Funções de GET/SET para a Tabela Empresas

@author Vinicius Neisser
@since 19/05/2024
@version 1.0

@Tabela  idEmpresas     Auto Increment.
         E_Nome           Nome da Empresa.
@Tabela
/*/
//-----------------------------------------------------------------------



//FUNÇÃO DE INCLUIR EMPRESA NO BANCO DE DADOS
function setEmpresa($E_Nome){
//INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
    require "Conexao.php";
    // CRIANDO O INSERT PARA INCLUIR EMPRESA
    $SetEmpresaSQL_Insert = "INSERT INTO Empresas (Nome) VALUES (?)";
    $SetEmpresaStament_Insert = $pdo->prepare($SetEmpresaSQL_Insert); 
     // SUBSTITUINDO O VALOR ? DO SQL PELA VARIAVEL
     $SetEmpresaStament_Insert->bindParam(1, $E_Nome); 
    // EXECUTANDO O SQL
        try {
            $SetEmpresaStament_Insert->execute(); 
            return true;

            }catch (PDOException $e) {
                
                echo "Erro PDO: " . $e->getMessage();
            }

}



//FUNÇÃO DE ALTERAR CATEGORIA NO BANCO DE DADOS
function setCategoriaAlterar($C_Nome,$C_idCategoria){
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
Function GetCategoriaById($C_idCategoria){
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
Function GetCategoriaByNome($C_Nome){
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

//FUNÇÃO DE BUSCAR TODAS AS EMPRESAS
Function GetEmpresasALL(){
    //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
    require "Conexao.php";
    // CRIANDO O SELECT
    $GetEmpresasSQL = "SELECT * FROM Empresas";
    $GetEmpresasStament = $pdo->query($GetEmpresasSQL); 
    // EXECUTANDO O SQL UTILIZANDO UM TRY
    try {
        //SQL EXECUTADA
        $GetEmpresasStament->execute(); 
        //TRANSFORMANDO SQL EXECUTADA EM UM OBJETO ARRAY
        $GetCEmpresasObject = $GetEmpresasStament->fetchAll(PDO::FETCH_ASSOC);
       return $GetCEmpresasObject;
  
       }catch (PDOException $e) {
        return $e->getMessage();
      }
}


//FUNÇÃO DE DELETAR CATEGORIA NO BANCO DE DADOS POR ID
Function setCategoriaExcluir($C_idCategoria){
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