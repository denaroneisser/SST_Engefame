<?php
// Configurações de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sst_engefame";

// Estabelece a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Define a busca baseada no parâmetro de pesquisa recebido via GET
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$searchColumn = isset($_GET['searchColumn']) ? $conn->real_escape_string($_GET['searchColumn']) : '';

// Define a coluna para a pesquisa
$columnMap = [
    'Nome' => 'Categorias.Nome',
    'IdCategoria' => 'categorias.idCategoria',
];
$searchColumnSql = isset($columnMap[$searchColumn]) ? $columnMap[$searchColumn] : '';

// Paginação
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per_page = 15;
$offset = ($page - 1) * $items_per_page;

// Monta a query SQL para contar o total de funcionários no banco de dados
$sql_count = "SELECT COUNT(*) as total
              FROM funcionarios 
              INNER JOIN categorias ON funcionarios.Categorias_idCategoria = categorias.idCategoria";
if ($search && $searchColumnSql) {
    $sql_count .= " WHERE $searchColumnSql LIKE '%$search%'";
} elseif ($search) {
    $sql_count .= " WHERE funcionarios.nome LIKE '%$search%' OR funcionarios.cpf LIKE '%$search%' OR categorias.nome LIKE '%$search%'";
}

// Executa a query SQL para contar o total de Categorias
$result_count = $conn->query($sql_count);
$total_items = $result_count->fetch_assoc()['total'];
$total_pages = ceil($total_items / $items_per_page);

// Monta a query SQL para buscar os funcionários no banco de dados com limite e offset
$sql = "SELECT * FROM Categorias";
if ($search && $searchColumnSql) {
    $sql .= " WHERE $searchColumnSql LIKE '%$search%'";
} elseif ($search) {
    $sql .= " WHERE funcionarios.nome LIKE '%$search%' OR funcionarios.cpf LIKE '%$search%' OR categorias.nome LIKE '%$search%'";
}
$sql .= " LIMIT $items_per_page OFFSET $offset";

// Executa a query SQL
$result = $conn->query($sql);

// Verifica se houve erro na execução da query
if ($result === false) {
    echo "Erro na consulta: " . $conn->error;
    $categorias = [];
} else {
    $categorias = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categorias[] = $row;
        }
    }
}

// Fecha a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Funcionários</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
        }
        .toolbar {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        .btn {
            padding: 8px 12px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .actions-dropdown, .search-bar, .search-column {
            min-width: 200px;
        }
        .employee-table {
            width: 100%;
            overflow-x: auto;
            border-collapse: collapse;
        }
        .employee-table th,
        .employee-table td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .pagination a,
        .pagination span {
            padding: 10px 20px;
            margin: 0 5px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .pagination a:hover {
            background-color: #0056b3;
        }
        .pagination .disabled {
            background-color: #ccc;
            pointer-events: none;
        }
        .employee-table tr.selected {
            background-color: #e0e0e0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Cadastro de Categorias - Alpha</h1>
            <div class="toolbar">
                <button class="btn" onclick="abrirPopupIncluir()">Incluir</button>
                <button class="btn" onclick="realizarAcao('alterar')">Alterar</button>
                <button class="btn" onclick="realizarAcao('visualizar')">Visualizar</button>
                <button class="btn" onclick="realizarAcao('apagar')">Apagar</button>
                <form method="GET" style="display: inline;">
                    <input type="text" name="search" placeholder="Pesquisar" class="search-bar" value="<?php echo htmlspecialchars($search); ?>">
                    <select name="searchColumn" class="search-column">
                        <option value="">Todas as colunas</option>
                        <option value="idCategoria" <?php echo $searchColumn == 'Nome' ? 'selected' : ''; ?>>Nome</option>
                        <option value="Nome" <?php echo $searchColumn == 'IdCategoria' ? 'selected' : ''; ?>>CPF</option>
                    </select>
                    <button type="submit" class="btn">Filtrar</button>
                </form>
            </div>
        </div>
        
        <table class="employee-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($categorias) > 0): ?>
                    <!-- Se houver funcionários, percorre cada um deles -->
                    <?php foreach ($categorias as $categoria): ?>
                        <!-- Para cada funcionário, cria uma linha na tabela -->
                        <tr data-cpf="<?php echo htmlspecialchars($categoria['idCategoria']); ?>">
                            <!-- Exibe a categoria do funcionário -->
                            <td><?php echo htmlspecialchars($categoria['Nome']); ?></td>
                            <!-- Exibe o nome do funcionário -->
                        </tr>
                    <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Nenhum resultado encontrado</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?search=<?php echo urlencode($search); ?>&searchColumn=<?php echo urlencode($searchColumn); ?>&page=<?php echo $page - 1; ?>">Anterior</a>
            <?php else: ?>
                <span class="disabled">Anterior</span>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <?php if ($i == $page): ?>
                    <span class="disabled"><?php echo $i; ?></span>
                <?php else: ?>
                    <a href="?search=<?php echo urlencode($search); ?>&searchColumn=<?php echo urlencode($searchColumn); ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>
            <?php if ($page < $total_pages): ?>
                <a href="?search=<?php echo urlencode($search); ?>&searchColumn
                =<?php echo urlencode($searchColumn); ?>&page=<?php echo $page + 1; ?>">Próximo</a>
            <?php else: ?>
                <span class="disabled">Próximo</span>
            <?php endif; ?>
        </div>
    </div>
    <script>
    function abrirPopupIncluir() {
        var url = "CadastroCategoria.php";
        var largura = 600;
        var altura = 400;
        var esquerda = (screen.width - largura) / 2;
        var topo = (screen.height - altura) / 2;
        window.open(url, "_blank", "width=" + largura + ", height=" + altura + ", left=" + esquerda + ", top=" + topo);
    }

    function realizarAcao(acao) {
        var selectedRow = document.querySelector('.employee-table tr.selected');
        if (selectedRow) {
            var cpf = selectedRow.getAttribute('data-cpf');
            var url = "";
            if (acao === 'alterar') {
                url = "AlterarFuncionario.php?cpf=" + cpf;
            } else if (acao === 'visualizar') {
                url = "VisualizarFuncionario.php?cpf=" + cpf;
            } else if (acao === 'apagar') {
                if (confirm("Tem certeza que deseja apagar este funcionário?")) {
                    url = "ApagarFuncionario.php?cpf=" + cpf;
                    window.location.href = url;
                    return;
                } else {
                    return;
                }
            }
            var largura = 600;
            var altura = 400;
            var esquerda = (screen.width - largura) / 2;
            var topo = (screen.height - altura) / 2;
            window.open(url, "_blank", "width=" + largura + ", height=" + altura + ", left=" + esquerda + ", top=" + topo);
        } else {
            alert("Por favor, selecione uma linha antes de prosseguir.");
        }
    }

    function selecionarLinha(event) {
        var tr = event.target.closest('tr');
        if (!tr.classList.contains('selected')) {
            var selectedRow = document.querySelector('.employee-table tr.selected');
            if (selectedRow) {
                selectedRow.classList.remove('selected');
            }
            tr.classList.add('selected');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        var rows = document.querySelectorAll('.employee-table tbody tr');
        rows.forEach(function(row) {
            row.addEventListener('click', selecionarLinha);
        });

        var selected_id = "<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>";
        var selectedRow = document.querySelector('.employee-table tr[data-cpf="' + selected_id + '"]');
        if (selectedRow) {
            selectedRow.classList.add('selected');
        }
    });
</script>

<style>
    /* Estilos para a barra de pesquisa */
    .search-bar {
        flex: 1;
        padding: 10px;
        border-radius: 4px;
        border: 1px solid #ccc;
        font-size: 16px;
    }

    /* Estilos para a caixa de categorias */
    .search-column select {
        padding: 10px;
        border-radius: 4px;
        border: 1px solid #ccc;
        font-size: 16px;
        background-color: #f9f9f9;
    }

    /* Estilizando as opções da caixa de categorias */
    .search-column select option {
        background-color: #fff;
    }

    /* Estilos para o botão de filtro */
    .btn-filter {
        padding: 10px 15px;
        border-radius: 4px;
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
        font-size: 16px;
    }

    /* Estilos para o botão de filtro ao passar o mouse */
    .btn-filter:hover {
        background-color: #0056b3;
    }
</style>


</body>
</html>
