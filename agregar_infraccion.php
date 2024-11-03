<?php
require_once __DIR__ . '/includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = crearInfraccion($_POST['infraccion'], $_POST['descripcion'], $_POST['costo_infraccion'], $_POST['fechaEntrega']);
    if ($id) {
        header("Location: index.php");
        exit;
    } else {
        $error = "No se pudo crear la tarea.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nueva Infraccion</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>

<body>
    <div class="container">
        <h1>Agregar Nueva Infraccion</h1>

        <?php if (isset($error)) : ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST">
            <label>Infraccion: <input type="text" name="infraccion" required></label><br>
            <label>Descripción: <textarea name="descripcion" required></textarea></label><br>
            <label>Costo de Infraccion: <input type="number" name="costo_infraccion" required></label><br>
            <label>Fecha de Entrega: <input type="date" name="fechaEntrega" required></label><br>
            <input type="submit" value="Generar Infraccion">
        </form>

        <a href="index.php">Volver a la lista de Infracciones</a>
    </div>
</body>

</html>