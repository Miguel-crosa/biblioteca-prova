async function buscarCep() {
    const cepInput = document.getElementById('Cep').value;

    const cep = cepInput.replace(/\D/g, '');

    if (cep.length !== 8) {
        alert("Formato de CEP inválido.");
        return;
    }

    try {
        const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
        const data = await response.json();

        if (data.erro) {
            alert("CEP não encontrado.");
            limparFormulario();
            return;
        }

        document.getElementById('Endereco').value = data.logradouro;
        document.getElementById('Bairro').value = data.bairro;
        document.getElementById('Cidade').value = data.localidade;
        document.getElementById('Estado').value = `${data.estado}`;

    } catch (error) {
        console.error("Erro ao buscar CEP:", error);
        alert("Erro ao conectar com a API.");
    }
}

function limparFormulario() {
    document.getElementById('Endereco').value = "";
    document.getElementById('Bairro').value = "";
    document.getElementById('Cidade').value = "";
}