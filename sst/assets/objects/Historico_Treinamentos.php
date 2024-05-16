<?php
//-----------------------------------------------------------------------
/*/{} Funcionarios.php
Funções de GET/SET para a Tabela Historico_Treinamentos

@author Vinicius Neisser
@since 16/05/2024
@version 1.0

@Tabela     H_idHistorico__Treinamentos          Auto Increment.
            H_Treinamentos_idTreinamento         ID do Treinamento(Chave Estrangeira).
            H_Funcionarios_CPF                   CPF do Funcionário.
            H_Instrutor                          Nome do Instrutor que deu o Treinamento.
            H_Data_Realizacao                    Data que foi criada a Turma do Treinamento.
            H_Data_de_Validade                   Data que vai Vencer os Certificados deste Treinamento.
            H_Comprovacao                        Tipo de Entrada (0 = Não Precisa Comprovar Presença; 1 = Precisa Comprovar Presença).
            H_Modalidade                         Tipo de Entrada (1 = Precencial; 0 = Online).
            H_CargaHoraria                       Horas de duração do Treinamento.
            H_Pago                               Tipo de Entrada (1 = Se o Treinamento é Pago; 0 = Se o Treinamento não é Pago).
            H_Valor_Por_Pessoa                   Informar o valor do treinamento por pessoa.
@Tabela
/*/
//-----------------------------------------------------------------------



//FUNÇÃO DE INCLUIR HISTORICO_TREINAMENTO NO BANCO DE DADOS
function setHistoricoTreinamento($H_Treinamentos_idTreinamento,$H_Funcionarios_CPF,$H_Instrutor,$H_Data_Realizacao,$H_Data_de_Validade,$H_Comprovacao,$H_Modalidade,$H_CargaHoraria,$H_Pago,$H_Valor_Por_Pessoa){
//INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
    require "Conexao.php";
    // CRIANDO O INSERT PARA INCLUIR HISTORICO TREINAMENTO
    $setHistoricoTreinamentoSQL = "INSERT INTO Historico_Treinamentos (Treinamentos_idTreinamento,Funcionarios_CPF,Instrutor,Data_Realizacao,Data_Validade,Comprovacao,Modalidade,CargaHoraria,Pago,Valor_Por_Pessoa) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
    $setHistoricoTreinamentoStament = $pdo->prepare($setHistoricoTreinamentoSQL); 
     // SUBSTITUINDO O VALOR ? DO SQL PELA VARIAVEL
     $setHistoricoTreinamentoStament->bindParam(1, $H_Treinamentos_idTreinamento);
     $setHistoricoTreinamentoStament->bindParam(2, $H_Funcionarios_CPF);
     $setHistoricoTreinamentoStament->bindParam(3, $H_Instrutor);
     $setHistoricoTreinamentoStament->bindParam(4, $H_Data_Realizacao);
     $setHistoricoTreinamentoStament->bindParam(5, $H_Data_de_Validade);
     $setHistoricoTreinamentoStament->bindParam(6, $H_Comprovacao);
     $setHistoricoTreinamentoStament->bindParam(7, $H_Modalidade);
     $setHistoricoTreinamentoStament->bindParam(8, $H_CargaHoraria);
     $setHistoricoTreinamentoStament->bindParam(9, $H_Pago);
     $setHistoricoTreinamentoStament->bindParam(10, $H_Valor_Por_Pessoa);
    // EXECUTANDO O SQL
        try {
            $setHistoricoTreinamentoStament->execute(); 
            return true;

            }catch (PDOException $e) {
                
                echo "Erro PDO: " . $e->getMessage();
            }

}



//FUNÇÃO DE ALTERAR TREINAMENTO NO BANCO DE DADOS
function setHistoricoTreinamentoAlterar($H_idHistorico_Treinamento,$H_Treinamentos_idTreinamento,$H_Funcionarios_CPF,$H_Instrutor,$H_Data_Realizacao,$H_Data_de_Validade,$H_Comprovacao,$H_Modalidade,$H_CargaHoraria,$H_Pago,$H_Valor_Por_Pessoa){
    //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
        require "Conexao.php";
                // CRIANDO O UPDATE PARA ATUALIZAR UMA TURMA JA EXISTENTE
                $setAlterarHistoricoTreinamentoSQL = "UPDATE Historico_Treinamentos SET Treinamentos_idTreinamento= ?,Funcionarios_CPF= ?,Instrutor= ?,Data_Realizacao= ?,Data_Validade= ?,Comprovacao= ?,Modalidade= ?,CargaHoraria= ?,Pago= ?,Valor_Por_Pessoa ?) WHERE idHistorico_Treinamento= ?";
                $setAlterarHistoricoTreinamentoStament = $pdo->prepare($setAlterarHistoricoTreinamentoSQL); 
                // SUBSTITUINDO O VALOR ? DO SQL PELA VARIAVEL
                $setAlterarHistoricoTreinamentoStament->bindParam(1, $H_Treinamentos_idTreinamento);
                $setAlterarHistoricoTreinamentoStament->bindParam(2, $H_Funcionarios_CPF);
                $setAlterarHistoricoTreinamentoStament->bindParam(3, $H_Instrutor);
                $setAlterarHistoricoTreinamentoStament->bindParam(4, $H_Data_Realizacao);
                $setAlterarHistoricoTreinamentoStament->bindParam(5, $H_Data_de_Validade);
                $setAlterarHistoricoTreinamentoStament->bindParam(6, $H_Comprovacao);
                $setAlterarHistoricoTreinamentoStament->bindParam(7, $H_Modalidade);
                $setAlterarHistoricoTreinamentoStament->bindParam(8, $H_CargaHoraria);
                $setAlterarHistoricoTreinamentoStament->bindParam(9, $H_Pago);
                $setAlterarHistoricoTreinamentoStament->bindParam(10, $H_Valor_Por_Pessoa);
                $setAlterarHistoricoTreinamentoStament->bindParam(11, $H_idHistorico_Treinamento);
                // EXECUTANDO O SQL
                try {
                    $setAlterarHistoricoTreinamentoStament->execute(); 
                    return true;
    
                }catch (PDOException $e) {
                    
                    echo "Erro PDO: " . $e->getMessage();
                }    
    }



//FUNÇÃO DE BUSCAR TREIMANETO NO BANCO DE DADOS POR ID
Function GetHistoricoTreinamentoById($H_idHistorico_Treinamento){
    //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
    require "Conexao.php";
    // CRIANDO O SELECT PARA CONSULTAR EXISTENCIA DA TURMA COM O ID NO SISTEMA
    $GetHistoricoTreinamentoByIdSQL_Exists = "SELECT * FROM Historico_Treinamentos WHERE  idHistorico_Treinamento= ?";
    $GetHistoricoTreinamentoByIdStament = $pdo->prepare($GetHistoricoTreinamentoByIdSQL_Exists); 
    // SUBSTITUINDO O VALOR ? DO SQL PELA VARIAVEL
    $GetHistoricoTreinamentoByIdStament->bindValue(1,$H_idHistorico_Treinamento);
    // EXECUTANDO O SQL UTILIAZANDO UM TRY
    try {
      //SQL EXECUTADA
      $GetHistoricoTreinamentoByIdStament->execute(); 
      //TRANSFORMANDO SQL EXECUTADA EM UM OBJETO ARRAY
      $GetHistoricoTreinamentoByIdObject = $GetHistoricoTreinamentoByIdStament->fetch(PDO::FETCH_ASSOC);
     return $GetHistoricoTreinamentoByIdObject;

     }catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
    }
}



//FUNÇÃO DE BUSCAR TREINAMENTO NO BANCO DE DADOS POR CPF
Function GetHistoricoTreinamentoByFuncionarios_CPF($H_Funcionarios_CPF){
    //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
    require "Conexao.php";
    // CRIANDO O SELECT PARA CONSULTAR EXISTENCIA DE FUNCIONARIO EM TURMA NO SISTEMA
    $GetHistoricoTreinamentoByFuncionarios_CPFSQL = "SELECT * FROM Historico_Treinamentos WHERE  Funcionario_CPF= ?";
    $GetHistoricoTreinamentoByFuncionarios_CPFStament = $pdo->prepare($GetHistoricoTreinamentoByFuncionarios_CPFSQL); 
    // SUBSTITUINDO O VALOR ? DO SQL PELA VARIAVEL
    $GetHistoricoTreinamentoByFuncionarios_CPFStament->bindValue(1,$H_Funcionarios_CPF);
    // EXECUTANDO O SQL UTILIAZANDO UM TRY
    try {
      //SQL EXECUTADA
      $GetHistoricoTreinamentoByFuncionarios_CPFStament->execute(); 
      //TRANSFORMANDO SQL EXECUTADA EM UM OBJETO ARRAY
      $GetHistoricoTreinamentoByFuncionarios_CPFObject = $GetHistoricoTreinamentoByFuncionarios_CPFStament->fetch(PDO::PARAM_STR);
     return $GetHistoricoTreinamentoByFuncionarios_CPFObject;

     }catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
    }
}



//FUNÇÃO DE BUSCAR TREINAMENTO NO BANCO DE DADOS POR ID DA TABELA TREINAMENTOS
Function GetHistoricoTreinamentoByTreinamentos_idTreinamento($H_Treinamentos_idTreinamento){
    //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
    require "Conexao.php";
    // CRIANDO O SELECT PARA CONSULTAR EXISTENCIA DE TURMA COM UM TREINAMENTO ESPECIFICO
    $GetHistoricoTreinamentoByTreinamentos_idTreinamentoSQL = "SELECT * FROM Historico_Treinamentos WHERE Treinamentos_idTreinamento= ?";
    $GetHistoricoTreinamentoByTreinamentos_idTreinamentoStament = $pdo->prepare($GetHistoricoTreinamentoByTreinamentos_idTreinamentoSQL); 
    // SUBSTITUINDO O VALOR ? DO SQL PELA VARIAVEL
    $GetHistoricoTreinamentoByTreinamentos_idTreinamentoStament->bindValue(1,$H_Treinamentos_idTreinamento, PDO::PARAM_INT);
    // EXECUTANDO O SQL UTILIZANDO UM TRY
    try {
      //SQL EXECUTADA
      $GetHistoricoTreinamentoByTreinamentos_idTreinamentoStament->execute(); 
      //TRANSFORMANDO SQL EXECUTADA EM UM OBJETO ARRAY
      $GetHistoricoTreinamentoByTreinamentos_idTreinamentoObject = $GetTreGetHistoricoTreinamentoByTreinamentos_idTreinamentoStamentinamentoStament->fetchALL(PDO::FETCH_ASSOC);
     return $GetHistoricoTreinamentoByTreinamentos_idTreinamentoObject;

     }catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
    }
}



//FUNÇÃO DE BUSCAR TODAS OS TREINAMENTOS
Function GetHistoricoTreinamentosALL(){
    //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
    require "Conexao.php";
    // CRIANDO O SELECT
    $GetHistoricoTreinamentosALLSQL = "SELECT * FROM Treinamentos";
    $GetHistoricoTreinamentosALLStament = $pdo->query($GetHistoricoTreinamentosALLSQL); 
    // EXECUTANDO O SQL UTILIZANDO UM TRY
    try {
        //SQL EXECUTADA
        $GetHistoricoTreinamentosALLStament->execute(); 
        //TRANSFORMANDO SQL EXECUTADA EM UM OBJETO ARRAY
        $GetHistoricoTreinamentosALLObject = $GetHistoricoTreinamentosALLStament->fetchAll(PDO::FETCH_ASSOC);
       return $GetHistoricoTreinamentosALLObject;
  
       }catch (PDOException $e) {
        return $e->getMessage();
      }
}



//FUNÇÃO DE DELETAR HISTORICO DE TREINAMENTO NO BANCO DE DADOS POR ID
Function setHistoricoTreinamentoExcluir($H_idHistorico_Treinamento){
    require "Conexao.php";
    // CRIANDO O DELETE PARA DELETAR TURMA NO SISTEMA
    $setHistoricoTreinamentoExcluirSQL = "DELETE FROM Historico_Treinamentos WHERE idHistorico_Treinamentos= ? ";
    $setHistoricoTreinamentoExcluirStament = $pdo->prepare($setHistoricoTreinamentoExcluirSQL); 
    // SUBSTITUINDO O VALOR ? DO SQL PELA VARIAVEL
    $setHistoricoTreinamentoExcluirStament->bindValue(1, $H_idHistorico_Treinamento, PDO::PARAM_INT);
    // EXECUTANDO O SQL UTILIAZANDO UM TRY
    try {
      //SQL EXECUTADA
      $setHistoricoTreinamentoExcluirStament->execute(); 
      return true;

     }catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
    }
    
}



//FUNÇÃO DE BUSCAR HISTORICO DE TREINAMENTOS NO BANCO DE DADOS POR INSTRUTOR
Function GetHistoricoTreinamentoByeInstrutor($H_Instrutor){
    //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
    require "Conexao.php";
    // CRIANDO O SELECT PARA CONSULTAR EXISTENCIA DO INSTRUTOR NO SISTEMA
    $GetHistoricoTreinamentoByeInstrutorSQL = "SELECT * FROM Historico_Treinamentos WHERE Instrutor LIKE ?";
    $GetHistoricoTreinamentoByeInstrutorStament = $pdo->prepare($GetHistoricoTreinamentoByeInstrutorSQL); 
    // SUBSTITUINDO O VALOR ? DO SQL PELA VARIAVEL
    $GetHistoricoTreinamentoByeInstrutorStament->bindValue(1,'%'. $H_Instrutor.'%', PDO::PARAM_STR);
    // EXECUTANDO O SQL UTILIZANDO UM TRY
    try {
      //SQL EXECUTADA
      $GetHistoricoTreinamentoByeInstrutorStament->execute(); 
      //TRANSFORMANDO SQL EXECUTADA EM UM OBJETO ARRAY
      $GetHistoricoTreinamentoByeInstrutorObject = $GetHistoricoTreinamentoByeInstrutorStament->fetchALL(PDO::FETCH_ASSOC);
     return $GetHistoricoTreinamentoByeInstrutorObject;

     }catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
    }
}



//FUNÇÃO DE BUSCAR TREINAMENTO NO BANCO DE DADOS POR PAGO
Function GetHistoricoTreinamentoByPago($H_Pago){
    //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
    require "Conexao.php";
    // CRIANDO O SELECT PARA CONSULTAR EXISTENCIA DA TURMA COM CURSO PAGO
    $GetHistoricoTreinamentoByPagoSQL_Exists = "SELECT * FROM Historico_Treinamentos WHERE Pago= ? ";
    $GetHistoricoTreinamentoByPagoStament = $pdo->prepare($GetHistoricoTreinamentoByPagoSQL_Exists); 
    // SUBSTITUINDO O VALOR ? DO SQL PELA VARIAVEL
    $GetHistoricoTreinamentoByPagoStament->bindValue(1,$H_Pago, PDO::PARAM_INT);
    // EXECUTANDO O SQL UTILIAZANDO UM TRY
    try {
      //SQL EXECUTADA
      $GetHistoricoTreinamentoByPagoStament->execute(); 
      //TRANSFORMANDO SQL EXECUTADA EM UM OBJETO ARRAY
      $GetHistoricoTreinamentoByPagoObject = $GetHistoricoTreinamentoByPagoStament->fetchALL(PDO::FETCH_ASSOC);
     return $GetHistoricoTreinamentoByPagoObject;

     }catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
    }
}



//FUNÇÃO DE BUSCAR TREINAMENTO NO BANCO DE DADOS POR DATA_VALIDADE
function GetHistoricoTreinamentosByData_Validade($H_Data_de_Validade){
    //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
    require "Conexao.php";
    // CRIANDO O SELECT PARA CONSULTAR EXISTENCIA DA TURMA COM CURSO DATA_VALIDADE
    $GetHistoricoTreinamentosByData_ValidadeSQL_Exists = "SELECT * FROM Historico_Treinamentos WHERE Data_Validade= ? ";
    $GetHistoricoTreinamentosByData_ValidadeStament = $pdo->prepare($GetHistoricoTreinamentosByData_ValidadeSQL_Exists); 
    // SUBSTITUINDO O VALOR ? DO SQL PELA VARIAVEL
    $GetHistoricoTreinamentosByData_ValidadeStament->bindValue(1,$H_Data_de_Validade, PDO::PARAM_DATE);
    // EXECUTANDO O SQL UTILIAZANDO UM TRY
    try {
      //SQL EXECUTADA
      $GetHistoricoTreinamentosByData_ValidadeStament->execute(); 
      //TRANSFORMANDO SQL EXECUTADA EM UM OBJETO ARRAY
      $GetHistoricoTreinamentosByData_ValidadeObject = $GetHistoricoTreinamentosByData_ValidadeStament->fetchALL(PDO::FETCH_ASSOC);
     return $GetHistoricoTreinamentosByData_ValidadeObject;

     }catch (PDOException $e) {
      echo "Erro PDO: " . $e->getMessage();
    }


}