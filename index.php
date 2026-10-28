<?php
require_once "models/Cliente.php";

$titulo = "Listado";
$mensajes = [
    "creado" => "Cliente creado correctamente.",
    "actualizado" => "Cliente actualizado correctamente.",
    "eliminado" => "Cliente eliminado correctamente.",
];
$mensaje = $mensajes[$_GET["mensaje"] ?? ""] ?? null;
$error = null;

// READ: se obtiene la lista de objetos Cliente
try {
    $clientes = Cliente::listar();
} catch (PDOException $e) {
    $clientes = [];
    $error = "No se pudo conectar a la base de datos. Revise que MySQL esté iniciado y que se haya ejecutado database.sql.";
}

require "includes/header.php";
?>

<div class="barra">
    <h2>Clientes registrados (<?= count($clientes) ?>)</h2>
    <a href="crear.php" class="boton">+ Nuevo cliente</a>
</div>

<?php if ($mensaje): ?>
    <div class="alerta exito"><?= htmlspecialchars($mensaje) ?></div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="alerta error"><?= htmlspecialchars($error) ?></div>
<?php elseif (count($clientes) === 0): ?>
    <p>No hay clientes registrados.</p>
<?php else: ?>
    <div class="tabla-contenedor">
        <table>
            <thead>
                <tr>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><?= htmlspecialchars($cliente->getCedula()) ?></td>
                        <td><?= htmlspecialchars($cliente->getNombreCompleto()) ?></td>
                        <td><?= htmlspecialchars($cliente->getEmail()) ?></td>
                        <td><?= htmlspecialchars($cliente->getTelefono()) ?></td>
                        <td><?= htmlspecialchars($cliente->getDireccion()) ?></td>
                        <td class="acciones">
                            <a href="editar.php?id=<?= $cliente->getId() ?>" class="boton pequeno">Editar</a>
                            <form method="post" action="eliminar.php" onsubmit="return confirm('¿Eliminar a <?= htmlspecialchars($cliente->getNombreCompleto(), ENT_QUOTES) ?>?');">
                                <input type="hidden" name="id" value="<?= $cliente->getId() ?>">
                                <button type="submit" class="boton pequeno peligro">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php require "includes/footer.php"; ?>
