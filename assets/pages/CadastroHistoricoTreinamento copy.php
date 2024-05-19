<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Treinamento</title>
    <style>
        .search-results {
            border: 1px solid #ccc;
            max-height: 200px;
            overflow-y: auto;
        }
        .search-result {
            padding: 10px;
            cursor: pointer;
        }
        .search-result:hover {
            background-color: #f0f0f0;
        }
        .funcionarios-selecionados {
            margin-top: 10px;
        }
    </style>
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
                            div.onclick = () => adicionarFuncionario(funcionario.CPF, funcionario.Nome);
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
        <h2>Cadastro de Treinamento</h2>
        <form action="CadastroHistoricoTreinamento.php" method="POST">
            <div class="form-group">
                <label for="search">Adicionar Funcionário</label>
                <input type="text" id="search" onkeyup="buscarFuncionarios()" placeholder="Pesquisar por nome ou CPF">
                <div id="search-results" class="search-results"></div>
                <div id="funcionarios-selecionados" class="funcionarios-selecionados"></div>
            </div>
            <div class="form-group">
                <button type="submit">Cadastrar</button>
            </div>
        </form>
    </div>
</body>
</html>
