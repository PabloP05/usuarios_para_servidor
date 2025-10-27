
<?php
    require 'cargar.php';
    //creo una instancia de la clase rellenarSelect que es donde conecto con la base de datos 
    $cargar = new rellenarSelect();

    //llamo a la funcion que ejecuta la consulta en la base de datos y una vez hecho esto, lo guardo en un array
    $arrayPais = $cargar->cargarDatosSelect();
    $arrayCheck = $cargar->cargarCheckbox();
    $cargar->cerrarConexion();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulario deinamico</title>
    <link rel="stylesheet" href="stilo.css">
</head>
<body>
<form action="enviar.php" method="post">
    <!-- Usuario y contraseña -->
    <label for="usuario">Nombre de usuario:</label><br>
    <input type="text" id="usuario" name="usuario"><br><br>

    <label for="usuario">correo de usuario:</label><br>
    <input type="text" id="correo" name="correo"><br><br>

    <label for="password">Contraseña:</label><br>
    <input type="password" id="password" name="password"><br><br>

    <!-- Género -->
    <p>Género:</p>
    <input type="radio" id="masculino" name="genero" value="masculino">
    <label for="masculino">Masculino</label><br>
    <input type="radio" id="femenino" name="genero" value="femenino">
    <label for="femenino">Femenino</label><br><br>

    
    <!-- Intereses relacionados con el cambio climático -->
    <p>¿Qué temas te interesan?</p>
    <!--Los bloques de echo son los unicos que no se cambian en la vista, se mantienen siempre-->
       <?php
        foreach ($arrayCheck as $key => $value) {
            echo '<input type="checkbox" name="intereses[]" value="'.$value['checkbox'].'">';
            echo '<label for="">'.$value['checkbox'].'</label><br>';
        }
       
       ?>
    <p>Nacionalidad</p>
    <select name="paises" id="" required>
        <?php
            foreach ($arrayPais as $key=> $value) {
               echo '<option value="'.$value['pais'].'">'.$value['pais'].'</option>';
            }
        ?>
    </select>


    <!-- Aceptación de políticas -->
    <input type="checkbox" id="politicas" name="politicas" required>
    <label for="politicas">Estoy de acuerdo con las políticas de privacidad y uso</label><br><br>

    <input type="submit" value="Registrarse">
    <input type="reset" value="Reiniciar formulario">
  </form>
</body>
</html>