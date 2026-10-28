<?php
require_once __DIR__ . "/../config/Database.php";

// Clase Cliente: representa a un cliente y contiene los métodos del CRUD
class Cliente
{
    // Atributos privados (encapsulamiento)
    private $id;
    private $cedula;
    private $nombres;
    private $apellidos;
    private $email;
    private $telefono;
    private $direccion;

    // Constructor
    public function __construct($cedula = "", $nombres = "", $apellidos = "", $email = "", $telefono = "", $direccion = "", $id = null)
    {
        $this->id = $id;
        $this->cedula = trim($cedula);
        $this->nombres = trim($nombres);
        $this->apellidos = trim($apellidos);
        $this->email = trim($email);
        $this->telefono = trim($telefono);
        $this->direccion = trim($direccion);
    }

    // Getters
    public function getId() { return $this->id; }
    public function getCedula() { return $this->cedula; }
    public function getNombres() { return $this->nombres; }
    public function getApellidos() { return $this->apellidos; }
    public function getEmail() { return $this->email; }
    public function getTelefono() { return $this->telefono; }
    public function getDireccion() { return $this->direccion; }

    // Setters
    public function setCedula($cedula) { $this->cedula = trim($cedula); }
    public function setNombres($nombres) { $this->nombres = trim($nombres); }
    public function setApellidos($apellidos) { $this->apellidos = trim($apellidos); }
    public function setEmail($email) { $this->email = trim($email); }
    public function setTelefono($telefono) { $this->telefono = trim($telefono); }
    public function setDireccion($direccion) { $this->direccion = trim($direccion); }

    // Devuelve el nombre completo del cliente
    public function getNombreCompleto()
    {
        return $this->nombres . " " . $this->apellidos;
    }

    // Valida los datos antes de guardar. Devuelve una lista de errores
    public function validar()
    {
        $errores = [];

        if (!preg_match("/^[0-9]{10}$/", $this->cedula)) {
            $errores[] = "La cédula debe tener 10 dígitos.";
        }
        if ($this->nombres === "") {
            $errores[] = "Los nombres son obligatorios.";
        }
        if ($this->apellidos === "") {
            $errores[] = "Los apellidos son obligatorios.";
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errores[] = "El correo electrónico no es válido.";
        }
        if ($this->telefono !== "" && !preg_match("/^[0-9]{7,10}$/", $this->telefono)) {
            $errores[] = "El teléfono debe tener entre 7 y 10 dígitos.";
        }

        return $errores;
    }

    // CREATE: inserta el cliente en la base de datos
    public function crear()
    {
        $sql = "INSERT INTO clientes (cedula, nombres, apellidos, email, telefono, direccion)
                VALUES (?, ?, ?, ?, ?, ?)";
        $consulta = Database::conectar()->prepare($sql);
        $consulta->execute([$this->cedula, $this->nombres, $this->apellidos, $this->email, $this->telefono, $this->direccion]);
        $this->id = Database::conectar()->lastInsertId();
        return true;
    }

    // READ: devuelve todos los clientes como objetos Cliente
    public static function listar()
    {
        $consulta = Database::conectar()->query("SELECT * FROM clientes ORDER BY apellidos, nombres");
        $clientes = [];
        foreach ($consulta->fetchAll() as $fila) {
            $clientes[] = self::desdeFila($fila);
        }
        return $clientes;
    }

    // READ: busca un cliente por su id. Devuelve null si no existe
    public static function buscarPorId($id)
    {
        $consulta = Database::conectar()->prepare("SELECT * FROM clientes WHERE id = ?");
        $consulta->execute([$id]);
        $fila = $consulta->fetch();
        return $fila ? self::desdeFila($fila) : null;
    }

    // UPDATE: actualiza los datos del cliente
    public function actualizar()
    {
        $sql = "UPDATE clientes
                SET cedula = ?, nombres = ?, apellidos = ?, email = ?, telefono = ?, direccion = ?
                WHERE id = ?";
        $consulta = Database::conectar()->prepare($sql);
        return $consulta->execute([$this->cedula, $this->nombres, $this->apellidos, $this->email, $this->telefono, $this->direccion, $this->id]);
    }

    // DELETE: elimina el cliente de la base de datos
    public function eliminar()
    {
        $consulta = Database::conectar()->prepare("DELETE FROM clientes WHERE id = ?");
        return $consulta->execute([$this->id]);
    }

    // Convierte una fila de la base de datos en un objeto Cliente
    private static function desdeFila($fila)
    {
        return new Cliente(
            $fila["cedula"],
            $fila["nombres"],
            $fila["apellidos"],
            $fila["email"],
            $fila["telefono"] ?? "",
            $fila["direccion"] ?? "",
            $fila["id"]
        );
    }
}
