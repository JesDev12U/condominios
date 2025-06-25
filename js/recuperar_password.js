let objInputs = [
  {
    id: "email",
    type: "email",
    spanError: "error-email",
  },
  {
    id: "newPassword",
    type: "password-modify",
    spanError: "error-password",
  },
  {
    id: "confirmPassword",
    type: "password-modify",
    spanError: "error-password-confirm",
  },
];

validaciones(objInputs, "btn-enviar-email");

const $inputCorreoContainer = document.getElementById("input-correo-container");
const $inputCodigoContainer = document.getElementById("input-codigo-container");
const $inputNuevaPasswordContainer = document.getElementById(
  "input-nuevapassword-container"
);
const $loaderContainer = document.querySelector(".loader-container");

async function asyncRecuperarPassword(form, cbSuccess) {
  try {
    $loaderContainer.classList.remove("hidden");
    const formData = new FormData(form);
    let url = formData.get("url");
    let response = await fetch(
      `${url}/_controller/AsyncRecuperarPassword.php`,
      {
        method: "POST",
        body: formData,
      }
    );
    $loaderContainer.classList.add("hidden");
    if (!response.ok) {
      Swal.fire({
        title: "Error",
        text: response.statusText,
        icon: "error",
      });
      return;
    }
    let json = await response.json();

    if (!json.result) {
      Swal.fire({
        title: "Error",
        text: json.msg,
        icon: "error",
      });
      return;
    } else {
      Swal.fire({
        title: json.msg,
        icon: "success",
        showConfirmButton: false,
        timer: 2000,
      });
      setTimeout(() => cbSuccess(), 2000);
    }
  } catch (error) {
    console.error(error);
  }
}

const emailForm = document.getElementById("emailForm");
emailForm.addEventListener("submit", function (e) {
  e.preventDefault();
  asyncRecuperarPassword(this, () => {
    $inputCorreoContainer.classList.add("hidden");
    $inputCodigoContainer.classList.remove("hidden");
  });
});

function handleInput(current, nextFieldId) {
  const submitButtonSecurityCodeForm = document.getElementById(
    "submitButtonSecurityCodeForm"
  );
  const inputs = document.querySelectorAll(".code-input");

  if (current.value.length === 1 && nextFieldId) {
    document.getElementById(nextFieldId).focus();
  }

  const allFilled = Array.from(inputs).every(
    (input) => input.value.trim() !== ""
  );

  submitButtonSecurityCodeForm.disabled = !allFilled;
}

const securityCodeForm = document.getElementById("securityCodeForm");
securityCodeForm.addEventListener("submit", function (e) {
  e.preventDefault();
  const code = Array.from(document.querySelectorAll(".code-input"))
    .map((input) => input.value)
    .join("");
  this.innerHTML += `<input type="hidden" name="codigo" value="${code}" />`;
  asyncRecuperarPassword(this, () => {
    $inputCodigoContainer.classList.add("hidden");
    $inputNuevaPasswordContainer.classList.remove("hidden");
  });
});

function validatePasswords() {
  const newPassword = document.getElementById("newPassword").value.trim();
  const confirmPassword = document
    .getElementById("confirmPassword")
    .value.trim();
  const submitButtonPasswordForm = document.getElementById(
    "submitButtonPasswordForm"
  );
  const passwordError = document.getElementById("passwordError");

  // Verifica si las contraseñas coinciden
  if (newPassword === confirmPassword && newPassword !== "") {
    submitButtonPasswordForm.disabled = false;
    passwordError.classList.add("d-none");
  } else {
    submitButtonPasswordForm.disabled = true;
    passwordError.classList.remove("d-none");
  }
}

const passwordForm = document.getElementById("passwordForm");
passwordForm.addEventListener("submit", function (e) {
  e.preventDefault();
  asyncRecuperarPassword(this, () => {
    const formData = new FormData(passwordForm);
    location.href = `${formData.get("url")}login`;
  });
});
