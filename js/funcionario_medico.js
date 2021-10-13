var checkboxMedico = document.getElementById("isMedico");
var medicForms = document.getElementById("medicForms");
var medicActionPhp = document.getElementById("form");

function checkIsMedico() {
  if (checkboxMedico.checked) {
    medicForms.style["display"] = "";
    medicActionPhp.action = "../cadastro/cadastrar_medico.php";
  } else {
    medicForms.style["display"] = "none";
    medicActionPhp.action = "../cadastro/cadastrar_funcionario.php";
  }
}

window.onload = () => {
  checkboxMedico.addEventListener("click", checkIsMedico);
};
