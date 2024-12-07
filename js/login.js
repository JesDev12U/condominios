const $formLogin = document.getElementById("form-login");
const $password = document.getElementById("password");
const $togglePassword = document.getElementById("toggle-password");

$formLogin.addEventListener("submit", async (e) => {
  e.preventDefault();
  aparecerLoader();
  const formData = new FormData($formLogin);
  let datos = {};
  for (const [clave, valor] of formData.entries()) {
    datos[clave] = valor;
  }

  try {
    let response = await fetch("_model/ajaxLogin.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(datos),
    });

    if (!response.ok) {
      desaparecerLoader();
      throw new Error(response.statusText);
    }

    let json = await response.json();
    desaparecerLoader();
    if (!json.resultado) {
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Credenciales incorrectas",
      });
    } else {
      //TODO: Redireccionar al usuario a su correspondiente menu
    }
  } catch (err) {
    desaparecerLoader();
    console.error(err);
    Swal.fire({
      icon: "error",
      title: "Error",
      text: err,
    });
  }
});

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
