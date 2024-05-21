<?php
//-----------------------------------------------------------------------
/*/{} Turmas.php
Funções de GET/SET para a Tabela Turmas

@author Vinicius Neisser
@since 21/05/2024
@version 1.0

@Tabela     T_idTurma                            Auto Increment.
            T_Empresas_IdEmpresa                 ID da Empresa(Chave Estrangeira).
            T_Treinamentos_IdTreinamento         ID do Treinamento(Chave Estrangeira).
            T_Instrutor                          Nome do Instrutor que deu o Treinamento.
            T_Data_Realizacao                    Data que foi criada a Turma do Treinamento.
            T_Data_Validade                      Data que vai Vencer os Certificados deste Treinamento.
            T_Comprovacao                        Tipo de Entrada (0 = Não Precisa Comprovar Presença; 1 = Precisa Comprovar Presença).
            T_Modalidade                         Tipo de Entrada (1 = Precencial; 0 = Online).
            T_Carga_Horaria                      Horas de duração do Treinamento.
            T_Preco_Unitario                     Informar o valor do treinamento por pessoa.
            T_Curso_Pago                         Tipo de Entrada (1 = SIM; 0 = NAO).
@Tabela
/*/
//-----------------------------------------------------------------------



//FUNÇÃO DE INCLUIR TURMA NO BANCO DE DADOS 
function setTurmas($T_Empresas_IdEmpresa,$T_Treinamentos_idTreinamento,$T_Instrutor,$T_Data_Realizacao,$T_Data_Validade,$T_Comprovacao,$T_Modalidade,$T_Carga_Horaria,$T_Preco_Unitario,$T_Curso_Pago){
//INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
    require "Conexao.php";
    // CRIANDO O INSERT PARA INCLUIR TURMA
    $setTurmasSQL = "INSERT INTO Turmas (Empresas_idEmpresa,Treinamentos_idTreinamento,Instrutor,Data_Realizacao,Data_Validade,Comprovacao,Modalidade,Carga_Horaria,Preco_Unitario,Curso_Pago) VALUES (?,?,?,?,?,?,?,?,?,?)";
    $setTurmasStament = $pdo->prepare($setTurmasSQL); 
     // SUBSTITUINDO O VALOR ? DO SQL PELA VARIAVEL
     $setTurmasStament->bindParam(1, $T_Empresas_IdEmpresa);
     $setTurmasStament->bindParam(2,$T_Treinamentos_idTreinamento);
     $setTurmasStament->bindParam(3, $T_Instrutor);
     $setTurmasStament->bindParam(4, $T_Data_Realizacao);
     $setTurmasStament->bindParam(5, $T_Data_Validade);
     $setTurmasStament->bindParam(6, $T_Comprovacao);
     $setTurmasStament->bindParam(7, $T_Modalidade);
     $setTurmasStament->bindParam(8, $T_Carga_Horaria);
     $setTurmasStament->bindParam(9, $T_Preco_Unitario);
     $setTurmasStament->bindParam(10, $T_Curso_Pago);
    // EXECUTANDO O SQL
        try {
            $setTurmasStament->execute(); 
            return true;

            }catch (PDOException $e) {
                
                echo "Erro PDO: " . $e->getMessage();
            }

}



//FUNÇÃO DE ALTERAR TURMA NO BANCO DE DADOS
function setTurmasAlterar($T_Empresas_IdEmpresa, $T_Treinamentos_idTreinamento, $T_Instrutor, $T_Data_Realizacao, $T_Data_Validade, $T_Comprovacao, $T_Modalidade, $T_Carga_Horaria, $T_Preco_Unitario, $T_Curso_Pago, $T_idTurma){
  //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
  require "Conexao.php";
  
  // CRIANDO O UPDATE PARA ATUALIZAR UMA TURMA JÁ EXISTENTE
  $setAlterarTurmaSQL = "UPDATE Turmas SET Treinamentos_idTreinamento=?, Instrutor=?, Data_Realizacao=?, Data_Validade=?, Comprovacao=?, Modalidade=?, Carga_Horaria=?, Preco_Unitario=?, Curso_Pago=? WHERE idTurma=?";
  $setAlterarTurmaStatement = $pdo->prepare($setAlterarTurmaSQL); 
  // SUBSTITUINDO O VALOR ? DO SQL PELA VARIÁVEL
  $setAlterarTurmaStatement->bindParam(1, $T_Treinamentos_idTreinamento);
  $setAlterarTurmaStatement->bindParam(2, $T_Instrutor);
  $setAlterarTurmaStatement->bindParam(3, $T_Data_Realizacao);
  $setAlterarTurmaStatement->bindParam(4, $T_Data_Validade);
  $setAlterarTurmaStatement->bindParam(5, $T_Comprovacao);
  $setAlterarTurmaStatement->bindParam(6, $T_Modalidade);
  $setAlterarTurmaStatement->bindParam(7, $T_Carga_Horaria);
  $setAlterarTurmaStatement->bindParam(8, $T_Preco_Unitario);
  $setAlterarTurmaStatement->bindParam(9, $T_Curso_Pago);
  $setAlterarTurmaStatement->bindParam(10, $T_idTurma);

  // EXECUTANDO O SQL
  try {
      $setAlterarTurmaStatement->execute(); 
      return true;
  } catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
  }    
}



//FUNÇÃO DE BUSCAR TURMA NO BANCO DE DADOS POR ID
function getTurmasById($T_idTurma){
  //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
  require "Conexao.php";
  // CRIANDO O SELECT PARA CONSULTAR A EXISTÊNCIA DA TURMA COM O ID NO SISTEMA
  $getTurmaByIdSQL = "SELECT * FROM Turmas WHERE idTurma = ?";
  $getTurmaByIdStatement = $pdo->prepare($getTurmaByIdSQL); 
  // SUBSTITUINDO O VALOR ? DO SQL PELA VARIÁVEL
  $getTurmaByIdStatement->bindParam(1, $T_idTurma);
  
  // EXECUTANDO O SQL
  try {
      // EXECUTANDO O SQL
      $getTurmaByIdStatement->execute(); 
      // OBTENDO O RESULTADO DA CONSULTA
      $turma = $getTurmaByIdStatement->fetch(PDO::FETCH_ASSOC);
      return $turma;
  } catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
  }
}



//FUNÇÃO DE BUSCAR TURMAS NO BANCO DE DADOS POR ID DA EMPRESA
function getTurmasByEmpresasId($T_Empresas_idEmpresa){
  //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
  require "Conexao.php";
  // CRIANDO O SELECT PARA CONSULTAR A EXISTÊNCIA DE TURMAS COM O ID DA EMPRESA NO SISTEMA
  $getTurmasByEmpresasIdSQL = "SELECT * FROM Turmas WHERE Empresas_idEmpresa = ?";
  $getTurmasByEmpresasIdStatement = $pdo->prepare($getTurmasByEmpresasIdSQL); 
  // SUBSTITUINDO O VALOR ? DO SQL PELA VARIÁVEL
  $getTurmasByEmpresasIdStatement->bindParam(1, $T_Empresas_idEmpresa);
  
  // EXECUTANDO O SQL
  try {
      // EXECUTANDO O SQL
      $getTurmasByEmpresasIdStatement->execute(); 
      // OBTENDO O RESULTADO DA CONSULTA
      $turmas = $getTurmasByEmpresasIdStatement->fetchAll(PDO::FETCH_ASSOC);
      return $turmas;
  } catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
  }
}


// FUNÇÃO DE BUSCAR TURMAS NO BANCO DE DADOS POR ID DA TABELA TREINAMENTOS
function getTurmasByTreinamentosId($T_Treinamentos_idTreinamento){
  // INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
  require "Conexao.php";
  
  // CRIANDO O SELECT PARA CONSULTAR EXISTÊNCIA DE TURMA COM UM TREINAMENTO ESPECÍFICO
  $getTurmasByTreinamentosIdSQL = "SELECT * FROM Turmas WHERE Treinamentos_idTreinamento = ?";
  $getTurmasByTreinamentosIdStatement = $pdo->prepare($getTurmasByTreinamentosIdSQL); 
  
  // SUBSTITUINDO O VALOR ? DO SQL PELA VARIÁVEL
  $getTurmasByTreinamentosIdStatement->bindValue(1, $T_Treinamentos_idTreinamento, PDO::PARAM_INT);
  
  // EXECUTANDO O SQL UTILIZANDO UM TRY
  try {
      // SQL EXECUTADA
      $getTurmasByTreinamentosIdStatement->execute(); 
      
      // TRANSFORMANDO SQL EXECUTADA EM UM OBJETO ARRAY
      $turmas = $getTurmasByTreinamentosIdStatement->fetchAll(PDO::FETCH_ASSOC);
      return $turmas;
  } catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
  }
}



//FUNÇÃO DE BUSCAR TREINAMENTO NO BANCO DE DADOS POR DATA DA CRIAÇÃO DA TURMA
function GetTurmasByData_Realizacao($T_Data_Realizacao){
  //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
  require "Conexao.php";
  // CRIANDO O SELECT PARA CONSULTAR EXISTÊNCIA DE TURMA COM UMA DATA DE CRIAÇÃO ESPECÍFICA
  $GetTurmasByData_RealizacaoSQL = "SELECT * FROM Turmas WHERE Data_Realizacao = ?";
  $GetTurmasByData_RealizacaoStament = $pdo->prepare($GetTurmasByData_RealizacaoSQL); 
  // SUBSTITUINDO O VALOR ? DO SQL PELA VARIÁVEL
  $GetTurmasByData_RealizacaoStament->bindValue(1, $T_Data_Realizacao);
  // EXECUTANDO O SQL UTILIZANDO UM TRY
  try {
    //SQL EXECUTADA
    $GetTurmasByData_RealizacaoStament->execute(); 
    //TRANSFORMANDO SQL EXECUTADA EM UM OBJETO ARRAY
    $turmas = $GetTurmasByData_RealizacaoStament->fetchAll(PDO::FETCH_ASSOC);
   return $turmas;

   }catch (PDOException $e) {
    echo "Erro PDO: " . $e->getMessage();
  }
}




//FUNÇÃO DE BUSCAR TREINAMENTO NO BANCO DE DADOS POR DATA DA CRIAÇÃO DA TURMA
function GetTurmasByData_Validade($T_Data_Validade){
  //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
  require "Conexao.php";
  // CRIANDO O SELECT PARA CONSULTAR EXISTÊNCIA DE TURMA COM UMA DATA DE CRIAÇÃO ESPECÍFICA
  $GetTurmasByData_ValidadeSQL = "SELECT * FROM Turmas WHERE Data_Validade = ?";
  $GetTurmasByData_ValidadeStament = $pdo->prepare($GetTurmasByData_ValidadeSQL); 
  // SUBSTITUINDO O VALOR ? DO SQL PELA VARIÁVEL
  $GetTurmasByData_ValidadeStament->bindValue(1, $T_Data_Validade);
  // EXECUTANDO O SQL UTILIZANDO UM TRY
  try {
    //SQL EXECUTADA
    $GetTurmasByData_ValidadeStament->execute(); 
    //TRANSFORMANDO SQL EXECUTADA EM UM OBJETO ARRAY
    $turmas = $GetTurmasByData_ValidadeStament->fetchAll(PDO::FETCH_ASSOC);
   return $turmas;

   }catch (PDOException $e) {
    echo "Erro PDO: " . $e->getMessage();
  }
}



//FUNÇÃO DE BUSCAR TODAS AS TURMAS
Function GetTurmasALL(){
    //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
    require "Conexao.php";
    // CRIANDO O SELECT
    $GetTurmasALLSQL = "SELECT * FROM Treinamentos";
    $GetTurmasALLStament = $pdo->query($GetTurmasALLSQL); 
    // EXECUTANDO O SQL UTILIZANDO UM TRY
    try {
        //SQL EXECUTADA
        $GetTurmasALLStament->execute(); 
        //TRANSFORMANDO SQL EXECUTADA EM UM OBJETO ARRAY
        $turmas = $GetTurmasALLStament->fetchAll(PDO::FETCH_ASSOC);
       return $turmas;
  
       }catch (PDOException $e) {
        return $e->getMessage();
      }
}



// FUNÇÃO DE BUSCAR TURMAS NO BANCO DE DADOS POR INSTRUTOR
function GetTurmasByInstrutor($T_Instrutor){
  // INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
  require "Conexao.php";
  // CRIANDO O SELECT PARA CONSULTAR EXISTÊNCIA DO INSTRUTOR NO SISTEMA
  $GetTurmasByInstrutorSQL = "SELECT * FROM turmas WHERE Instrutor LIKE ?";
  $GetTurmasByInstrutorStatement = $pdo->prepare($GetTurmasByInstrutorSQL); 
  // SUBSTITUINDO O VALOR ? DO SQL PELA VARIÁVEL
  $GetTurmasByInstrutorStatement->bindValue(1, '%' . $T_Instrutor . '%', PDO::PARAM_STR);
  // EXECUTANDO O SQL UTILIZANDO UM TRY
  try {
      // SQL EXECUTADA
      $GetTurmasByInstrutorStatement->execute(); 
      // TRANSFORMANDO SQL EXECUTADA EM UM OBJETO ARRAY
      $GetTurmasByInstrutorObject = $GetTurmasByInstrutorStatement->fetchAll(PDO::FETCH_ASSOC);
      return $GetTurmasByInstrutorObject;

  } catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
  }
}

// FUNÇÃO DE BUSCAR TURMAS NO BANCO DE DADOS POR PAGO
function GetTurmasByPago($T_Curso_Pago){
  // INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
  require "Conexao.php";
  // CRIANDO O SELECT PARA CONSULTAR EXISTÊNCIA DA TURMA COM CURSO PAGO
  $GetTurmasByPagoSQL_Exists = "SELECT * FROM turmas WHERE Pago = ? ";
  $GetTurmasByPagoStatement = $pdo->prepare($GetTurmasByPagoSQL_Exists); 
  // SUBSTITUINDO O VALOR ? DO SQL PELA VARIÁVEL
  $GetTurmasByPagoStatement->bindValue(1, $T_Curso_Pago, PDO::PARAM_INT);
  // EXECUTANDO O SQL UTILIZANDO UM TRY
  try {
      // SQL EXECUTADA
      $GetTurmasByPagoStatement->execute(); 
      // TRANSFORMANDO SQL EXECUTADA EM UM OBJETO ARRAY
      $GetTurmasByPagoObject = $GetTurmasByPagoStatement->fetchAll(PDO::FETCH_ASSOC);
      return $GetTurmasByPagoObject;

  } catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
  }
}

// FUNÇÃO DE DELETAR TURMA NO BANCO DE DADOS POR ID
function setTurmasExcluir($T_idTurma){
  require "Conexao.php";
  // CRIANDO O DELETE PARA DELETAR TURMA NO SISTEMA
  $setTurmaExcluirSQL = "DELETE FROM turmas WHERE idTurma = ? ";
  $setTurmaExcluirStatement = $pdo->prepare($setTurmaExcluirSQL); 
  // SUBSTITUINDO O VALOR ? DO SQL PELA VARIÁVEL
  $setTurmaExcluirStatement->bindValue(1, $T_idTurma, PDO::PARAM_INT);
  // EXECUTANDO O SQL UTILIZANDO UM TRY
  try {
      // SQL EXECUTADA
      $setTurmaExcluirStatement->execute(); 
      return true;

  } catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
  }
}
