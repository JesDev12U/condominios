function validaciones(objInputs, idButton) {
  //objInputs: [{ id, type, spanError }] Array de Objetos
  //Longitudes obtenidas directamente de la base de datos
  const lengthInputs = [
    {
      input: "phone",
      longitud: 10,
    },
    {
      input: "password",
      longitud: 16,
    },
    {
      input: "password-modify",
      longitud: 16,
    },
    {
      input: "nombre",
      longitud: 50,
    },
    {
      input: "email",
      longitud: 80,
    },
    {
      input: "torre",
      longitud: 5,
    },
    {
      input: "departamento",
      longitud: 30,
    },
    {
      input: "curp",
      longitud: 18,
    },
    {
      input: "detalles_evento",
      longitud: 255,
    },
    {
      input: "tipo_evento",
      longitud: 20,
    },
  ];
  objInputs.forEach((obj) => {
    let $input = document.getElementById(obj.id);
    let $spanError = document.getElementById(obj.spanError);
    let isValidInput = false;
    $input.addEventListener("input", function () {
      for (const { input, longitud } of lengthInputs)
        if (obj.type === input) this.value = this.value.slice(0, longitud);

      isValidInput = checkValidInput(obj.type, this);
      if (isValidInput) $spanError.classList.add("hidden");
      else $spanError.classList.remove("hidden");
      checkAllValid();
    });
  });

  function checkValidInput(type, input) {
    switch (type) {
      case "email":
        input.value = input.value
          .replace(/[^a-zA-Z0-9@.\-_]/g, "")
          .replace(/\.{2,}/g, ".") // Elimina puntos consecutivos
          .toLowerCase()
          .trim();
        return validator.isEmail(input.value);
      case "password":
        input.value = input.value.replace(/\s+/g, "");
        return input.value.length > 0 && input.value.length <= 16;
      case "password-modify":
        return input.value.length <= 16;
      case "nombre":
        input.value = input.value
          .replace(/\s+/g, " ")
          .replace(/[^a-zA-Z\s]/g, "");
        return input.value.length !== 0;
      case "phone":
        input.value = input.value.trim().replace(/\D/g, "");
        return (
          input.value.length > 0 &&
          input.value.length <= 10 &&
          validator.isMobilePhone(input.value, ["es-MX"])
        );
      case "torre":
        input.value = input.value
          .trim()
          .replace(/\s/g, "")
          .replace(/[^a-zA-Z0-9.\-_]/g, "");
        return input.value.length > 0 && input.value.length <= 5;
      case "departamento":
        input.value = input.value
          .trim()
          .replace(/\s/g, "")
          .replace(/[^a-zA-Z0-9.\-_]/g, "");
        return input.value.length !== 0;
      case "detalles_evento":
        return input.value.length > 0 && input.value.length <= 255;
      case "tipo_evento":
        return input.value.length > 0 && input.value.length <= 20;
      case "text":
        return input.value.length !== 0;
      case "cantidad_personas":
        input.value = input.value.trim().replace(/\D/g, "");
        return parseInt(input.value) > 0 && parseInt(input.value) <= 50;
      case "fecha":
        return validator.isDate(input.value, { format: "YYYY-MM-DD" });
      case "hora":
        return validator.isTime(input.value);
      case "curp":
        let regex =
          /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/;
        input.value = input.value
          .trim()
          .toUpperCase()
          .replace(/\s/g, "")
          .replace(/[^A-Z0-9]/g, "");
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
