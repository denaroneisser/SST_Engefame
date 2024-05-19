<?php
require_once("../objects/Funcionarios.php");

if (isset($_GET['nome'])) {
    $nome = $_GET['nome'];
    $funcionarios = GetFuncionarioByNome($nome);
    if ($funcionarios) {
        // Construa a lista de funcionários encontrados
        foreach ($funcionarios as $funcionario) {
            $output = "<div class='funcionario-list' onclick='adicionarInformacao(\"{$funcionario['CPF']}\", \"{$funcionario['Nome']}\")'>";
            $output .= "{$funcionario['Nome']} - {$funcionario['CPF']}";
            $output .= "</div>";
            echo $output;
        }
    } else {
        echo "Nenhum funcionário encontrado com o nome '$nome'.";
    }
} else {
    echo "O parâmetro 'nome' não foi enviado.";
}
?>
