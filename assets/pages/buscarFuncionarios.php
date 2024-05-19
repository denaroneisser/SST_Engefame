<?php
require_once("../objects/Funcionarios.php");

$query = $_GET['query'] ?? '';

if ($query) {
    $funcionarios = searchFuncionarios($query); // Suponha que essa função busca funcionários pelo nome ou CPF
    echo json_encode($funcionarios);
} else {
    echo json_encode([]);
}
?>
