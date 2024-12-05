<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Invitados</h1>
    <div class="container mt-5">
        <!-- Botón y checkbox -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <button class="btn btn-primary">+ Agregar</button>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="verVisitasOcultas">
                <label class="form-check-label" for="verVisitasOcultas">Ver visitas ocultas</label>
            </div>
        </div>

        <!-- Barra de búsqueda -->
        <div class="input-group mb-4">
            <span class="input-group-text" id="search-addon">🔍</span>
            <input type="text" class="form-control" placeholder="Buscar..." aria-label="Buscar" aria-describedby="search-addon">
        </div>

        <!-- Tabla -->
        <table class="table table-bordered align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>Nombre</th>
                    <th>Horario inicio</th>
                    <th>Horario final</th>
                    <th>QR</th>
                    <th>Asunto</th>
                    <th>Número de integrantes</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" class="form-control" placeholder="Nombre"></td>
                    <td><input type="time" class="form-control"></td>
                    <td><input type="time" class="form-control"></td>
                    <td>🔲</td>
                    <td>
                        <select class="form-select">
                            <option value="">Selecciona...</option>
                            <option value="asunto1">Evento</option>
                            <option value="asunto2">Visita</option>
                        </select>
                    </td>
                    <td><input type="number" class="form-control" placeholder="0"></td>
                    <td>
                        <button class="btn btn-warning btn-sm ">Modificar</button>
                        <button class="btn btn-danger btn-sm">Ocultar</button>
                    </td>
                </tr>
                <!-- Más filas según sea necesario -->
            </tbody>
        </table>
    </div>

</body>
</html>