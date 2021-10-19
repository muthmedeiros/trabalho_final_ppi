async function buscaEspecialidades() {
    let form = document.querySelector("form");
    fetch("/src/assets/js/busca_dados.php?especialidade=" + especialidade)
        .then(response => response.json())
        .then(buscadorDeEspecialidades => {
            form.especialidade.value = buscadorDeEspecialidades.especialidade;
            form.medico.value = buscadorDeEspecialidades.medico;
            let select = document.querySelector("#especialidade");
            for (let i = 1; i < form.especialidade.value; i++) {
                let option = document.createElement("option");
                option.text = form.especialidade[i].value;
                option.value = form.especialidade[i].value;
                select.add(option, select.lenght - 1);
            }

        })
        .catch(error => {
            form.reset();
            console.error('Falha inesperada' + error);
        });
}

function sendForm(form) {
    const formData = new FormData(form);
    let options = {
        method: 'post',
        body: formData
    }
    fetch(form.getAttribute('action'), options)
        .then(response => {
            if (!response.ok) throw new Error("not ok")
            return response.json();
        })
        .then(result => {
            if (result.sucess) {
                showSucessMessage('Agendamento Realizado com sucesso')
                form.reset();
            } else
                showSucessMessage(result.message)
                .catch(error => {
                    showErrorMessage('Opearação Falha' + error.message);
                });

        })

}


window.onload = function() {
    buscaEspecialidades()
}