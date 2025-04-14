<?php
// Habilitar la depuración de errores
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Configuración de la conexión a la base de datos
$servername = "localhost"; // Normalmente "localhost" en cPanel
$username = "elchatca"; // Tu nombre de usuario de base de datos
$password = "Dkk—||ROPjK45!!##|°``}}%%—"; // La contraseña de tu base de datos
$dbname = "elchatca_AGENCIA"; // El nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agencia de Viajes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #333;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: 20px auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #333;
            color: white;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .form-container input, .form-container select, .form-container button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .button-container {
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

<header>
    <h1>Bienvenido a la Agencia de Viajes</h1>
</header>

<div class="container">
    <!-- Formulario para añadir vuelos -->
    <div class="form-container">
        <h2>Agregar un Vuelo</h2>
        <form action="agencias.php" method="POST">
            <label for="origen">Origen:</label>
            <input type="text" name="origen" id="origen" required>
            <label for="destino">Destino:</label>
            <input type="text" name="destino" id="destino" required>
            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" id="fecha" required>
            <label for="plazas">Plazas Disponibles:</label>
            <input type="number" name="plazas" id="plazas" required>
            <label for="precio">Precio:</label>
            <input type="number" name="precio" id="precio" step="0.01" required>
            <button type="submit" name="agregar_vuelo">Agregar Vuelo</button>
        </form>
    </div>

    <!-- Formulario para añadir hoteles -->
    <div class="form-container">
        <h2>Agregar un Hotel</h2>
        <form action="index.php" method="POST">
            <label for="nombre_hotel">Nombre del Hotel:</label>
            <input type="text" name="nombre_hotel" id="nombre_hotel" required>
            <label for="ubicacion">Ubicación:</label>
            <input type="text" name="ubicacion" id="ubicacion" required>
            <label for="habitaciones">Habitaciones Disponibles:</label>
            <input type="number" name="habitaciones" id="habitaciones" required>
            <label for="tarifa">Tarifa por Noche:</label>
            <input type="number" name="tarifa" id="tarifa" step="0.01" required>
            <button type="submit" name="agregar_hotel">Agregar Hotel</button>
        </form>
    </div>

    <!-- Botones para mostrar los vuelos y hoteles -->
    <div class="button-container">
        <form action="agencias.php" method="GET">
            <button type="submit" name="mostrar_vuelos">Mostrar Vuelos</button>
            <button type="submit" name="mostrar_hoteles">Mostrar Hoteles</button>
        </form>
    </div>

    <!-- Mostrar la lista de vuelos -->
    <?php
    if (isset($_GET['mostrar_vuelos'])) {
        echo "<h2>Lista de Vuelos Disponibles</h2>";
        echo "<table><thead><tr><th>Origen</th><th>Destino</th><th>Fecha</th><th>Plazas Disponibles</th><th>Precio</th></tr></thead><tbody>";
        
        // Mostrar los vuelos disponibles
        $sql_vuelos = "SELECT * FROM VUELO";
        $result_vuelos = $conn->query($sql_vuelos);
        if ($result_vuelos->num_rows > 0) {
            while ($row = $result_vuelos->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["origen"] . "</td>
                        <td>" . $row["destino"] . "</td>
                        <td>" . $row["fecha"] . "</td>
                        <td>" . $row["plazas_disponibles"] . "</td>
                        <td>" . $row["precio"] . "€</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No hay vuelos disponibles</td></tr>";
        }
        echo "</tbody></table>";
    }
    ?>

    <!-- Mostrar la lista de hoteles -->
    <?php
    if (isset($_GET['mostrar_hoteles'])) {
        echo "<h2>Lista de Hoteles Disponibles</h2>";
        echo "<table><thead><tr><th>Nombre</th><th>Ubicación</th><th>Habitaciones Disponibles</th><th>Tarifa por Noche</th></tr></thead><tbody>";
        
        // Mostrar los hoteles disponibles
        $sql_hoteles = "SELECT * FROM HOTEL";
        $result_hoteles = $conn->query($sql_hoteles);
        if ($result_hoteles->num_rows > 0) {
            while ($row = $result_hoteles->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["nombre"] . "</td>
                        <td>" . $row["ubicacion"] . "</td>
                        <td>" . $row["habitaciones_disponibles"] . "</td>
                        <td>" . $row["tarifa_noche"] . "€</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No hay hoteles disponibles</td></tr>";
        }
        echo "</tbody></table>";
    }
    ?>

</div>

<?php
// Insertar datos en la tabla VUELO
if (isset($_POST['agregar_vuelo'])) {
    // Sanitizar los datos antes de insertarlos
    $origen = $conn->real_escape_string($_POST['origen']);
    $destino = $conn->real_escape_string($_POST['destino']);
    $fecha = $conn->real_escape_string($_POST['fecha']);
    $plazas = (int)$_POST['plazas'];
    $precio = (float)$_POST['precio'];

    // Consulta para insertar un nuevo vuelo
    $sql_insert_vuelo = "INSERT INTO VUELO (origen, destino, fecha, plazas_disponibles, precio)
                         VALUES ('$origen', '$destino', '$fecha', '$plazas', '$precio')";

    if ($conn->query($sql_insert_vuelo) === TRUE) {
        echo "Nuevo vuelo agregado correctamente.";
    } else {
        echo "Error: " . $sql_insert_vuelo . "<br>" . $conn->error;
    }
}

// Insertar datos en la tabla HOTEL
if (isset($_POST['agregar_hotel'])) {
    // Sanitizar los datos antes de insertarlos
    $nombre_hotel = $conn->real_escape_string($_POST['nombre_hotel']);
    $ubicacion = $conn->real_escape_string($_POST['ubicacion']);
    $habitaciones = (int)$_POST['habitaciones'];
    $tarifa = (float)$_POST['tarifa'];

    // Consulta para insertar un nuevo hotel
    $sql_insert_hotel = "INSERT INTO HOTEL (nombre, ubicacion, habitaciones_disponibles, tarifa_noche)
                         VALUES ('$nombre_hotel', '$ubicacion', '$habitaciones', '$tarifa')";

    if ($conn->query($sql_insert_hotel) === TRUE) {
        echo "Nuevo hotel agregado correctamente.";
    } else {
        echo "Error: " . $sql_insert_hotel . "<br>" . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>

</body>
</html>
