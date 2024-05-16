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
    // CRIANDO O INSERT PARA INCLUIR CATEGORIA
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
function setAlterarHistoricoTreinamento($H_idHistorico_Treinamento,$H_Treinamentos_idTreinamento,$H_Funcionarios_CPF,$H_Instrutor,$H_Data_Realizacao,$H_Data_de_Validade,$H_Comprovacao,$H_Modalidade,$H_CargaHoraria,$H_Pago,$H_Valor_Por_Pessoa){
    //INCLUIR CÓDIGO DE CONEXÃO COM BANCO DE DADOS
        require "Conexao.php";
                // CRIANDO O INSERT PARA INCLUIR CATEGORIA
                $setAlterarHistoricoTreinamentoSQL = "UPDATE Historico_Treinamentos SET Treinamentos_idTreinamento= ?,Funcionarios_CPF= ?,Instrutor= ?,Data_Realizacao= ?,Data_Validade= ?,Comprovacao= ?,Modalidade= ?,CargaHoraria= ?,Pago= ?,Valor_Por_Pessoa ?) WHERE idHistorico_treinamento= ?";
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