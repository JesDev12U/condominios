const $loader = document.getElementById("loader");

function aparecerLoader() {
  $loader.classList.remove("hidden");
  document.body.style.overflowY = "hidden";
}

function desaparecerLoader() {
  $loader.classList.add("hidden");
  document.body.style.overflowY = "visible";
}

const verificarIndex = (site_url) =>
  location.href === `${site_url}index.php`
    ? (location.href = `${site_url}`)
    : location.href;

const sesion = (json, site_url) => {
  let jsonParsed = JSON.parse(json);
  if (jsonParsed.sesion.length !== 0) {
    if (
      jsonParsed.sesion.loggeado &&
      location.href !== `${site_url}${jsonParsed.sesion.usuario}`
    )
      location.href = `${site_url}${jsonParsed.sesion.usuario}`;
  }
};
