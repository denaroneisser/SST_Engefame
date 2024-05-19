<?php
//-----------------------------------------------------------------------
/*/{} Funcionarios.php
Funções de GET/SET para a Tabela Funcionários

@author Vinicius Neisser
@since 15/05/2024
@version 1.0

@Tabela  F_Nome      Nome do Funcionário.
        F_CPF       CPF do Funcionário.
        F_Situacao  Tipo de Entrada (0 = Demitido; 1 = Empregado).
        F_Categoria   Tipo de Entrada (0 = Empregado Engefame; 1 = Empregado Terceirizado; ...).
@Tabela
/*/
//-----------------------------------------------------------------------



//FUNÇÃO DE INCLUIR FUNCIONÁRIO NO BANCO DE DADOS
function setFuncionario($F_Nome,$F_CPF,$F_Situacao,$F_Categoria){
//INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADAOS
    require "Conexao.php";

//VERIFICAÇÃO DA EXISTENCIA DE UM FUNCIONÁRIO UTILIZANDO O PARAMENTRO CPF

    // CRIANDO O SELECT PARA CONSULTAR EXISTENCIA NÚMERICA(QUANTIDADE) DO CPF NO SISTEMA
    $SetFuncionarioSQL_Exists = "SELECT  COUNT(*) AS total FROM funcionarios WHERE CPF= ?";
    $SetFuncionarioStament = $pdo->prepare($SetFuncionarioSQL_Exists); 
    // SUBSTITUINDO O VALOR ? DO SQL PELA VARIAVEL
    $SetFuncionarioStament->bindParam(1, $F_CPF, PDO::PARAM_STR); 
    // EXECUTANDO O SQL UTILIAZANDO UM TRY
    try {
        //SQL EXECUTADA
        $SetFuncionarioStament->execute(); 
        //TRANSFORMANDO SQL EXECUTADA EM UM OBJETO ARRAY
        $SetFuncionarioObject = $SetFuncionarioStament->fetch(PDO::FETCH_ASSOC);
        //SE QUANTIDADE DE CPF NO SISTEMA FOR 0 = CADASTRAR FUNCIONARIO / 1= NAO CADASTRAR FUNCIONARIO
        if ($SetFuncionarioObject['total'] == 0) {
            // CRIANDO O INSERT PARA INCLUIR FUNCIONARIO
            $SetFuncionarioSQL_Insert = "INSERT INTO Funcionarios (Nome, CPF, Situacao, Categorias_idCategoria) VALUES (?, ?, ?, ?)";
            $SetFuncionarioStament_Insert = $pdo->prepare($SetFuncionarioSQL_Insert); 
            // SUBSTITUINDO O VALOR :F_Nome,F_CPF,F_Situacao,F_Categoria DO SQL PELA VARIAVEL
            $SetFuncionarioStament_Insert->bindParam(1, $F_Nome); 
            $SetFuncionarioStament_Insert->bindParam(2, $F_CPF,PDO::PARAM_STR); 
            $SetFuncionarioStament_Insert->bindParam(3, $F_Situacao,PDO::PARAM_INT); 
            $SetFuncionarioStament_Insert->bindParam(4, $F_Categoria,PDO::PARAM_INT);
            // EXECUTANDO O SQL
            try {
                $SetFuncionarioStament_Insert->execute(); 
                return true;
            }catch (PDOException $e) {
                
                echo "Erro PDO: " . $e->getMessage();
                return $e;
            }
        
        }else{

            return false;
        }

    }catch (PDOException $e) {
        echo "Erro PDO: " . $e->getMessage();
        return $e;
    }

}



//FUNÇÃO DE BUSCAR FUNCIONÁRIO NO BANCO DE DADOS POR NOME
function GetFuncionarioByNome($F_Nome){
    require "../objects/Conexao.php";
    // CRIANDO O SELECT PARA CONSULTAR EXISTENCIA DO NOME NO SISTEMA
    $GetFuncionarioSQL_Exists = "SELECT Nome,CPF,Situacao,Categorias_idCategoria FROM funcionarios WHERE funcionarios.Nome LIKE ?";
    $GetFuncionarioStament = $pdo->prepare($GetFuncionarioSQL_Exists); 
    // SUBSTITUINDO O VALOR ? DO SQL PELA VARIAVEL
    $GetFuncionarioStament->bindValue(1, '%' . $F_Nome . '%', PDO::PARAM_STR);
    // EXECUTANDO O SQL UTILIAZANDO UM TRY
    try {
        // SQL EXECUTADA
        $GetFuncionarioStament->execute(); 
        // TRANSFORMANDO SQL EXECUTADA EM UM OBJETO ARRAY
        $GetFuncionarioObject = $GetFuncionarioStament->fetchAll(PDO::FETCH_ASSOC);
        return $GetFuncionarioObject;

    } catch (PDOException $e) {
        echo "Erro PDO: " . $e->getMessage();
    }
}



//FUNÇÃO DE BUSCAR FUNCIONÁRIO NO BANCO DE DADOS POR NOME
Function GetFuncionarioByCPF($F_CPF){
    require "Conexao.php";
    // CRIANDO O SELECT PARA CONSULTAR EXISTENCIA DO NOME NO SISTEMA
    $GetFuncionarioSQL_Exists = "SELECT * FROM funcionarios WHERE cpf= ? ";
    $GetFuncionarioStament = $pdo->prepare($GetFuncionarioSQL_Exists); 
    // SUBSTITUINDO O VALOR ? DO SQL PELA VARIAVEL
    $GetFuncionarioStament->bindValue(1, $F_CPF, PDO::PARAM_STR);
    // EXECUTANDO O SQL UTILIAZANDO UM TRY
    try {
      //SQL EXECUTADA
      $GetFuncionarioStament->execute(); 
      //TRANSFORMANDO SQL EXECUTADA EM UM OBJETO ARRAY
      $GetFuncionarioObject = $GetFuncionarioStament->fetch(PDO :: FETCH_BOTH);
     return $GetFuncionarioObject;

     }catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
    }
    
}



//FUNÇÃO DE ALTERAR FUNCIONÁRIO NO BANCO DE DADOS
function setFuncionarioAlterar($F_Nome,$F_CPF,$F_Situacao,$F_Categoria){
    //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADAOS
        require "Conexao.php";
                // CRIANDO O INSERT PARA INCLUIR FUNCIONARIO
                $SetFuncionarioSQL_Insert = "UPDATE `funcionarios` SET Nome=?,Situacao=?,Categorias_idCategoria=? WHERE CPF= ?";
                $SetFuncionarioStament_Insert = $pdo->prepare($SetFuncionarioSQL_Insert); 
                // SUBSTITUINDO O VALOR :F_Nome,F_CPF,F_Situacao,F_Categoria DO SQL PELA VARIAVEL
                $SetFuncionarioStament_Insert->bindValue(1, $F_Nome,PDO::PARAM_STR); 
                $SetFuncionarioStament_Insert->bindValue(2, $F_Situacao,PDO::PARAM_INT); 
                $SetFuncionarioStament_Insert->bindValue(3, $F_Categoria,PDO::PARAM_INT);
                $SetFuncionarioStament_Insert->bindValue(4, $F_CPF,PDO::PARAM_STR); 
                // EXECUTANDO O SQL
                try {
                    $SetFuncionarioStament_Insert->execute(); 
                    return true;
    
                }catch (PDOException $e) {
                    
                    echo "Erro PDO: " . $e->getMessage();
                }    
    }



//FUNÇÃO DE BUSCAR FUNCIONÁRIO NO BANCO DE DADOS POR CATEGORIA
Function GetFuncionarioByCategorias_idCategoria($F_Categoria){
    require "Conexao.php";
    // CRIANDO O SELECT PARA CONSULTAR EXISTENCIA DO NOME NO SISTEMA
    $GetFuncionarioByCategorias_idCategoria_SQL = "SELECT * FROM funcionarios WHERE Categorias_idCategoria= ? ";
    $GetFuncionarioByCategorias_idCategoriaStament = $pdo->prepare($GetFuncionarioByCategorias_idCategoria_SQL); 
    // SUBSTITUINDO O VALOR ? DO SQL PELA VARIAVEL
    $GetFuncionarioByCategorias_idCategoriaStament->bindValue(1, $F_Categoria, PDO::PARAM_STR);
    // EXECUTANDO O SQL UTILIAZANDO UM TRY
    try {
      //SQL EXECUTADA
      $GetFuncionarioByCategorias_idCategoriaStament->execute(); 
      //TRANSFORMANDO SQL EXECUTADA EM UM OBJETO ARRAY
      $GetFuncionarioByCategorias_idCategoriaObject = $GetFuncionarioByCategorias_idCategoriaStament->fetchAll(PDO::FETCH_ASSOC);
     return $GetFuncionarioByCategorias_idCategoriaObject;

     }catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
    }
    
}



//FUNÇÃO DE BUSCAR TODAS OS FUNCIONÁRIOS
Function GetFuncionariosALL(){
    //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
    require "Conexao.php";
    // CRIANDO O SELECT
    $GetFuncionariosSQL = "SELECT * FROM Funcionarios";
    $GetFuncionariosStament = $pdo->query($GetFuncionariosSQL); 
    // EXECUTANDO O SQL UTILIZANDO UM TRY
    try {
        //SQL EXECUTADA
        $GetFuncionariosStament->execute(); 
        //TRANSFORMANDO SQL EXECUTADA EM UM OBJETO ARRAY
        $GetFuncionariosObject = $GetFuncionariosStament->fetchAll(PDO::FETCH_ASSOC);
       return $GetFuncionariosObject;
  
       }catch (PDOException $e) {
        return $e->getMessage();
      }
}



//FUNÇÃO DE DELETAR FUNCIONÁRIO NO BANCO DE DADOS POR CPF
Function setFuncionarioExcluir($F_CPF){
    require "Conexao.php";
    // CRIANDO O SELECT PARA CONSULTAR EXISTENCIA DO NOME NO SISTEMA
    $SetFuncionarioExcluirSQL = "DELETE FROM funcionarios WHERE cpf= ? ";
    $SetFuncionarioExcluirStament = $pdo->prepare($SetFuncionarioExcluirSQL); 
    // SUBSTITUINDO O VALOR ? DO SQL PELA VARIAVEL
    $SetFuncionarioExcluirStament->bindValue(1, $F_CPF, PDO::PARAM_STR);
    // EXECUTANDO O SQL UTILIAZANDO UM TRY
    try {
      //SQL EXECUTADA
      $SetFuncionarioExcluirStament->execute(); 
      return true;

     }catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
    }
    
}


//TESTEEEEEEEEEEEEEEE

function searchFuncionarios($query) {
    // Conecte-se ao banco de dados
    require "Conexao.php";
    // Proteja a consulta contra SQL injection
    $query = "%" . $pdo->real_escape_string($query) . "%";

    // Prepare a consulta SQL
    $sql = "SELECT CPF, Nome FROM Funcionarios WHERE Nome LIKE ? OR CPF LIKE ?";
    $stmt = $pdo->prepare($sql);
    $stmt->bind_param("ss", $query, $query);
    $stmt->execute();
    $result = $stmt->get_result();

    $funcionarios = [];
    while ($row = $result->fetch_assoc()) {
        $funcionarios[] = $row;
    }

    $stmt->close();
    $conn->close();

    return $funcionarios;
}
