document.getElementById('preco_unitario').addEventListener('input', function (e) {
    var value = e.target.value;
    // Remove caracteres não numéricos, exceto ponto decimal
    value = value.replace(/[^\d.]/g, '');

    // Adiciona formatação de moeda
    e.target.value = parseFloat(value).toFixed(2);
  });

  document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault();
    var time = document.getElementById('carga_horaria').value;
    alert('Hora selecionada: ' + time);
  });