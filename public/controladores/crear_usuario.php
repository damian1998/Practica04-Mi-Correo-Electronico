<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Crear Nuevo Usuario</title>
    <style type="text/css" rel="stylesheet">
    .error {
        color: red;
    }
    </style>
</head>

<body>
<?php
 //incluir conexión a la base de datos
 include '../../config/conexionBD.php';
 $cedula = isset($_POST["cedula"]) ? trim($_POST["cedula"]) : null;
 $nombres = isset($_POST["nombres"]) ? mb_strtoupper(trim($_POST["nombres"]), 'UTF-8') : null;
 $apellidos = isset($_POST["apellidos"]) ? mb_strtoupper(trim($_POST["apellidos"]), 'UTF-8') : null;
 $direccion = isset($_POST["direccion"]) ? mb_strtoupper(trim($_POST["direccion"]), 'UTF-8') : null;
 $telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]): null;
 $correo = isset($_POST["correo"]) ? trim($_POST["correo"]): null;
 $fechaNacimiento = isset($_POST["fechaNacimiento"]) ? trim($_POST["fechaNacimiento"]): null;
 $contrasena = isset($_POST["contrasena"]) ? trim($_POST["contrasena"]) : null;

 //APARTADO DE LA FOTO
 $fotoN=$_FILES["foto"]["name"];
 echo "Nomre archivo = $fotoN";
 $ruta=$_FILES["foto"]["tmp_name"];
 echo "Ruta = $ruta";
 
 if(empty($fotoN)){
     $destino="../../config/fotos/perfil.jpg";
 }else{
    $random_digit = rand (0000,9999);
	$new_foto = $random_digit. $fotoN;
    $ruta=$_FILES["foto"]["tmp_name"];
    echo "Ruta = $ruta";
    $destino="../../config/fotos/".$new_foto;
    $new_foto='';
    echo "destino = $destino";
    copy($ruta, $destino);
 }




 $sql = "INSERT INTO usuario() VALUES (0,'$cedula', '$nombres', '$apellidos', '$direccion', '$telefono',
 '$correo', MD5('$contrasena'), '$fechaNacimiento', 'N', null, null,'user','Yes','$destino')";
 if ($conn->query($sql) === TRUE) {
 echo "<p>Se ha creado los datos personales correctamemte!!!</p>";
 header("Location: ../vista/login.html") ;
 } else {
 if($conn->errno == 1062){
 echo "<p class='error'>La persona con la cedula $cedula ya esta registrada en el sistema </p>";
 header("Location: ../vista/crear_usuario.html") ;
 }else{
 echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
 header("Location: ../vista/crear_usuario.html") ;
 }
 }

 //cerrar la base de datos
 $conn->close();

 
?>
</body>

</html>