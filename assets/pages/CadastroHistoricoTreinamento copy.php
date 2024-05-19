<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Funcionários</title>
</head>
<body>
    <div class="container">
        <h2>Adicionar Funcionários</h2>
        <form action="" method="POST">
            <label for="funcionario">Buscar Funcionário por Nome:</label>
            <input type="text" id="funcionario" name="funcionario" oninput="buscarFuncionarios(this.value)">
            <div id="funcionario-list" class="funcionario-list"></div>
                <div id="informacoes-selecionadas" class="informacoes-selecionadas"></div>
            <input type="submit" value="Adicionar">
        </form>
    </div>

    <script>
        // Função para buscar funcionários por nome
        function buscarFuncionarios(nome) {
            // Verifica se o campo de busca está vazio
            if (nome === '') {
                document.getElementById('funcionario-list').innerHTML = '';
                return;
            }
            // Faz uma requisição AJAX para buscar os funcionários
            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('funcionario-list').innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", `buscarFuncionarios.php?nome=${nome}`, true);
            xhttp.send();
        }
        function adicionarInformacao(cpf, nome) {
            if (!informacoesSelecionadas.includes(id)) {
                informacoesSelecionadas.push(id);
                const container = document.getElementById('informacoes-selecionadas');
                const div = document.createElement('div');
                div.className = 'informacao-selecionada';
                div.textContent = nome;

                const button = document.createElement('button');
                button.textContent = 'Remover';
                button.onclick = () => removerInformacao(CPF, div);

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
    </script>
</body>
</html>
