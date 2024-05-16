<?php
//-----------------------------------------------------------------------
/*/{} Funcionarios.php
Funções de GET/SET para a Tabela Treinamentos

@author Vinicius Neisser
@since 16/05/2024
@version 1.0

@Tabela T_idTreinamento          Auto Increment.
        T_Nome                  Nome do Treinamento.
        T_Descricao             Descrição do Treinamento.
        T_Empresa_Fornecedora   Empresa que deu o Treinamento.
@Tabela
/*/
//-----------------------------------------------------------------------



//FUNÇÃO DE INCLUIR TREINAMENTO NO BANCO DE DADOS
function setTreinamento($T_Nome,$T_Descricao,$T_Empresa_Fornecedora){
//INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
    require "Conexao.php";
    // CRIANDO O INSERT PARA INCLUIR CATEGORIA
    $setTreinamentoSQL_Insert = "INSERT INTO Treinamentos (Nome,Descricao,Empresa_Fornecedora) VALUES (?,?,?)";
    $setTreinamentoStament_Insert = $pdo->prepare($setTreinamentoSQL_Insert); 
     // SUBSTITUINDO O VALOR ? DO SQL PELA VARIAVEL
     $setTreinamentoStament_Insert->bindParam(1, $T_Nome);
     $setTreinamentoStament_Insert->bindParam(2, $T_Descricao);
     $setTreinamentoStament_Insert->bindParam(3, $T_Empresa_Fornecedora); 
    // EXECUTANDO O SQL
        try {
            $setTreinamentoStament_Insert->execute(); 
            return true;

            }catch (PDOException $e) {
                
                echo "Erro PDO: " . $e->getMessage();
            }

}



//FUNÇÃO DE ALTERAR TREINAMENTO NO BANCO DE DADOS
function setAlterarTreinamento($T_idCategoria,$T_Nome,$T_Descricao,$T_Empresa_Fornecedora){
    //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
        require "Conexao.php";
                // CRIANDO O INSERT PARA INCLUIR CATEGORIA
                $setAlterarCategoriaSQL = "UPDATE Treinamentos SET Nome=?,Descricao=?,Empresa_Fornecedora=? WHERE idTreinamento= ?";
                $setAlterarCategoriaStament = $pdo->prepare($setAlterarCategoriaSQL); 
                // SUBSTITUINDO O VALOR ? DO SQL PELA VARIAVEL
                $setAlterarCategoriaStament->bindValue(1, $T_Nome,PDO::PARAM_STR); 
                $setAlterarCategoriaStament->bindValue(2, $T_Descricao,PDO::PARAM_STR);
                $setAlterarCategoriaStament->bindValue(3, $T_Empresa_Fornecedora,PDO::PARAM_STR);
                $setAlterarCategoriaStament->bindValue(4, $T_idCategoria,PDO::PARAM_INT); 
                // EXECUTANDO O SQL
                try {
                    $setAlterarCategoriaStament->execute(); 
                    return true;
    
                }catch (PDOException $e) {
                    
                    echo "Erro PDO: " . $e->getMessage();
                }    
    }



//FUNÇÃO DE BUSCAR TREIMANETO NO BANCO DE DADOS POR ID
Function GetTreinamentoById($T_idTreinamento){
    //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
    require "Conexao.php";
    // CRIANDO O SELECT PARA CONSULTAR EXISTENCIA DO NOME NO SISTEMA
    $GetTreinamentoByIdSQL_Exists = "SELECT * FROM Treinamentos WHERE idTreinamento = ?";
    $GetTreinamentoByIdStament = $pdo->prepare($GetTreinamentoByIdSQL_Exists); 
    // SUBSTITUINDO O VALOR ? DO SQL PELA VARIAVEL
    $GetTreinamentoByIdStament->bindValue(1,$T_idTreinamento);
    // EXECUTANDO O SQL UTILIAZANDO UM TRY
    try {
      //SQL EXECUTADA
      $GetTreinamentoByIdStament->execute(); 
      //TRANSFORMANDO SQL EXECUTADA EM UM OBJETO ARRAY
      $GetTreinamentoByIdObject = $GetTreinamentoByIdStament->fetch(PDO::FETCH_ASSOC);
     return $GetTreinamentoByIdObject;

     }catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
    }
}



//FUNÇÃO DE BUSCAR TREINAMENTO NO BANCO DE DADOS POR NOME
Function GetTreinamentoByNome($T_Nome){
    //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
    require "Conexao.php";
    // CRIANDO O SELECT PARA CONSULTAR EXISTENCIA DO NOME NO SISTEMA
    $GetTreinamentoSQL_Exists = "SELECT * FROM Treinamentos WHERE Nome LIKE ?";
    $GetTreinamentoStament = $pdo->prepare($GetTreinamentoSQL_Exists); 
    // SUBSTITUINDO O VALOR ? DO SQL PELA VARIAVEL
    $GetTreinamentoStament->bindValue(1,'%'. $T_Nome.'%', PDO::PARAM_STR);
    // EXECUTANDO O SQL UTILIZANDO UM TRY
    try {
      //SQL EXECUTADA
      $GetTreinamentoStament->execute(); 
      //TRANSFORMANDO SQL EXECUTADA EM UM OBJETO ARRAY
      $GetTreinamentoObject = $GetTreinamentoStament->fetchALL(PDO::FETCH_ASSOC);
     return $GetTreinamentoObject;

     }catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
    }
}



//FUNÇÃO DE BUSCAR TODAS OS TREINAMENTOS
Function GetTreinamentosALL(){
    //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
    require "Conexao.php";
    // CRIANDO O SELECT
    $GetTreinamentosALLSQL = "SELECT * FROM Treinamentos";
    $GetTreinamentosALLStament = $pdo->query($GetTreinamentosALLSQL); 
    // EXECUTANDO O SQL UTILIZANDO UM TRY
    try {
        //SQL EXECUTADA
        $GetTreinamentosALLStament->execute(); 
        //TRANSFORMANDO SQL EXECUTADA EM UM OBJETO ARRAY
        $GetTreinamentosALLObject = $GetTreinamentosALLStament->fetchAll(PDO::FETCH_ASSOC);
       return $GetTreinamentosALLObject;
  
       }catch (PDOException $e) {
        return $e->getMessage();
      }
}



//FUNÇÃO DE DELETAR TREINAMENTO NO BANCO DE DADOS POR ID
Function setTreinamentoExcluir($T_idTreinamento){
    require "Conexao.php";
    // CRIANDO O SELECT PARA CONSULTAR EXISTENCIA DO NOME NO SISTEMA
    $setTreinamentoExcluirSQL = "DELETE FROM Treinamentos WHERE idTreinamento= ? ";
    $setTreinamentoExcluirStament = $pdo->prepare($setTreinamentoExcluirSQL); 
    // SUBSTITUINDO O VALOR ? DO SQL PELA VARIAVEL
    $setTreinamentoExcluirStament->bindValue(1, $T_idTreinamento, PDO::PARAM_INT);
    // EXECUTANDO O SQL UTILIAZANDO UM TRY
    try {
      //SQL EXECUTADA
      $setTreinamentoExcluirStament->execute(); 
      return true;

     }catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
    }
    
}


//FUNÇÃO DE BUSCAR TREINAMENTO NO BANCO DE DADOS POR EMPRESA_FORNECEDORA
Function GetTreinamentoByeEmpresa_Fornecedora($T_Empresa_Fornecedora){
    //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
    require "Conexao.php";
    // CRIANDO O SELECT PARA CONSULTAR EXISTENCIA DO NOME NO SISTEMA
    $GetTreinamentoByeEmpresa_FornecedoraSQL = "SELECT * FROM Treinamentos WHERE Empresa_Fornecedora LIKE ?";
    $GetTreinamentoByeEmpresa_FornecedoraStament = $pdo->prepare($GetTreinamentoByeEmpresa_FornecedoraSQL); 
    // SUBSTITUINDO O VALOR ? DO SQL PELA VARIAVEL
    $GetTreinamentoByeEmpresa_FornecedoraStament->bindValue(1,'%'. $T_Empresa_Fornecedora.'%', PDO::PARAM_STR);
    // EXECUTANDO O SQL UTILIZANDO UM TRY
    try {
      //SQL EXECUTADA
      $GetTreinamentoByeEmpresa_FornecedoraStament->execute(); 
      //TRANSFORMANDO SQL EXECUTADA EM UM OBJETO ARRAY
      $GetTreinamentoByeEmpresa_FornecedoraObject = $GetTreinamentoByeEmpresa_FornecedoraStament->fetchALL(PDO::FETCH_ASSOC);
     return $GetTreinamentoByeEmpresa_FornecedoraObject;

     }catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
    }
}