const $formLogin = document.getElementById("form-login");

$formLogin.addEventListener("submit", async (e) => {
  e.preventDefault();
  aparecerLoader();
  const formData = new FormData($formLogin);
  let datos = {};
  for (const [clave, valor] of formData.entries()) {
    datos[clave] = valor;
  }

  try {
    let response = await fetch("_controller/ajaxLogin.php", {
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
      redireccionMenu(json.usuario);
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
