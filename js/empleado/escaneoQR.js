const scanner = new Html5QrcodeScanner("lector-qr", {
  qrbox: {
    width: 250,
    height: 250,
  },
  fps: 20,
});
scanner.render((result) => {
  Swal.fire({
    icon: "success",
    title: "Chido",
    text: result,
  });
});

document.getElementById("html5-qrcode-button-camera-permission").innerHTML =
  "Encender cámara";

document.getElementById("html5-qrcode-anchor-scan-type-change").innerHTML =
  "O cargar archivo con QR";
