<?php
require_once("../objects/Funcionarios.php");
if (isset($_GET['nome'])) {
$query = $_GET['nome'];
$funcionarios = GetFuncionarioByNome($query);
if ($funcionarios) {
    // Construa a lista de funcionários encontrados
    $output = "<div>";
    foreach ($funcionarios as $funcionario) {
        $output .= "{$funcionario['Nome']}/{$funcionario['CPF']}";
    }
    $output .= "</div>";

    // Retorne a lista de funcionários como resposta AJAX
    echo $output;
} else {
    echo "Nenhum funcionário encontrado com o nome '$nome'.";
}
} else {
    echo "O parâmetro 'nome' não foi enviado.";
}
