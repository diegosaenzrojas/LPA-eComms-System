<?php
require_once '../includes/auth.php';

if (!isAuthenticated()) {
    header('Location: access_denied.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Inicio</title></head>
<body>
    <h1>Bienvenido, <?= $_SESSION['userName'] ?></h1>
    <p>Grupo: <?= $_SESSION['userGroup'] ?></p>
    <p>Estado: <?= $_SESSION['userStatus'] === 'A' ? 'Activo' : 'Inactivo' ?></p>

    <?php if (isAdmin()) echo "<p>Acceso administrativo habilitado.</p>"; ?>
</body>
</html>