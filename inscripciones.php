<?php
$servidor="localhost";
$usuario="root";
$contrasena="";
$DB="inscripciones";

$conexion=@mysqli_connect($servidor,$usuario,$contrasena,$DB);
if(!$conexion){
    die('<h2> Fallo la conexion </h2>'.mysqli_connect_error());
}
$sql="SELECT * FROM estudiante";
$resultado=mysqli_query($conexion,$sql);

if(!$resultado){
    echo 'error no se puede consultar';
}else{
    echo '<table border="1" cellpadding="10" cellspacing="0">';
    echo '<tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Edad</th>
            <th>Grado</th>
           
        </tr>';
    while($est=mysqli_fetch_assoc($resultado)){
        echo '<tr>';
        echo '<td>'.$est['Id'].'</td>';
        echo '<td>'.$est['Nombre'].'</td>';
        echo '<td>' .$est['Apellido'].'</td>';
        echo '<td>'.$est['Edad'].'</td>';
        echo '<td>'.$est['Grado'].'</td>';
        echo '</tr>';
     
    
    }
}
$sql="SELECT * FROM padres";
$resultado=mysqli_query($conexion,$sql);

if(!$resultado){
    echo 'error no se puede consultar';
}else{
    echo '<table border="1" cellpadding="10" cellspacing="0">';
    echo '<tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Apellido </th>
            <th>Telefono</th>
            <th>Direccion</th>
           
        </tr>';
    while($row=mysqli_fetch_assoc($resultado)){
        echo '<tr>';
        echo '<td>'.$row['Id'].'</td>';
        echo '<td>'.$row['Nombre'].'</td>';
        echo '<td>' .$row['Apellido'].'</td>';
        echo '<td>'.$row['Telefono'].'</td>';
        echo '<td>'.$row['Direccion'].'</td>';
        echo '</tr>';
     
    
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Datos</title>
    <script src="jspdf.umd.min.js"></script>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px; 
        }
        th, td {
            border: 1px solid #ddd; 
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2; 
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9; 
        }
        tr:hover {
            background-color: #f1f1f1; 
        }
        h2 {
            margin-top: 20px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <h2>Datos de Estudiantes</h2>
    <?php
    
    ?>
     <h2>Datos de Padres</h2>
    <?php
    
    ?>
    

    

    <script>
        async function generarPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF({
                orientation: "portrait", 
                unit: "pt", 
                format: "letter",
            });

            doc.setFont("helvetica", "bold");
            doc.setFontSize(14);
            doc.text("Tabla de Datos", 40, 40); 

           
            const tablas = document.querySelectorAll("table");
            let y = 70; 

            tablas.forEach((tabla, tablaIndex) => {
                
                const titulo = tablaIndex === 0 ? "Datos de Estudiantes" : "Datos de Padres";
                doc.text(titulo, 40, y);
                y += 20;

                const filas = tabla.querySelectorAll("tr");
                filas.forEach((fila) => {
                    const celdas = fila.querySelectorAll("td, th");
                    let x = 40; 

                    celdas.forEach((celda) => {
                        doc.setFontSize(10);
                        doc.text(celda.innerText, x, y, { maxWidth: 500 }); // Ajustar ancho máximo
                        x += 100; 
                    });

                    y += 20; 
                });

                y += 30; 
            });

           
            doc.save("Tabla_de_Datos.pdf");
        }
    </script>
    <button onclick="generarPDF()">Descargar PDF</button>
</body>
</html>











