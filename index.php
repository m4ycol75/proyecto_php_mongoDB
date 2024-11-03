<?php
require_once __DIR__ . '/includes/functions.php';
require_once("../mistareas/vendor/autoload.php");
if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
    $count = eliminarInfraccion($_GET['id']);
    $mensaje = $count > 0 ? "Infraccion eliminada con éxito." : "No se pudo eliminar la Infraccion."."<br><br>";
}

$Infracciones = obtenerInfracciones();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Infracciones</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>

<body>
    <div class="container">
        <h1 align="center">Gestión de Infracciones de Transito</h1>

        <?php if (isset($mensaje)): ?>
            <div class="<?php echo $count > 0 ? 'success' : 'error'; ?>">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <a href="agregar_infraccion.php" class="button">Agregar Nueva Infraccion</a>

        <h2>Lista de Infraciones</h2>
        <!-- ... -->

        <table>
            <tr>
                <th>Infraccion</th>
                <th>Descripción</th>
                <th>Consto de Infracción</th>
                <th>Fecha de Infraccion</th>
                <th>Infraccion Cancelada</th>
                <th>Acciones</th>
                <th>Reporte de Infraccion</th>
            </tr>
            <?php foreach ($Infracciones as $Infraccion): ?>
                <tr>
                    <td><?php echo htmlspecialchars($Infraccion['infraccion']); ?></td>
                    <td><?php echo htmlspecialchars($Infraccion['descripcion']); ?></td>
                    <td><?php echo "S/.".htmlspecialchars($Infraccion['costo_infraccion']); ?></td>
                    <td><?php echo formatDate($Infraccion['fechaEntrega']); ?></td>
                    <td><?php echo $Infraccion['cancelado'] ? 'Sí' : 'No'; ?></td>
                    <td class="actions">
                        <a href="editar_tarea.php?id=<?php echo $Infraccion['_id']; ?>" class="button">Editar</a>
                        <a href="index.php?accion=eliminar&id=<?php echo $Infraccion['_id']; ?>" class="button" onclick="return confirm('¿Estás seguro de que quieres eliminar esta tarea?');">Eliminar <?php //if()?></a>
                    </td>
                    <td><a class="button" onclick="window.open('generar_reporte.php?id=<?php echo $Infraccion['_id']; ?>')">Generar</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>