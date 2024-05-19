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



//FUNÇÃO DE ALTERAR EMPRESA NO BANCO DE DADOS
function setEmpresaAlterar($E_Nome,$E_idEmpresa){
    //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
        require "Conexao.php";
                // CRIANDO O INSERT PARA ALTERAR EMPRESA
                $setAlterarEmpresaSQL = "UPDATE Empresas SET Nome=? WHERE idEmpresas= ?";
                $setAlterarEmpresaStament = $pdo->prepare($setAlterarEmpresaSQL); 
                // SUBSTITUINDO O VALOR ? DO SQL PELA VARIAVEL
                $setAlterarEmpresaStament->bindValue(1, $E_Nome,PDO::PARAM_STR); 
                $setAlterarEmpresaStament->bindValue(2, $E_idEmpresa,PDO::PARAM_STR); 
                // EXECUTANDO O SQL
                try {
                    $setAlterarEmpresaStament->execute(); 
                    return true;
    
                }catch (PDOException $e) {
                    
                    echo "Erro PDO: " . $e->getMessage();
                }    
    }



//FUNÇÃO DE BUSCAR EMPRESA NO BANCO DE DADOS POR ID
Function GetEmpresaById($E_idEmpresa){
    //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
    require "Conexao.php";
    // CRIANDO O SELECT PARA CONSULTAR EXISTENCIA NO SISTEMA
    $GetEmpresaByIdSQL = "SELECT * FROM Empresas WHERE idEmpresas = ?";
    $GetEmpresaByIdStament = $pdo->prepare($GetEmpresaByIdSQL); 
    // SUBSTITUINDO O VALOR ? DO SQL PELA VARIAVEL
    $GetEmpresaByIdStament->bindValue(1,$E_idEmpresa);
    // EXECUTANDO O SQL UTILIAZANDO UM TRY
    try {
      //SQL EXECUTADA
      $GetEmpresaByIdStament->execute(); 
      //TRANSFORMANDO SQL EXECUTADA EM UM OBJETO ARRAY
      $GetEmpresaByIdObject = $GetEmpresaByIdStament->fetch(PDO::FETCH_ASSOC);
     return $GGetEmpresaByIdObject;

     }catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
    }
}


//FUNÇÃO DE BUSCAR EMPRESA NO BANCO DE DADOS POR NOME
Function GetEmpresaByNome($E_Nome){
    //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
    require "Conexao.php";
    // CRIANDO O SELECT PARA CONSULTAR EXISTENCIA DO NOME NO SISTEMA
    $GetEmpresaByNomeSQL_Exists = "SELECT * FROM Empresas WHERE Nome LIKE ?";
    $GetEmpresaByNomeStament = $pdo->prepare($GetEmpresaByNomeSQL_Exists); 
    // SUBSTITUINDO O VALOR ? DO SQL PELA VARIAVEL
    $GetEmpresaByNomeStament->bindValue(1,'%'. $E_Nome.'%', PDO::PARAM_STR);
    // EXECUTANDO O SQL UTILIZANDO UM TRY
    try {
      //SQL EXECUTADA
      $GetEmpresaByNomeStament->execute(); 
      //TRANSFORMANDO SQL EXECUTADA EM UM OBJETO ARRAY
      $GetEmpresaByNomeObject = $GetEmpresaByNomeStament->fetchALL(PDO::FETCH_ASSOC);
     return $GetEmpresaByNomeObject;

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


//FUNÇÃO DE DELETAR EMPRESA NO BANCO DE DADOS POR ID
Function setEmpresaExcluir($E_idEmpresa){
    require "Conexao.php";
    // CRIANDO O SELECT PARA EXCLUIR EXISTENCIA DO NOME NO SISTEMA
    $setEmpresaExcluirSQL = "DELETE FROM Empresas WHERE idEmpresas= ? ";
    $setEmpresaExcluirStament = $pdo->prepare($setEmpresaExcluirSQL); 
    // SUBSTITUINDO O VALOR ? DO SQL PELA VARIAVEL
    $setEmpresaExcluirStament->bindValue(1, $E_idEmpresa, PDO::PARAM_INT);
    // EXECUTANDO O SQL UTILIAZANDO UM TRY
    try {
      //SQL EXECUTADA
      $setEmpresaExcluirStament->execute(); 
      return true;

     }catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
    }
    
}