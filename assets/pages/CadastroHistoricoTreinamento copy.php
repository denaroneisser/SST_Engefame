<!DOCTYPE html>
<html lang="pt-br">
<head>
<?php
// IMPORTANDO BIBLIOTECAS/DEPENDENCIAS
require_once("../objects/Categorias.php");
require_once("../objects/Funcionarios.php");
require_once("../objects/Treinamentos.php");
require_once("../objects/Empresas.php");
?>
<link rel="stylesheet" href="../styles/CadastroFuncionario.css">
<script src="../scripts/CadastroHistoricoTreinamento.js"></script>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastro de Treinamento</title>
<script>
function adicionarFuncionario(cpf, nome) {
    const container = document.getElementById('funcionarios-selecionados');
    const div = document.createElement('div');
    div.className = 'form-group';
    div.textContent = nome + " (" + cpf + ")";
    
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'funcionarios[]';
    input.value = cpf;

    div.appendChild(input);
    container.appendChild(div);
}

function buscarFuncionarios() {
    const searchQuery = document.getElementById('search').value;
    if (searchQuery.length < 3) {
        document.getElementById('search-results').innerHTML = "";
        return;
    }

    // Fazer requisição AJAX para buscar os funcionários
    fetch(`buscarFuncionarios.php?query=${searchQuery}`)
        .then(response => response.json())
        .then(data => {
            const resultsContainer = document.getElementById('search-results');
            resultsContainer.innerHTML = "";

            if (data.length > 0) {
                data.forEach(funcionario => {
                    const div = document.createElement('div');
                    div.className = 'search-result';
                    div.textContent = funcionario.Nome + " (" + funcionario.CPF + ")";

                    const button = document.createElement('button');
                    button.type = 'button';
                    button.textContent = 'Adicionar';
                    button.onclick = () => adicionarFuncionario(funcionario.CPF, funcionario.Nome);

                    div.appendChild(button);
                    resultsContainer.appendChild(div);
                });
            } else {
                resultsContainer.textContent = "Nenhum funcionário encontrado.";
            }
        })
        .catch(error => {
            console.error('Erro ao buscar funcionários:', error);
        });
}
</script>
</head>
<body>
    <div class="container">
        <h2>Cadastro de Turmas do Treinamento</h2>
        <form action="CadastroFuncionario.php" method="POST">
            <div class="form-group">
                <label for="idtreinamento">Nome do Treinamento</label>
                <select id="idtreinamento" name="idtreinamento" required>
                    <option value="">Selecione</option>
                    <?php
                    $treinamentos = GetTreinamentosALL();
                    if ($treinamentos) {
                        foreach ($treinamentos as $treinamento) {
                            echo "<option value='" . $treinamento["idTreinamento"] . "'>" . $treinamento["Nome"] . "</option>";
                        }
                    } else {
                        echo "Erro ao obter Treinamentos.";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="idempresa">Nome da Empresa Ministrante</label>
                <select id="idempresa" name="idempresa" required>
                    <option value="">Selecione</option>
                    <?php
                    $empresas = GetEmpresasALL();
                    if ($empresas) {
                        foreach ($empresas as $empresa) {
                            echo "<option value='" . $empresa["idEmpresas"] . "'>" . $empresa["Nome"] . "</option>";
                        }
                    } else {
                        echo "Erro ao obter Empresas.";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="data_realizacao">Data da Realização do Treinamento</label>
                <input type="date" id="data_realizacao" name="data_realizacao" required value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="form-group">
                <label for="data_validade">Data da Expiração do Treinamento</label>
                <input type="date" id="data_validade" name="data_validade" required>
            </div>
            <div class="form-group">
                <label for="instrutor">Nome do Instrutor</label>
                <input type="text" id="instrutor" name="instrutor" required>
            </div>
            <div class="form-group">
                <label for="carga_horaria">Carga Horária</label>
                <input type="time" id="carga_horaria" name="carga_horaria" required>
            </div>
            <div class="form-group">
                <label for="curso_pago">Valor do Treinamento por Pessoa</label>
                <select id="curso_pago" name="curso_pago" required>
                    <option value="1">SIM</option>
                    <option value="0">Não</option>
                </select>
                <input type="number" id="preco_unitario" name="preco_unitario" required placeholder="0.00">
            </div>
            <div class="form-group">
                <label for="modalidade">Modalidade</label>
                <select id="modalidade" name="modalidade" required>
                    <option value="1">Presencial</option>
                    <option value="0">Online</option>
                </select>
            </div>
            <div class="form-group">
                <label for="comprovacao">Precisa de Comprovação?</label>
                <select id="comprovacao" name="comprovacao" required>
                    <option value="1">SIM</option>
                    <option value="0">Não</option>
                </select>
            </div>
            <div class="form-group">
                <label for="funcionarios">Adicionar Funcionário</label>
                <input type="text" id="search" onkeyup="buscarFuncionarios()" placeholder="Pesquisar por nome ou CPF">
                <div id="search-results" class="search-results"></div>
                <div id="funcionarios-selecionados"></div>
            </div>
            <div class="form-group">
                <button type="submit" onclick="VerificaCPF(event)">Cadastrar</button>
            </div>
        </form>
    </div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Processa os dados do formulário
    // Exemplo de processamento:
    // $resultado = setFuncionario($_POST['nome'], $_POST['cpf'], $_POST['situacao'], $_POST['categoria']);
    // Adicione o código para processar o cadastro do treinamento aqui
    echo("<script>alert('Formulário enviado!');</script>");
}
?>

</body>
</html>

<?php
require_once("../objects/Funcionarios.php");

$query = $_GET['query'] ?? '';

if ($query) {
    $funcionarios = searchFuncionarios($query); // Suponha que essa função busca funcionários pelo nome ou CPF
    echo json_encode($funcionarios);
} else {
    echo json_encode([]);
}

function searchFuncionarios($query) {
    // Conecte-se ao banco de dados
    $conn = getConnection();

    // Proteja a consulta contra SQL injection
    $query = "%" . $conn->real_escape_string($query) . "%";

    // Prepare a consulta SQL
    $sql = "SELECT CPF, Nome FROM Funcionarios WHERE Nome LIKE ? OR CPF LIKE ?";
    $stmt = $conn->prepare($sql);
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

?>

