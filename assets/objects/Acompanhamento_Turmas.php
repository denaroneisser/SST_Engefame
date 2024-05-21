<?php
//-----------------------------------------------------------------------
/*/{} Acompanhamento_Turmas.php
Funções de GET/SET para a Tabela Acompanhamento_Turmas

@author Vinicius Neisser
@since 21/05/2024
@version 1.0

@Tabela     A_idAcompanhamento                            Auto Increment.
            A_Data_Inclusao                               Data do registro do acompanhamento.
            A_Data_Prazo                                  Data do prazo para exuceção(se ohuver).
            A_Descricao                                   Descrição da tarefa.
            A_Turmas_idTurma                              Turma Correspondente ao Acompanhamento(chave estrangeira).
            A_Turmas_Empresas_idEmpresa                   Empresa Correspondente ao Acompanhamento(chave estrangeira).
            A_Turmas_Treinamentos_idTreinamento           Treinamento Correspondente ao Acompanhamento(chave estrangeira).
@Tabela
/*/
//-----------------------------------------------------------------------



//FUNÇÃO DE INCLUIR ACOMPANHAMENTO DA TURMA NO BANCO DE DADOS 
function SetAcompanhamentoTurmas($A_Data_Inclusao, $A_Data_Prazo, $A_Descricao, $A_Turmas_idTurma, $A_Turmas_Empresas_idEmpresa, $A_Turmas_Treinamentos_idTreinamento){
  //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
  require "Conexao.php";
  // CRIANDO O INSERT PARA INCLUIR ACOMPANHAMENTO NA TURMA
  $setAcompanhamentoTurmasSQL = "INSERT INTO Acompanhamento_Turmas (Data_Inclusao, Data_Prazo, Descricao, Turmas_idTurma, Turmas_Empresas_idEmpresa, Turmas_Treinamentos_idTreinamento) VALUES (?, ?, ?, ?, ?, ?)";
  $setAcompanhamentoTurmasStatement = $pdo->prepare($setAcompanhamentoTurmasSQL); 
  // SUBSTITUINDO O VALOR ? DO SQL PELA VARIÁVEL
  $setAcompanhamentoTurmasStatement->bindParam(1, $A_Data_Inclusao);
  $setAcompanhamentoTurmasStatement->bindParam(2, $A_Data_Prazo);
  $setAcompanhamentoTurmasStatement->bindParam(3, $A_Descricao);
  $setAcompanhamentoTurmasStatement->bindParam(4, $A_Turmas_idTurma);
  $setAcompanhamentoTurmasStatement->bindParam(5, $A_Turmas_Empresas_idEmpresa);
  $setAcompanhamentoTurmasStatement->bindParam(6, $A_Turmas_Treinamentos_idTreinamento);
  // EXECUTANDO O SQL
  try {
      $setAcompanhamentoTurmasStatement->execute(); 
      return true;
  } catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
  }
}



/// FUNÇÃO DE ALTERAR ACOMPANHAMENTO DE TURMAS NO BANCO DE DADOS
function SetAcompanhamentoTurmasAlterar($A_Data_Inclusao, $A_Data_Prazo, $A_Descricao, $A_Turmas_idTurma, $A_Turmas_Empresas_idEmpresa, $A_Turmas_Treinamentos_idTreinamento,$A_idAcompanhamento) {
  // INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
  require "Conexao.php";
  
  // CRIANDO O UPDATE PARA ATUALIZAR UM ACOMPANHAMENTO DE TURMA JÁ EXISTENTE
  $setAcompanhamentoTurmasSQL = "UPDATE Acompanhamento_Turmas SET Data_Prazo=?, Descricao=?, Turmas_idTurma=?, Turmas_Empresas_idEmpresa=?, Turmas_Treinamentos_idTreinamento=? WHERE idAcompanhamento=?";
  $setAcompanhamentoTurmasStatement = $pdo->prepare($setAcompanhamentoTurmasSQL); 
  
  // SUBSTITUINDO O VALOR ? DO SQL PELA VARIÁVEL
  $setAcompanhamentoTurmasStatement->bindParam(1, $A_Data_Prazo);
  $setAcompanhamentoTurmasStatement->bindParam(2, $A_Descricao);
  $setAcompanhamentoTurmasStatement->bindParam(3, $A_Turmas_idTurma);
  $setAcompanhamentoTurmasStatement->bindParam(4, $A_Turmas_Empresas_idEmpresa);
  $setAcompanhamentoTurmasStatement->bindParam(5, $A_Turmas_Treinamentos_idTreinamento);
  $setAcompanhamentoTurmasStatement->bindParam(6, $A_Data_Inclusao);
  $setAcompanhamentoTurmasStatement->bindParam(6, $A_idAcompanhamento);
  
  // EXECUTANDO O SQL
  try {
      $setAcompanhamentoTurmasStatement->execute(); 
      return true;
  } catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
  }    
}



// FUNÇÃO DE BUSCAR ACOMPANHAMENTO DE TURMA NO BANCO DE DADOS POR TURMAS ID
function GetAcompanhamentoTurmasById($A_Turmas_idTurma){
  // INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
  require "Conexao.php";
  // CRIANDO O SELECT PARA CONSULTAR A EXISTÊNCIA DO ACOMPANHAMENTO DE TURMA COM O ID NO SISTEMA
  $getAcompanhamentoTurmasByIdSQL = "SELECT * FROM Acompanhamento_Turmas WHERE idTurma = ?";
  $getAcompanhamentoTurmasByIdStatement = $pdo->prepare($getAcompanhamentoTurmasByIdSQL); 
  // SUBSTITUINDO O VALOR ? DO SQL PELA VARIÁVEL
  $getAcompanhamentoTurmasByIdStatement->bindParam(1, $A_Turmas_idTurma);
  
  // EXECUTANDO O SQL
  try {
      // EXECUTANDO O SQL
      $getAcompanhamentoTurmasByIdStatement->execute(); 
      // OBTENDO O RESULTADO DA CONSULTA
      $acompanhamentoTurma = $getAcompanhamentoTurmasByIdStatement->fetch(PDO::FETCH_ASSOC);
      return $acompanhamentoTurma;
  } catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
  }
}



// FUNÇÃO DE BUSCAR TODOS OS ACOMPANHAMENTOS DE TURMA
function GetAcompanhamentoTurmasALL(){
  // INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
  require "Conexao.php";
  // CRIANDO O SELECT
  $GetAcompanhamentoTurmasALLSQL = "SELECT * FROM Acompanhamento_Turmas";
  $GetAcompanhamentoTurmasALLStatement = $pdo->query($GetAcompanhamentoTurmasALLSQL); 
  // EXECUTANDO O SQL UTILIZANDO UM TRY
  try {
      // SQL EXECUTADA
      $GetAcompanhamentoTurmasALLStatement->execute(); 
      // TRANSFORMANDO SQL EXECUTADA EM UM OBJETO ARRAY
      $acompanhamentoTurmas = $GetAcompanhamentoTurmasALLStatement->fetchAll(PDO::FETCH_ASSOC);
      return $acompanhamentoTurmas;
  } catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
  }
}

// FUNÇÃO DE DELETAR ACOMPANHAMENTO DE TURMA NO BANCO DE DADOS POR ID
function setAcompanhamentoTurmasExcluir($A_idTurma){
  require "Conexao.php";
  // CRIANDO O DELETE PARA DELETAR ACOMPANHAMENTO DE TURMA NO SISTEMA
  $setAcompanhamentoTurmasExcluirSQL = "DELETE FROM Acompanhamento_Turmas WHERE idTurma = ? ";
  $setAcompanhamentoTurmasExcluirStatement = $pdo->prepare($setAcompanhamentoTurmasExcluirSQL); 
  // SUBSTITUINDO O VALOR ? DO SQL PELA VARIÁVEL
  $setAcompanhamentoTurmasExcluirStatement->bindValue(1, $A_idTurma, PDO::PARAM_INT);
  // EXECUTANDO O SQL UTILIZANDO UM TRY
  try {
      // SQL EXECUTADA
      $setAcompanhamentoTurmasExcluirStatement->execute(); 
      return true;
  } catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
  }
}
