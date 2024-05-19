<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Informações</title>
    <style>
        /* Estilos CSS */
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
        // Array de informações disponíveis para seleção
        const informacoes = [
            { id: 1, nome: 'Informação 1' },
            { id: 2, nome: 'Informação 2' },
            { id: 3, nome: 'Informação 3' },
            // Adicione mais informações conforme necessário
        ];

        // Array para armazenar as informações selecionadas
        const informacoesSelecionadas = [];

        // Função para adicionar uma informação selecionada
        function adicionarInformacao(id, nome) {
            // Verifica se a informação já foi adicionada
            if (!informacoesSelecionadas.includes(id)) {
                // Adiciona a informação ao array de informações selecionadas
                informacoesSelecionadas.push(id);
                // Obtém o container onde as informações selecionadas serão exibidas
                const container = document.getElementById('informacoes-selecionadas');
                // Cria um elemento para exibir a informação selecionada
                const div = document.createElement('div');
                div.className = 'informacao-selecionada';
                div.textContent = nome;

                // Cria um botão para remover a informação
                const button = document.createElement('button');
                button.textContent = 'Remover';
                // Define o evento de clique do botão para chamar a função de remoção
                button.onclick = () => removerInformacao(id, div);

                // Adiciona o botão ao elemento da informação selecionada
                div.appendChild(button);
                // Adiciona o elemento ao container
                container.appendChild(div);
            } else {
                // Exibe um alerta se a informação já foi adicionada
                alert('Essa informação já foi adicionada.');
            }
        }

        // Função para remover uma informação selecionada
        function removerInformacao(id, element) {
            // Obtém o índice da informação no array de informações selecionadas
            const index = informacoesSelecionadas.indexOf(id);
            // Verifica se a informação está presente no array
            if (index !== -1) {
                // Remove a informação do array de informações selecionadas
                informacoesSelecionadas.splice(index, 1);
                // Remove o elemento do DOM
                element.remove();
            }
        }

        // Função para buscar informações com base na entrada do usuário
        function buscarInformacoes() {
            // Obtém a consulta de busca do campo de entrada
            const searchQuery = document.getElementById('search').value.toLowerCase();
            // Obtém o contêiner onde os resultados da busca serão exibidos
            const resultsContainer = document.getElementById('search-results');
            // Limpa o contêiner de resultados
            resultsContainer.innerHTML = "";

            // Filtra as informações com base na consulta de busca
            const filteredInformacoes = informacoes.filter(info =>
                info.nome.toLowerCase().includes(searchQuery)
            );

            // Verifica se há resultados
            if (filteredInformacoes.length > 0) {
                // Para cada informação filtrada, cria um elemento na lista de resultados
                filteredInformacoes.forEach(info => {
                    const div = document.createElement
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