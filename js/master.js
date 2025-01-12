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
      !location.href.includes(`${site_url}${jsonParsed.sesion.usuario}`)
    )
      location.href = `${site_url}${jsonParsed.sesion.usuario}`;
  } else {
    if (
      location.href.includes("empleado") ||
      location.href.includes("administrador") ||
      location.href.includes("condomino")
    )
      location.href = site_url;
  }
};

const $password = document.getElementById("password");
const $togglePassword = document.getElementById("toggle-password");

if ($togglePassword) {
  $togglePassword.addEventListener("click", function () {
    const type = $password.type === "password" ? "text" : "password";
    $password.type = type;

    switch (type) {
      case "password":
        this.innerHTML = `<i class="fa-solid fa-eye"></i>`;
        break;
      case "text":
        this.innerHTML = `<i class="fa-solid fa-eye-slash"></i>`;
    }
  });
}
