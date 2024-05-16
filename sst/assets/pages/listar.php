<h2>LISTAR teste de RESULTADOS</h2>
<br/>

<?php
include ("../objects/treinamentos.php");

$resultado20= setTreinamento('NR10','Trabalho com Eletricidade','VALE SA.');

if ($resultado20) {
    echo '<br/>deu certo o setTreinamento';
}else{
    echo '<br/>NÂO deu certo o setTreinamento';
}
echo'<br/>';echo'<br/>';echo'<br/>';
echo'<br/>-----------------------------------------------------------------------------------------<br/>';

$resultado = GetTreinamentoById(1);

echo $resultado['Nome'];
echo'<br/>';
echo $resultado['idTreinamento'];
echo'<br/>';
echo $resultado['Descricao'];
echo'<br/>';
echo $resultado['Empresa_Fornecedora'];
echo'<br/>';echo'<br/>';echo'<br/>';
echo'<br/>-----------------------------------------------------------------------------------------<br/>';


$resultados1 = GetTreinamentoByNome('NR12');

if ($resultados1) {
    foreach ($resultados1 as $resultado1) {
        echo $resultado1['idTreinamento'];
        echo $resultado1['Nome'];
        echo $resultado1['Descricao'];
        echo $resultado1['Empresa_Fornecedora'];
        echo'<br/>';
    }
} else {
    echo "Nenhum resultado encontrado para o nome 'NR'.";
}
echo'<br/>';echo'<br/>';echo'<br/>';
echo'<br/>-----------------------------------------------------------------------------------------<br/>';

$resultado2= setAlterarTreinamento(1,'NR12','O TRABALHO EU NAO LEMBRO','VALE SA.');

if ($resultado2) {
    echo '<br/>deu certo o setAlterarTreinamento';
}else{
    echo '<br/>NÂO deu certo o setAlterarTreinamento';
}
echo'<br/>';echo'<br/>';echo'<br/>';
echo'<br/>-----------------------------------------------------------------------------------------<br/>';


$resultados3 = GetTreinamentoByeEmpresa_Fornecedora('VALE');

if ($resultados3) {
    foreach ($resultados3 as $resultado3) {
        echo $resultado3['Nome'];
        echo'<br/>';
        echo $resultado3['idTreinamento'];
        echo'<br/>';
        echo $resultado3['Descricao'];
        echo'<br/>';
        echo $resultado3['Empresa_Fornecedora'];
        echo'<br/>';
    }
} else {
    echo "Nenhum resultado encontrado para a Categoria 2.";
}
echo'<br/>';echo'<br/>';echo'<br/>';
echo'<br/>-----------------------------------------------------------------------------------------<br/>';

$resultados4 = GetTreinamentosALL();

if ($resultados4) {
    foreach ($resultados4 as $resultado4) {
        echo $resultado4['Nome'];
        echo'<br/>';
        echo $resultado4['idTreinamento'];
        echo'<br/>';
        echo $resultado4['Descricao'];
        echo'<br/>';
        echo $resultado4['Empresa_Fornecedora'];
        echo'<br/>';
    }
} else {
    echo "Nenhum resultado encontrado.";
}

echo'<br/>';echo'<br/>';echo'<br/>';
echo'<br/>-----------------------------------------------------------------------------------------<br/>';
$resultado5= setTreinamentoExcluir(8);

if($resultado5) {
    echo '<br/>deu certo o setTreinamentoExcluir';
}else{
    echo '<br/>NÂO deu certo o setTreinamentoExcluir';
}
echo'<br/>';echo'<br/>';echo'<br/>';
echo'<br/>-----------------------------------------------------------------------------------------<br/>';



?>


