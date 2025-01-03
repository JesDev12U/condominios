const scanner = new Html5QrcodeScanner("lector-qr", {
  qrbox: {
    width: 250,
    height: 250,
  },
  fps: 20,
});
scanner.render(async (result) => {
  try {
    scanner.clear();

    const response = await fetch(
      `${
        document.getElementById("lector-qr").dataset.url
      }_controller/empleado/escaneoqr/AsyncEscaneoQR.php`,
      {
        method: "POST",
        body: result,
      }
    );
    let json = await response.json();

    if (json.result == 0) {
      Swal.fire({
        icon: "error",
        title: "¡Ocurrió un error!",
        text: json.msg,
      });
      return;
    }

    Swal.fire({
      icon: "success",
      title: json.msg,
      showConfirmButton: false,
    });

    setTimeout(() => {
      location.href = `${
        document.getElementById("lector-qr").dataset.url
      }empleado/visitas`;
    }, 2000);
  } catch (err) {
    console.error(err);
  }
});
