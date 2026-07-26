<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $origen = $_POST["origen"];
    $destino = $_POST["destino"];
    $fecha = $_POST["fecha"];
    $plazas = $_POST["plazas"];
    $precio = $_POST["precio"];

    if (!empty($origen) && !empty($destino) && !empty($fecha) && $plazas > 0 && $precio > 0) {
        try {
            $sql = "INSERT INTO VUELO (origen, destino, fecha, plazas_disponibles, precio) 
                    VALUES (:origen, :destino, :fecha, :plazas, :precio)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ":origen" => $origen,
                ":destino" => $destino,
                ":fecha" => $fecha,
                ":plazas" => $plazas,
                ":precio" => $precio
            ]);
            echo "✅ Vuelo registrado correctamente.";
        } catch (PDOException $e) {
            echo "❌ Error: " . $e->getMessage();
        }
    } else {
        echo "⚠️ Datos inválidos.";
    }
}
?>
