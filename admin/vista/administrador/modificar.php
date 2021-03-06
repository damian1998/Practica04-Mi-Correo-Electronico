<?php

session_start();
if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged']===FALSE){
    header("Location: /PRACTICA04-MI-CORREO-ELECTRONICO/public/vista/login.html");
}


$consulta=ConsultarUsuario($_GET['usu_codigo']);

function ConsultarUsuario($usu_codigo){
    include '../../../config/conexionBD.php';

    $sql="SELECT * from usuario WHERE usu_codigo='".$usu_codigo."' ";
    $result=$conn->query($sql);
    $filas=$result->fetch_assoc();

    return[
        $filas['usu_codigo'],
        $filas['usu_cedula'],
        $filas['usu_nombres'],
        $filas['usu_apellidos'],
        $filas['usu_direccion'],
        $filas['usu_telefono'],
        $filas['usu_fecha_nacimiento'],
        $filas['usu_correo'],
        $filas['usu_foto'],
    
    ];

    $conn->close();
}


?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../config/styles/reset.css">
    <link rel="stylesheet" href="../../../config/styles/modificarStyles.css">
    <link rel="stylesheet" href="../../../config/styles/menuH.css">
    <title>Modificar</title>
</head>

<body>

    <div class="contenedor">


        <header>

            <div class="menu">
                <ul>
                    <li><a href="index.php">INDEX</a></li>
                </ul>
            </div>

        </header>

        <div class="container">
            <div class="form__top">
                <h2>Modificar <span>Datos</span></h2>
            </div>

            <form id="formulario02" method="POST" action="../../controladores/administrador/modificarBD.php" enctype="multipart/form-data">
                <div class="container1 ">
                    <input type="hidden" id="codigo" name="codigo" value="<?php echo $consulta[0] ?>">

                    <label for="cedula">Cedula (*)</label>
                    <input type="text" id="cedula" name="cedula" value="<?php echo $consulta[1] ?>" maxlength="10"
                        required />
                    <br>
                    <br>
                    <label for="nombres">Nombres (*)</label>
                    <input type="text" id="nombres" name="nombres" value="<?php echo $consulta[2] ?>" required />
                    <br>
                    <br>
                    <label for="apellidos">Apelidos (*)</label>
                    <input type="text" id="apellidos" name="apellidos" value="<?php echo $consulta[3] ?>" required />
                    <br>
                    <br>
                    <label for="direccion">Dirección (*)</label>
                    <input type="text" id="direccion" name="direccion" value="<?php echo $consulta[4] ?>" required />
                    <br>
                    <br>
                    <label for="telefono">Teléfono (*)</label>
                    <input type="text" id="telefono" name="telefono" value="<?php echo $consulta[5] ?>" required />
                    <br>
                    <br>
                    <label for="fecha">Fecha Nacimiento (*)</label>
                    <input type="date" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $consulta[6] ?>"
                        required />
                    <br>
                    <br>
                    <label for="correo">Correo electrónico (*)</label>
                    <input type="email" id="correo" name="correo" value="<?php echo $consulta[7] ?>" required />
                    <br>
                    <br>
                    <div class="btn_form">
                        <input class="crear" type="submit" id="crear" name="crear" value="ACEPTAR" />
                        <input class="cancelar" type="reset" id="cancelar" name="cancelar" value="CANCELAR" />
                    </div>

                </div>


                <div class="containerPicture">

                    <div class="btn_form">

                        <?php

                            $imagen='';
                            
                            if(strncmp($consulta[8],'../../../', 9) === 0   ){
                                $imagen=$consulta[8];
                           }else{
                                $imagen='../'.$consulta[8];
                           }
                        ?>


                        <img class="perfil" src='<?php echo ($imagen) ?>' alt="">
                        <br>
                        <input class="actualizar" type="file" id="foto" name="foto"
                            value="<?php echo ($imagen) ?>" />
                    </div>

                </div>

            </form>

        </div>

</body>

</html>