<?php
$servername = "localhost";
$username = "visual";
$password = "daw2324";
$dbname = "servidor";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $inserts = [
        "INSERT INTO tipotren (tipoTren, nombre) VALUES (?, ?)",
        "INSERT INTO tren (trenId, modelo, tipoTren, fechaFabricacion) VALUES (?, ?, ?, ?)",
        "INSERT INTO usuario (email, contra) VALUES (?, ?)",
        "INSERT INTO publicacion (pubId, email, trenId, titulo, posicion, comAuto) VALUES (?, ?, ?, ?, ?, ?)",
        "INSERT INTO imagen (imgId, fecha, pubId, sesion, num) VALUES (?, ?, ?, ?, ?)"
    ];

    $data = [
        // Datos para tipotren
        [1, 'Ave'],
        [2, 'Alvia'],
        [3, 'Avant'],
        [4, 'IRYO'],
        [5, 'OUIGO'],
        [6, 'LD'],
        [7, 'MD'],
        [8, 'Cercanias/Rodalies'],
        [9, 'AM'],
        // Datos para tren
        [1, 'Civia', 6, 2003],
        // Datos para usuario
        ['santiago@gmail.com', '12345'],
        // Datos para publicacion
        [1, 'santiago@gmail.com', 1, 'Primer Civia', 'Quieto', 'Andalucía'],
        [2, 'santiago@gmail.com', 1, 'Segundo Civia', 'Quieto', 'Asturias'],
        // Datos para imagen
        [3, '2003-12-11', 1, NULL, NULL],
        [4, '2003-12-11', 1, NULL, NULL],
        [5, '2003-12-11', 2, NULL, NULL],
        [6, '2003-12-11', 2, NULL, NULL],
        [7, '2023-11-11', 1, 'santi', 0],
        [8, '2023-11-11', 1, 'santi', 2],
        [9, '2023-10-10', 2, 'jose', 14]
    ];

    $conn->beginTransaction();

    foreach ($inserts as $key => $query) {
        $stmt = $conn->prepare($query);
        $stmt->execute($data[$key]);
    }

    $conn->commit();
    echo "Datos insertados correctamente.";
} catch(PDOException $e) {
    $conn->rollBack();
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
