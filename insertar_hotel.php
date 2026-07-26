<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $ubicacion = $_POST["ubicacion"];
    $habitaciones = $_POST["habitaciones"];
    $tarifa = $_POST["tarifa"];

    if (!empty($nombre) && !empty($ubicacion) && $habitaciones > 0 && $tarifa > 0) {
        try {
            $sql = "INSERT INTO HOTEL (nombre, ubicacion, habitaciones_disponibles, tarifa_noche) 
                    VALUES (:nombre, :ubicacion, :habitaciones, :tarifa)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ":nombre" => $nombre,
                ":ubicacion" => $ubicacion,
                ":habitaciones" => $habitaciones,
                ":tarifa" => $tarifa
            ]);
            echo "✅ Hotel registrado correctamente.";
        } catch (PDOException $e) {
            echo "❌ Error: " . $e->getMessage();
        }
    } else {
        echo "⚠️ Datos inválidos.";
    }
}
?>
