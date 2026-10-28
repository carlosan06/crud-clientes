<?php // Formulario compartido por crear.php y editar.php. Usa las variables $cliente, $errores y $textoBoton ?>
<?php if (!empty($errores)): ?>
    <div class="alerta error">
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post" class="formulario">
    <label>Cédula *
        <input type="text" name="cedula" maxlength="10" value="<?= htmlspecialchars($cliente->getCedula()) ?>" required>
    </label>
    <label>Nombres *
        <input type="text" name="nombres" maxlength="100" value="<?= htmlspecialchars($cliente->getNombres()) ?>" required>
    </label>
    <label>Apellidos *
        <input type="text" name="apellidos" maxlength="100" value="<?= htmlspecialchars($cliente->getApellidos()) ?>" required>
    </label>
    <label>Correo electrónico *
        <input type="email" name="email" maxlength="100" value="<?= htmlspecialchars($cliente->getEmail()) ?>" required>
    </label>
    <label>Teléfono
        <input type="text" name="telefono" maxlength="10" value="<?= htmlspecialchars($cliente->getTelefono()) ?>">
    </label>
    <label>Dirección
        <input type="text" name="direccion" maxlength="200" value="<?= htmlspecialchars($cliente->getDireccion()) ?>">
    </label>

    <div class="acciones">
        <button type="submit" class="boton"><?= $textoBoton ?></button>
        <a href="index.php" class="boton secundario">Cancelar</a>
    </div>
</form>
