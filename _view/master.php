<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "Condominios | " . $ctrl->title ?></title>
    <link rel="icon" href="img/placeholder_logo.png">
    <!-- Bootstrap CSS -->
    <link href="utils/bootstrap-v5.3.2/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="utils/datatables-1.13.6/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="utils/fontawesome-free-6.7.1-web/css/all.min.css" />
    <!-- CSS principal -->
    <link rel="stylesheet" href="css/master.css" />
    <!-- CSS de cada controlador -->
    <style>
        <?php $ctrl->renderCSS() ?>
    </style>
</head>

<body>
    <div class="loader-container hidden" id="loader">
        <l-ring
            size="40"
            stroke="5"
            bg-opacity="0"
            speed="2"
            color="green"></l-ring>
        <h3>Cargando, espere un momento...</h3>
    </div>
    <!-- Navbar superior -->
    <nav class="navbar navbar-expand-lg border-bottom">
        <a href="index.php" class="navbar-brand">
            <img src="img/placeholder_logo.png" alt="Logo" width="40" height="40">
            Condominios
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                <?php foreach ($ctrl->opciones as $opcion): ?>
                    <li class="nav-item"><a class="nav-link" <?php echo 'href="' . $opcion['href'] . '"' ?>><?php echo $opcion['nombre'] ?></a></li>
                <?php endforeach ?>
            </ul>
        </div>
    </nav>
    <div class="container-fluid">
        <?php $ctrl->renderContent(); ?>
    </div>
    <footer class="py-5 border-top">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-5">
                <div class="col mb-3 text-center container-redes-sociales">
                    <h5>Siguenos</h5>
                    <a href="#" class="me-2"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" class="me-2"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="#" class="me-2"><i class="fa-brands fa-instagram"></i></a>
                </div>

                <div class="col mb-3 text-center">
                    <h5>Políticas de uso</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Aviso de privacidad</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Términos y condiciones</a></li>
                    </ul>
                </div>

                <div class="col mb-3 text-center">
                    <h5>Contactanos</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><i class="fa-solid fa-phone"></i>&nbsp;5555555555</li>
                        <li class="nav-item mb-2"><i class="fa-solid fa-phone"></i>&nbsp;5566666666</li>
                    </ul>
                </div>

                <div class="col-12 col-md-4 mb-6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1881.2732895098143!2d-99.20992246160364!3d19.431987424886835!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d2021e50a4d4db%3A0xcfaa324d96159af7!2sAv.%20Paseo%20de%20las%20Palmas%20123%2C%20Polanco%2C%20Lomas%20de%20Chapultepec%20III%20Secc%2C%20Miguel%20Hidalgo%2C%2011510%20Ciudad%20de%20M%C3%A9xico%2C%20CDMX!5e0!3m2!1ses-419!2smx!4v1733379914973!5m2!1ses-419!2smx" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="map"></iframe>
                </div>
            </div>
            <div class="container text-center">
                <hr>
                <h4>Condominios</h4>
                <p>Calle Paseo de las Palmas 123, Colonia Lomas de Chapultepec, Alcaldía Miguel Hidalgo, Ciudad de México, C.P. 11000, México</p>
            </div>
        </div>
    </footer>
    <!-- jQuery -->
    <script src="utils/jquery-v3.7.1/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="utils/bootstrap-v5.3.2/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="utils/datatables-1.13.6/jquery.dataTables.min.js"></script>
    <script src="utils/datatables-1.13.6/dataTables.bootstrap5.min.js"></script>
    <!-- SweetAlert JS -->
    <script src="utils/sweetalert2-v11.14.5/sweetalert2@11.js"></script>
    <script
        type="module"
        src="https://cdn.jsdelivr.net/npm/ldrs/dist/auto/ring.js"></script>
    <!-- JS del master -->
    <script src="js/master.js"></script>
    <!-- JS del controlador -->
    <script>
        <?php $ctrl->renderJS() ?>
    </script>
</body>

</html>