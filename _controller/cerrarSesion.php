<?php
session_start();
session_unset();
session_destroy();
//TODO: Implementar cookies
header("Location: ../index.php");
