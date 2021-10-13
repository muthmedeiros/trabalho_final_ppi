async function buscaEndereco(cep) {
  if (cep.length != 9) return;

  try {
    let response = await fetch("busca-endereco.php?cep=" + cep);
    if (!response.ok) throw new Error(response.statusText);
    var endereco = await response.json;
  } catch (error) {
    console.error(error);
    return;
  }

  let form = document.querySelector("form");
  form.inputLogradouro.value = endereco.logradouro;
  form.inputCidade.value = endereco.cidade;
  form.inputEstado.value = endereco.estado;
}

window.onLoad = () => {
  const inputCep = document.getElementById("inputCep");
  inputCep.onkeyup = () => buscaEndereco(inputCep.value);
};
