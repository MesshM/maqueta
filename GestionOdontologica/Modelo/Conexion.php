<?php
class Conexion {
    private $conexion;
    private $configuracion = [
        "host" => "localhost",
        "database" => "citas",  
        "user" => "root",       
        "password" => ""        
    ];

    public function __construct() {
        $this->conexion = new mysqli(
            $this->configuracion['host'],
            $this->configuracion['user'],
            $this->configuracion['password'],
            $this->configuracion['database']
        );

        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }

        $this->conexion->set_charset("utf8");
    }

    public function consulta($sql) {
        $resultado = $this->conexion->query($sql);
        if (!$resultado) {
            echo "Error en la consulta: " . $this->conexion->error;
            return false;
        }
        return $resultado;
    }

    public function obtenerFilasAfectadas() {
        return $this->conexion->affected_rows;
    }

    public function obtenerResult() {
        return $this->conexion->store_result();
    }

    public function obtenerCitaId() {
        return $this->conexion->insert_id;
    }

    public function cerrar() {
        $this->conexion->close();
    }
}