<?php
require_once "models/Cliente.php";

$titulo = "Nuevo cliente";
$textoBoton = "Guardar";
$cliente = new Cliente();
$errores = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Se crea el objeto Cliente con los datos del formulario
    $cliente = new Cliente(
        $_POST["cedula"] ?? "",
        $_POST["nombres"] ?? "",
        $_POST["apellidos"] ?? "",
        $_POST["email"] ?? "",
        $_POST["telefono"] ?? "",
        $_POST["direccion"] ?? ""
    );

    $errores = $cliente->validar();

    if (empty($errores)) {
        try {
            // CREATE
            $cliente->crear();
            header("Location: index.php?mensaje=creado");
            exit;
        } catch (PDOException $e) {
            $errores[] = $e->getCode() == 23000
                ? "Ya existe un cliente con esa cédula."
                : "Error al guardar el cliente.";
        }
    }
}

require "includes/header.php";
?>

<h2>Nuevo cliente</h2>
<?php require "includes/formulario.php"; ?>

<?php require "includes/footer.php"; ?>
