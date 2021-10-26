async function buscaEndereco(cep, path) {
  if (cep.length != 8) return;

  try {
    var endereco;
    const response = await fetch(
      path + cep
    );
    if (!response.ok) throw new Error(response.statusText);
    var endereco = await response.json();
  } catch (e) {
    console.log(e.toString());
    return;
  }

  let form = document.querySelector("form");
  form.inputLogradouro.value = endereco.logradouro;
  form.inputCidade.value = endereco.cidade;
  form.inputEstado.value = endereco.estado;
}
