console.log("asdasd");
window.onload = iniciar;

function iniciar() {
  document.getElementById("send").addEventListener("click", validar, false);
}

function validarNombre() {
  var elemento = document.getElementById("nombre");
  if (elemento.value == "" || !isNaN(elemento.value)) {
    alertico("Y el Nombre?");
    return false;
  }
  return true;
}

function validarDescripcion() {
  var elemento = document.getElementById("descripcion");
  if (elemento.value == "" || !isNaN(elemento.value)) {
    alertico("Y el descripcion?");
    return false;
  }
  return true;
}

function validarUnidades() {
  var elemento = document.getElementById("unidades");
  if (elemento.value <= 0) {
    alertico("Y la cantidad?");
    return false;
  }
  return true;
}

function validarTipo() {
  var elemento = document.getElementById("tipo");
  if (elemento.value == "Elija..." || elemento.value == "Choose...") {
    alertico("Y el Tipo?");
    return false;
  }
  return true;
}

function validarLaboratorio() {
  var elemento = document.getElementById("laboratorio");
  if (elemento.value == "" || !isNaN(elemento.value)) {
    alertico("Y el laboratorio?");
    return false;
  }
  return true;
}

function validarFecha() {
  var elemento = document.getElementById("fecha");
  if (elemento.value == "" || !isNaN(elemento.value)) {
    alertico("Y la fecha?");
    return false;
  }
  return true;
}

function validar(e) {
  if (
    validarFecha() &&
    validarUnidades() &&
    validarNombre() &&
    validarDescripcion() &&
    validarLaboratorio() &&
    validarTipo()
  ) {
    return true;
  } else {
    e.preventDefault();
    return false;
  }
}

function alertico(mensaje) {
  alertify.error(mensaje);
}
