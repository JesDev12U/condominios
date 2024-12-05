<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .columnas {
            display: flex;
            flex-direction: row;
        }

        .container {
            width: 50%;
            padding: 20px;
        }
    </style>
    <title>Document</title>
</head>

<body>
    <H2>Reservar Salon Eventos</H2>
    <div class="columnas">
        <div class="container">
            <h1>LINEAMIENTOS PARA USO DEL SALON DE EVENTOS</h1>
            <p>El horario para el uso del salón de eventos, son de 9:00 a 14:00hrs y/o de 17:00 a 22:00 hrs.</p>
            <p>El propietario es el encargado de poner y quitar la decoración de acuerdo con el evento que tenga
                programado.</p>
            <p>El aforo máximo al salón de eventos es de 50 personas.
            <p>La renta del salón incluye 5 mesas para 10 personas y 50 sillas plegables, tarja, conexiones a
                electricidad, baño para hombres, baño para mujeres, lavabo.</p>
            <p>Se cobra por concepto de RENTA DE SALON, la cantidad de $2,500.00 (Dos mil quinientos pesos 00/100 M.N),
                de los cuales $1,000.00 son deposito por alguna avería a las instalaciones, los cuales se reembolsan al
                propietario una vez verificado que no haya averías en las instalaciones.</p>
            <p>El propietario es el responsable de entregar el salón con las mesas y sillas limpias y cerradas.</p>
            <p>El propietario debe dejar libre de basura y/o decoración en el salón de eventos; en caso, de NO regresar
                en las condiciones de limpieza, no se reembolsa la cantidad de depósito, ya que se tendría que pagar por
                el servicio de limpieza y acomodo de las mesas y sillas.</p>
            <p>Los invitados al evento NO pueden utilizar las áreas como ludoteca y gimnasio o andar paseando dentro de
                las instalaciones del condominio.</p>
            <p>No hay acceso a estacionamiento a autos que no sean condóminos.</p>

        </div>
        <div class="container mt-5">
            <!-- Encabezado y carrusel -->
            <div id="carouselExample" class="carousel slide mb-4" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://via.placeholder.com/800x200" class="d-block w-100" alt="Imagen 1">
                    </div>
                    <div class="carousel-item">
                        <img src="https://via.placeholder.com/800x200" class="d-block w-100" alt="Imagen 2">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <!-- Formulario -->
            <h3>Salón de eventos</h3>
            <form>
                <div class="mb-3">
                    <label for="cantidadPersonas" class="form-label">Cantidad de personas</label>
                    <input type="number" class="form-control" id="cantidadPersonas" max="50"
                        placeholder="Máximo 50 personas">
                </div>
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" class="form-control" id="fecha">
                </div>
                <div class="mb-3">
                    <label for="turno" class="form-label">Turno</label>
                    <select class="form-select" id="turno">
                        <option selected>Selecciona un turno</option>
                        <option value="Mañana">Mañana</option>
                        <option value="Tarde">Tarde</option>
                        <option value="Noche">Noche</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="detallesEvento" class="form-label">Detalles del evento</label>
                    <input type="text" class="form-control" id="detallesEvento" maxlength="15"
                        placeholder="Máximo 15 caracteres">
                </div>
                <div class="mb-3">
                    <label for="tipoEvento" class="form-label">Tipo de evento</label>
                    <select class="form-select" id="tipoEvento" onchange="toggleOtroInput()">
                        <option selected>Selecciona...</option>
                        <option value="Graduación">Graduación</option>
                        <option value="Cumpleaños">Cumpleaños</option>
                        <option value="Despedida de solter@">Despedida de solter@</option>
                        <option value="Bautizo">Bautizo</option>
                        <option value="Aniversario">Aniversario</option>
                        <option value="Boda">Boda</option>
                        <option value="Religión">Religión</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
                <div class="mb-3 d-none" id="otroEventoDiv">
                    <label for="otroEvento" class="form-label">Especifica el tipo de evento</label>
                    <input type="text" class="form-control" id="otroEvento">
                </div>
                <div class="mb-3">
                    <label for="fotoEvento" class="form-label">Foto para el evento</label>
                    <input type="file" class="form-control" id="fotoEvento">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="aceptoReglas">
                    <label class="form-check-label" for="aceptoReglas">Acepto las reglas de este salón de
                        eventos</label>
                </div>
            </form>

            <button class="btn btn-primary w-100" onclick="reservar()">Reservar</button>

        </div>
    </div>
    <script>
        function toggleOtroInput() {
            const tipoEvento = document.getElementById('tipoEvento').value;
            const otroEventoDiv = document.getElementById('otroEventoDiv');
            if (tipoEvento === 'Otro') {
                otroEventoDiv.classList.remove('d-none');
            } else {
                otroEventoDiv.classList.add('d-none');
            }
        }
    </script>
</body>
<script>
    function reservar(){
        success("Reservado con éxito", "Su evento se ha registrado exitosamente");
    }
    function success(title, text){
        Swal.fire({
        title: title,
        text: text,
        icon: "success"
});
    }
</script>
</html>