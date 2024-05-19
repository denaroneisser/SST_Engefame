<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Informações</title>
    <style>
        .search-results {
            border: 1px solid #ccc;
            max-height: 200px;
            overflow-y: auto;
            margin-bottom: 10px;
        }
        .search-result {
            padding: 10px;
            cursor: pointer;
        }
        .search-result:hover {
            background-color: #f0f0f0;
        }
        .informacoes-selecionadas {
            margin-top: 10px;
        }
    </style>
    <script>
        const informacoes = [
            { id: 1, nome: 'Informação 1' },
            { id: 2, nome: 'Informação 2' },
            { id: 3, nome: 'Informação 3' },
            // Adicione mais informações conforme necessário
        ];

        function adicionarInformacao(id, nome) {
            const container = document.getElementById('informacoes-selecionadas');
            const div = document.createElement('div');
            div.className = 'form-group';
            div.textContent = nome;

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'informacoes[]';
            input.value = id;

            div.appendChild(input);
            container.appendChild(div);
        }

        function buscarInformacoes() {
            const searchQuery = document.getElementById('search').value.toLowerCase();
            const resultsContainer = document.getElementById('search-results');
            resultsContainer.innerHTML = "";

            const filteredInformacoes = informacoes.filter(info =>
                info.nome.toLowerCase().includes(searchQuery)
            );

            if (filteredInformacoes.length > 0) {
                filteredInformacoes.forEach(info => {
                    const div = document.createElement('div');
                    div.className = 'search-result';
                    div.textContent = info.nome;
                    div.onclick = () => adicionarInformacao(info.id, info.nome);
                    resultsContainer.appendChild(div);
                });
            } else {
                resultsContainer.textContent = "Nenhuma informação encontrada.";
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Adicionar Informações</h2>
        <form action="processarInformacoes.php" method="POST">
            <div class="form-group">
                <label for="search">Buscar Informações</label>
                <input type="text" id="search" onkeyup="buscarInformacoes()" placeholder="Pesquisar...">
                <div id="search-results" class="search-results"></div>
                <div id="informacoes-selecionadas" class="informacoes-selecionadas"></div>
            </div>
            <div class="form-group">
                <button type="submit">Enviar</button>
            </div>
        </form>
    </div>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $informacoes = $_POST['informacoes'] ?? [];

    if (!empty($informacoes)) {
        echo "Informações selecionadas:<br>";
        foreach ($informacoes as $info) {
            echo "ID: " . htmlspecialchars($info) . "<br>";
        }
    } else {
        echo "Nenhuma informação selecionada.";
    }
}
?>