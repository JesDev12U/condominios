//Traducción de HTML5QRCode
//@ref https://github.com/mebjas/html5-qrcode/issues/132#issuecomment-1526904243
function scannerTranslator() {
  const traducciones = [
    // Html5QrcodeStrings
    {
      original: "QR code parse error, error =",
      traduccion: "Error al analizar el código QR, error =",
    },
    {
      original: "Error getting userMedia, error =",
      traduccion: "Error al obtener userMedia, error =",
    },
    {
      original:
        "The device doesn't support navigator.mediaDevices , only supported cameraIdOrConfig in this case is deviceId parameter (string).",
      traduccion:
        "El dispositivo no admite navigator.mediaDevices, en este caso sólo se admite cameraIdOrConfig como parámetro deviceId (cadena).",
    },
    {
      original: "Camera streaming not supported by the browser.",
      traduccion: "El navegador no admite la transmisión de la cámara.",
    },
    {
      original: "Unable to query supported devices, unknown error.",
      traduccion:
        "No se puede consultar los dispositivos compatibles, error desconocido.",
    },
    {
      original:
        "Camera access is only supported in secure context like https or localhost.",
      traduccion:
        "El acceso a la cámara sólo es compatible en un contexto seguro como https o localhost.",
    },
    { original: "Scanner paused", traduccion: "Escáner en pausa" },

    // Html5QrcodeScannerStrings
    { original: "Scanning", traduccion: "Escaneando" },
    { original: "Idle", traduccion: "Inactivo" },
    { original: "Error", traduccion: "Error" },
    { original: "Permission", traduccion: "Permiso" },
    { original: "No Cameras", traduccion: "Sin cámaras" },
    { original: "Last Match:", traduccion: "Última coincidencia:" },
    { original: "Code Scanner", traduccion: "Escáner de código" },
    {
      original: "Request Camera Permissions",
      traduccion: "Solicitar permisos de cámara",
    },
    {
      original: "Requesting camera permissions...",
      traduccion: "Solicitando permisos de cámara...",
    },
    {
      original: "No camera found",
      traduccion: "No se encontró ninguna cámara",
    },
    { original: "Stop Scanning", traduccion: "Detener escaneo" },
    { original: "Start Scanning", traduccion: "Iniciar escaneo" },
    { original: "Switch On Torch", traduccion: "Encender linterna" },
    { original: "Switch Off Torch", traduccion: "Apagar linterna" },
    {
      original: "Failed to turn on torch",
      traduccion: "Error al encender la linterna",
    },
    {
      original: "Failed to turn off torch",
      traduccion: "Error al apagar la linterna",
    },
    { original: "Launching Camera...", traduccion: "Iniciando cámara..." },
    {
      original: "Scan an Image File",
      traduccion: "Escanear un archivo de imagen",
    },
    {
      original: "Scan using camera directly",
      traduccion: "Escanear usando la cámara directamente",
    },
    { original: "Select Camera", traduccion: "Seleccionar cámara" },
    { original: "Choose Image", traduccion: "Elegir imagen" },
    { original: "Choose Another", traduccion: "Elegir otra" },
    { original: "No image choosen", traduccion: "Ninguna imagen seleccionada" },
    { original: "Anonymous Camera", traduccion: "Cámara anónima" },
    {
      original: "Or drop an image to scan",
      traduccion: "O arrastra una imagen para escanear",
    },
    {
      original: "Or drop an image to scan (other files not supported)",
      traduccion:
        "O arrastra una imagen para escanear (otros archivos no soportados)",
    },
    { original: "zoom", traduccion: "zoom" },
    { original: "Loading image...", traduccion: "Cargando imagen..." },
    { original: "Camera based scan", traduccion: "Escaneo basado en cámara" },
    { original: "Fule based scan", traduccion: "Escaneo basado en archivo" },

    // LibraryInfoStrings
    { original: "Powered by ", traduccion: "Desarrollado por " },
    { original: "Report issues", traduccion: "Informar de problemas" },

    // Others
    {
      original: "NotAllowedError: Permission denied",
      traduccion: "Permiso denegado para acceder a la cámara",
    },
  ];

  // Función para traducir un texto
  function traducirTexto(texto) {
    const traduccion = traducciones.find((t) => t.original === texto);
    return traduccion ? traduccion.traduccion : texto;
  }

  // Función para traducir los nodos de texto
  function traducirNodosDeTexto(nodo) {
    if (nodo.nodeType === Node.TEXT_NODE) {
      nodo.textContent = traducirTexto(nodo.textContent.trim());
    } else {
      for (let i = 0; i < nodo.childNodes.length; i++) {
        traducirNodosDeTexto(nodo.childNodes[i]);
      }
    }
  }

  // Crear el MutationObserver
  const observer = new MutationObserver((mutations) => {
    mutations.forEach((mutation) => {
      if (mutation.type === "childList") {
        mutation.addedNodes.forEach((nodo) => {
          traducirNodosDeTexto(nodo);
        });
      }
    });
  });

  // Configurar y ejecutar el observer
  const config = { childList: true, subtree: true };
  observer.observe(document.body, config);

  // Traducir el contenido inicial
  traducirNodosDeTexto(document.body);
}

function cargarScanner() {
  const scanner = new Html5QrcodeScanner("lector-qr", {
    qrbox: {
      width: 250,
      height: 250,
    },
    fps: 20,
  });
  // Utilizando la función scannerTranslator
  scannerTranslator(document.querySelector("#lector-qr"));
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
        return cargarScanner();
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
}

cargarScanner();
