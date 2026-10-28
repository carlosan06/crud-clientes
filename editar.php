<?php
require_once "models/Cliente.php";

$titulo = "Editar cliente";
$textoBoton = "Actualizar";
$errores = [];

// READ: se busca el cliente a editar
$cliente = Cliente::buscarPorId($_GET["id"] ?? 0);

if ($cliente === null) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Se modifican los atributos del objeto con los setters
    $cliente->setCedula($_POST["cedula"] ?? "");
    $cliente->setNombres($_POST["nombres"] ?? "");
    $cliente->setApellidos($_POST["apellidos"] ?? "");
    $cliente->setEmail($_POST["email"] ?? "");
    $cliente->setTelefono($_POST["telefono"] ?? "");
    $cliente->setDireccion($_POST["direccion"] ?? "");

    $errores = $cliente->validar();

    if (empty($errores)) {
        try {
            // UPDATE
            $cliente->actualizar();
            header("Location: index.php?mensaje=actualizado");
            exit;
        } catch (PDOException $e) {
            $errores[] = $e->getCode() == 23000
                ? "Ya existe otro cliente con esa cédula."
                : "Error al actualizar el cliente.";
        }
    }
}

require "includes/header.php";
?>

<h2>Editar cliente: <?= htmlspecialchars($cliente->getNombreCompleto()) ?></h2>
<?php require "includes/formulario.php"; ?>

<?php require "includes/footer.php"; ?>
