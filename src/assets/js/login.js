function enviaForm() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./script/login.php");
    xhr.onload = function() {
        if (xhr.status != 200) {
            console.log("FALHA", xhr.responseText);
            return;
        }

        try {
            var response = JSON.parse(xhr.responseText);
        } catch (e) {
            console.error("STRING JSON INVALIDA" + xhr.responseText);
        }
        if (response.sucess) {
            window.location = response.detail;
        } else {
            document.querySelector("span").style.display = 'block';
            form.senha.value = "";
            form.senha.focus();
        }
    }

    xhr.onerror = function() {
        console.error("Erro de Rede")
    }

    const form = document.querySelector("form");
    xhr.send(new FormData(form));
}