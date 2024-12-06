const $loader = document.getElementById("loader");

function aparecerLoader() {
  $loader.classList.remove("hidden");
  document.body.style.overflowY = "hidden";
}

function desaparecerLoader() {
  $loader.classList.add("hidden");
  document.body.style.overflowY = "visible";
}
