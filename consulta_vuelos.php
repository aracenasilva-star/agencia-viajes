<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Paquetes de Vuelos y Hoteles</title>
    <link rel="stylesheet" href="estilos.css"> 
</head>
<body>
    <h2>Paquetes disponibles (Vuelos + Hoteles)</h2>

    <form method="POST" action="">
        <label for="fecha">Selecciona fecha:</label>
        <input type="date" id="fecha" name="fecha" required>
        <input type="submit" value="Buscar paquetes">
    </form>

    <table>
        <tr>
            <th>Origen</th>
            <th>Destino</th>
            <th>Fecha</th>
            <th>Plazas Vuelo</th>
            <th>Precio Vuelo</th>
            <th>Hotel</th>
            <th>Ubicación</th>
            <th>Habitaciones</th>
            <th>Tarifa/Noche</th>
        </tr>
        <?php
        include("conexion.php");

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fecha = $_POST["fecha"];

            try {
                $sql = "SELECT V.origen, V.destino, V.fecha, V.plazas_disponibles, V.precio AS precio_vuelo,
                               H.nombre AS hotel, H.ubicacion, H.habitaciones_disponibles, H.tarifa_noche
                        FROM VUELO V
                        JOIN HOTEL H
                        WHERE V.fecha = :fecha
                          AND V.plazas_disponibles < 5
                          AND H.habitaciones_disponibles > 2";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([":fecha" => $fecha]);

                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch()) {
                        $clase = ($row['plazas_disponibles'] <= 2) ? "highlight" : "";
                        echo "<tr class='$clase'>";
                        echo "<td>" . htmlspecialchars($row['origen']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['destino']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['fecha']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['plazas_disponibles']) . "</td>";
                        echo "<td>$" . htmlspecialchars($row['precio_vuelo']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['hotel']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['ubicacion']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['habitaciones_disponibles']) . "</td>";
                        echo "<td>$" . htmlspecialchars($row['tarifa_noche']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No hay paquetes disponibles para esa fecha.</td></tr>";
                }
            } catch (PDOException $e) {
                echo "<tr><td colspan='9'>❌ Error en la consulta: " . $e->getMessage() . "</td></tr>";
            }
        }
        ?>
    </table>
</body>
</html>

