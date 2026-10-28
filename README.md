# CRUD de Clientes con POO en PHP

Aplicación web que usa **Programación Orientada a Objetos (POO)** en PHP para crear la clase `Cliente` y, a partir de ella, los métodos del **CRUD** (Crear, Leer, Actualizar y Eliminar) sobre una base de datos **MySQL**.

## Estructura

```
├── config/
│   └── Database.php      Clase de conexión a la base de datos (PDO)
├── models/
│   └── Cliente.php       Clase Cliente con los métodos del CRUD
├── includes/             Cabecera, pie y formulario compartidos
├── css/styles.css        Estilos
├── index.php             Listado de clientes (Read)
├── crear.php             Nuevo cliente (Create)
├── editar.php            Editar cliente (Update)
├── eliminar.php          Eliminar cliente (Delete)
└── database.sql          Script de la base de datos
```

## La clase Cliente

| Elemento | Descripción |
|---|---|
| Atributos privados | `id`, `cedula`, `nombres`, `apellidos`, `email`, `telefono`, `direccion` |
| Constructor | `__construct(...)` inicializa el objeto |
| Getters y setters | `getNombres()`, `setNombres()`, etc. (encapsulamiento) |
| `validar()` | Revisa cédula, nombres, apellidos, correo y teléfono |
| `crear()` | **Create**: inserta el cliente |
| `listar()` | **Read**: devuelve todos los clientes como objetos `Cliente` |
| `buscarPorId($id)` | **Read**: devuelve un cliente |
| `actualizar()` | **Update**: guarda los cambios del cliente |
| `eliminar()` | **Delete**: elimina el cliente |

Ejemplo de uso:

```php
$cliente = new Cliente("1700000004", "Pedro", "Mena", "pedro@ejemplo.com");
$cliente->crear();

$cliente->setTelefono("0991112222");
$cliente->actualizar();

$cliente->eliminar();
```

Las consultas usan sentencias preparadas de PDO para evitar inyección SQL.

## Instalación de dependencias

Para desarrollar la tarea se instalaron las siguientes herramientas. El equipo usado es macOS, por lo que la instalación se hizo con **Homebrew**.

| Herramienta | Versión instalada | Uso en el proyecto |
|---|---|---|
| [PHP](https://www.php.net/downloads) | 8.5 | Lenguaje de la aplicación (con la extensión `pdo_mysql`) |
| [MariaDB](https://mariadb.org/) (compatible con MySQL) | 12.3 | Base de datos |
| [Git](https://git-scm.com/) | — | Control de versiones |
| [Visual Studio Code](https://code.visualstudio.com/) | — | Editor de código |

### Paso 1: Instalar PHP

```bash
brew install php
```

### Paso 2: Instalar e iniciar la base de datos

```bash
brew install mariadb
brew services start mariadb
```

### Paso 3: Verificar la instalación

```bash
php -v
mysql --version
```

### Paso 4: Crear la base de datos

```bash
mysql < database.sql
```

Si pide usuario, usar `sudo mysql -u root < database.sql`. El script crea la base `crud_clientes`, la tabla `clientes`, tres clientes de ejemplo y el usuario `crud_user` que usa la aplicación (configurado en `config/Database.php`).

> En Windows se puede usar [XAMPP](https://www.apachefriends.org/), que incluye PHP y MySQL. El script `database.sql` se importa desde phpMyAdmin.

## Ejecución

```bash
php -S localhost:8000
```

Abrir en el navegador: `http://localhost:8000`
