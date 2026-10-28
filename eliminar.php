<?php
require_once "models/Cliente.php";

// Solo se permite eliminar mediante POST (desde el botón del listado)
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$cliente = Cliente::buscarPorId($_POST["id"] ?? 0);

if ($cliente !== null) {
    // DELETE
    $cliente->eliminar();
}

header("Location: index.php?mensaje=eliminado");
exit;
