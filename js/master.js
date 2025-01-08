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

function validaciones(objInputs, idButton) {
  //objInputs: [{ id, type, spanError }] Array de Objetos
  objInputs.forEach((obj) => {
    let $input = document.getElementById(obj.id);
    let $spanError = document.getElementById(obj.spanError);
    let isValidInput = false;
    $input.addEventListener("input", function () {
      isValidInput = checkValidInput(obj.type, this);
      if (isValidInput) $spanError.classList.add("hidden");
      else $spanError.classList.remove("hidden");
      checkAllValid();
    });
  });

  function checkValidInput(type, input) {
    switch (type) {
      case "email":
        return validator.isEmail(input.value);
      case "password":
        return input.value.length !== 0;
      case "nombre":
        return input.value.length !== 0;
      case "phone":
        return validator.isMobilePhone(input.value, ["es-MX"]);
      case "torre":
        return input.value.length > 0 && input.value.length <= 5;
      case "text":
        return input.value.length !== 0;
      case "cantidad_personas":
        return parseInt(input.value) > 0 && parseInt(input.value) <= 50;
      case "fecha":
        return validator.isDate(input.value, { format: "YYYY-MM-DD" });
      case "hora":
        return validator.isTime(input.value);
      case "curp":
        let regex =
          /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/;
        return regex.test(input.value);
      default:
        return true;
    }
  }

  function checkAllValid() {
    let allValid = objInputs.every((obj) => {
      let $input = document.getElementById(obj.id);
      return checkValidInput(obj.type, $input);
    });
    let $button = document.getElementById(idButton);
    $button.disabled = !allValid;
  }

  checkAllValid();
}
