<?php
require_once __DIR__ . '/includes/functions.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$Infraccion = obtenerInfraccionPorId($_GET['id']);

if (!$Infraccion) {
    header("Location: index.php?mensaje=Tarea no encontrada");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $count = actualizarInfraccion($_GET['id'], $_POST['infraccion'], $_POST['descripcion'], $_POST['costo_infraccion'], $_POST['fechaEntrega'], isset($_POST['cancelado']));
    if ($count > 0) {
        header("Location: index.php?mensaje=Infraccion actualizada con éxito");
        exit;
    } else {
        $error = "No se pudo actualizar la Infraccion.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Infraccion</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>

<body>
    <div class="container">
        <h1>Editar Infraccion</h1>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <label>Infraccion: <input type="text" name="infraccion" value="<?php echo htmlspecialchars($Infraccion['infraccion']); ?>" required></label>
            <label>Descripción: <textarea name="descripcion" required><?php echo htmlspecialchars($Infraccion['descripcion']); ?></textarea></label>
            <label>Infraccion: <input type="text" name="costo_infraccion" value="<?php echo htmlspecialchars($Infraccion['costo_infraccion']); ?>" required></label>
            <label>Fecha de Emision: <input type="date" name="fechaEntrega" value="<?php echo formatDate($Infraccion['fechaEntrega']); ?>" required></label>
            <label>Infraccion Cancelada: <input type="checkbox" name="cancelado" <?php echo $Infraccion['cancelado'] ? 'checked' : ''; ?>></label>
            <input type="submit" value="Actualizar Infraccion">
        </form>
        <a href="index.php" class="button">Volver a la lista de Infracciones</a>
    </div>
</body>

</html>