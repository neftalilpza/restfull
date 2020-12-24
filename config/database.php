<?php
class DatabaseConnection
{
    protected $db;
    protected function conexion()
    {
        $host = 'bambznit4vfjv09kqqsd-mysql.services.clever-cloud.com'; 
        $nombreDB = 'bambznit4vfjv09kqqsd';
        $usuario = 'ueekypm7c7zns9p4';
        $contraseña = 'WaIxR5ONiwaEPDhP1O0E';
        /*  dataSourceName: Tipo de base de datos */
        $dsn = 'mysql:host=' . $host . '; dbname=' . $nombreDB . ';';
        try {
            $conectar = $this->db = new PDO($dsn, $usuario, $contraseña);
            return $conectar;
        } catch (Exception $exc) {
            print("Error" . $exc->getMessage() . "</br>");
            die();
        }
    }
    public function set_name()
    {
        return $this->db->query("SET NAMES 'utf8'; ");
    }
}
?>