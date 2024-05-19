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
        .informacao-selecionada {
            margin-bottom: 5px;
            border: 1px solid #ccc;
            padding: 5px;
        }
        .informacao-selecionada button {
            margin-left: 5px;
        }
    </style>
    <script>
        const informacoes = [
            { id: 1, nome: 'Informação 1' },
            { id: 2, nome: 'Informação 2' },
            { id: 3, nome: 'Informação 3' },
            // Adicione mais informações conforme necessário
        ];

        const informacoesSelecionadas = [];

        function adicionarInformacao(id, nome) {
            if (!informacoesSelecionadas.includes(id)) {
                informacoesSelecionadas.push(id);
                const container = document.getElementById('informacoes-selecionadas');
                const div = document.createElement('div');
                div.className = 'informacao-selecionada';
                div.textContent = nome;

                const button = document.createElement('button');
                button.textContent = 'Remover';
                button.onclick = () => removerInformacao(id, div);

                div.appendChild(button);
                container.appendChild(div);
            } else {
                alert('Essa informação já foi adicionada.');
            }
        }

        function removerInformacao(id, element) {
            const index = informacoesSelecionadas.indexOf(id);
            if (index !== -1) {
                informacoesSelecionadas.splice(index, 1);
                element.remove();
            }
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
