<?php
// Parámetros de conexión
$host = "localhost";
$dbname = "AGENCIA";
$username = "root";   // Cambia según tu configuración
$password = "";       // Cambia según tu configuración

try {
    // Conexión con PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Configurar atributos de seguridad
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    echo "✅ Conexión establecida correctamente a la base de datos AGENCIA.";
} catch (PDOException $e) {
    echo "❌ Error en la conexión: " . $e->getMessage();
    exit;
}
?>
