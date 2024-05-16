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
    // Se a conexão falhar, mostra uma mensagem de erro e encerra o script
    die("Conexão falhou: " . $conn->connect_error);
}

// Define a busca baseada no parâmetro de pesquisa recebido via GET
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

// Monta a query SQL para buscar os funcionários no banco de dados
$sql = "SELECT categorias.idCategoria, categorias.nome as categoria, funcionarios.nome, funcionarios.cpf, funcionarios.situacao
        FROM funcionarios 
        INNER JOIN categorias ON funcionarios.Categorias_idCategoria = categorias.idCategoria 
        WHERE funcionarios.nome LIKE '%$search%' OR funcionarios.cpf LIKE '%$search%' OR categorias.nome LIKE '%$search%'";

// Executa a query SQL
$result = $conn->query($sql);

// Verifica se houve erro na execução da query
if ($result === false) {
    // Se houve erro, mostra uma mensagem de erro
    echo "Erro na consulta: " . $conn->error;
    // Define um array vazio para as pessoas
    $pessoas = [];
} else {
    // Se a query foi bem-sucedida, obtém os resultados e armazena em um array
    $pessoas = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pessoas[] = $row;
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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
        }
        .toolbar {
            display: flex;
            gap: 10px;
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
        .actions-dropdown {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .search-bar {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .employee-table {
            width: 100%;
            border-collapse: collapse;
        }
        .employee-table thead {
            background-color: #007bff;
            color: #fff;
        }
        .employee-table th, .employee-table td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        .employee-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .employee-table tr.selected {
            background-color: #cce5ff;
        }
    </style>
</head>
<body>
    <!-- O conteúdo da página está contido dentro de uma div com a classe "container" -->
    <div class="container">
        <!-- O cabeçalho da página contém o título "Cadastro de Funcionários" -->
        <div class="header">
           
        <h1>Cadastro de Funcionários</h1>
            <!-- A barra de ferramentas contém botões para incluir, alterar e visualizar funcionários, um menu suspenso para outras ações e um formulário de pesquisa -->
            <div class="toolbar">
                <!-- Botão para abrir um popup de inclusão de funcionário -->
                <button class="btn" onclick="abrirPopupIncluir()">Incluir</button>
                <!-- Botão para abrir um popup de alteração de funcionário (este botão não tem uma função implementada atualmente) -->
                <button class="btn" onclick="abrirPopupAlterar()">Alterar</button>
                <!-- Botão para visualizar funcionários (esta funcionalidade ainda não está implementada) -->
                <button class="btn">Visualizar</button>
                <!-- Menu suspenso para outras ações -->
                <select class="actions-dropdown">
                    <option value="">Outras Ações</option>
                    <option value="action1">Ação 1</option>
                    <option value="action2">Ação 2</option>
                </select>
                <!-- Formulário de pesquisa para filtrar funcionários -->
                <form method="GET" style ="display: inline;">
                    <input type="text" name="search" placeholder="Pesquisar" class="search-bar" value="<?php echo htmlspecialchars($search); ?>">
                    <button type="submit" class="btn">Filtrar</button>
                </form>
            </div>
        </div>
        <!-- A tabela exibe os funcionários cadastrados -->
        <table class="employee-table">
            <thead>
                <!-- Cabeçalho da tabela -->
                <tr>
                    <th>Categoria</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Situação</th>
                </tr>
            </thead>
            <tbody>
                <!-- Verifica se há funcionários cadastrados -->
                <?php if (count($pessoas) > 0): ?>
                    <!-- Se houver funcionários, percorre cada um deles -->
                    <?php foreach ($pessoas as $pessoa): ?>
                        <!-- Para cada funcionário, cria uma linha na tabela -->
                        <tr data-cpf="<?php echo htmlspecialchars($pessoa['cpf']); ?>">
                            <!-- Exibe a categoria do funcionário -->
                            <td><?php echo htmlspecialchars($pessoa['categoria']); ?></td>
                            <!-- Exibe o nome do funcionário -->
                            <td><?php echo htmlspecialchars($pessoa['nome']); ?></td>
                            <!-- Exibe o CPF do funcionário -->
                            <td><?php echo htmlspecialchars($pessoa['cpf']); ?></td>
                            <!-- Exibe a situação do funcionário -->
                            <td><?php if($pessoa['situacao']==1){echo 'Ativo';}else{echo 'Inativo';} ?></td>
                        </tr>
                    <?php endforeach; ?>
                <!-- Se não houver funcionários cadastrados, exibe uma mensagem indicando isso -->
                <?php else: ?>
                    <tr>
                        <td colspan="4">Nenhum resultado encontrado</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <!-- JavaScript para manipulação da interface -->
    <script>
// Função para abrir o popup de alteração de funcionário
function abrirPopupAlterar() {
    // Verifica se alguma linha da tabela está selecionada
    var selectedRow = document.querySelector('.employee-table tr.selected');
    if (selectedRow) {
        // Obtém o CPF da linha selecionada
        var cpf = selectedRow.getAttribute('data-cpf');
        // Constrói a URL para o script de alteração com o CPF do funcionário
        var url = "AlterarFuncionario.php?cpf=" + cpf;
        // Define as dimensões e posição do popup
        var largura = 600;
        var altura = 400;
        var esquerda = (screen.width - largura) / 2;
        var topo = (screen.height - altura) / 2;
        // Abre o popup com a URL fornecida
        window.open(url, "_blank", "width=" + largura + ", height=" + altura + ", left=" + esquerda + ", top=" + topo);
    } else {
        // Se nenhuma linha estiver selecionada, exibe um alerta
        alert("Por favor, selecione uma linha antes de prosseguir.");
    }
}
        // Função para abrir o popup de alteração de funcionário
        function abrirPopupIncluir() {
    // URL da página que você deseja abrir no popup
    var url = "CadastroFuncionario.php";

    // Largura e altura da janela popup
    var largura = 600;
    var altura = 400;

    // Calcula a posição x e y para centralizar a janela popup
    var esquerda = (screen.width - largura) / 2;
    var topo = (screen.height - altura) / 2;

    // Abre a janela popup com a URL especificada
    window.open(url, "_blank", "width=" + largura + ", height=" + altura + ", left=" + esquerda + ", top=" + topo);
}

        // Função para selecionar a linha da tabela quando clicada
        function selecionarLinha(event) {
            // Obtém o elemento TR mais próximo do elemento clicado
            var tr = event.target.closest('tr');
            // Verifica se a linha já está selecionada
            if (!tr.classList.contains('selected')) {
                // Remove a classe 'selected' de qualquer outra linha selecionada
                var selectedRow = document.querySelector('.employee-table tr.selected');
                if (selectedRow) {
                    selectedRow.classList.remove('selected');
                }
                // Adiciona a classe 'selected' à linha clicada
                tr.classList.add('selected');
            }
        }

        // Adiciona evento de clique para cada linha da tabela após o carregamento do DOM
        document.addEventListener('DOMContentLoaded', function() {
            // Seleciona todas as linhas da tabela
            var rows = document.querySelectorAll('.employee-table tbody tr');
            // Adiciona um listener de clique para cada linha
            rows.forEach(function(row) {
                row.addEventListener('click', selecionarLinha);
            });

            // Se houver um ID passado por GET na URL, seleciona a linha correspondente
            var selected_id = "<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>";
            var selectedRow = document.querySelector('.employee-table tr[data-id="' + selected_id + '"]');
            if (selectedRow) {
                selectedRow.classList.add('selected');
            }
        });
    </script>
</body
