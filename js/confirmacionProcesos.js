function asyncConfirmProcess(
  formData = null,
  actionUrl,
  titleQuestion,
  textQuestion,
  titleResult,
  cbSuccess = null
) {
  Swal.fire({
    title: titleQuestion,
    text: textQuestion,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    showLoaderOnConfirm: true,
    preConfirm: async () => {
      try {
        let response = null;
        if (formData) {
          response = await fetch(actionUrl, {
            method: "POST",
            body: formData, // Enviar el formulario directamente
          });
        } else {
          response = await fetch(actionUrl, { method: "POST" });
        }

        if (!response.ok) {
          throw new Error(`Error: ${response.statusText}`);
        }
        const res = await response.json();

        if (res.result !== 1) {
          Swal.showValidationMessage(res.msg);
        }
        return res;
      } catch (error) {
        Swal.showValidationMessage(error.message);
      }
    },
    allowOutsideClick: () => !Swal.isLoading(),
  }).then((result) => {
    if (result.isConfirmed) {
      if (cbSuccess) cbSuccess(result.value);
      Swal.fire({
        icon: "success",
        title: titleResult,
        text: result.value.msg,
      });
    }
  });
}
