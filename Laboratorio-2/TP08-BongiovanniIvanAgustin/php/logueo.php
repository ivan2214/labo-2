
<?php

session_start();

if (!empty($_POST['username']) && !empty($_POST['password'])) {

    $usuarioForm = $_POST['username'];
    $passForm = $_POST['password'];

    if (trim($usuarioForm) == "" || trim($passForm) == "") {
        header("refresh:2;url=../index.php");
        echo '<p>Los campos no pueden estar vacios</p>';
    }

    // quitar espacios
    $usuarioForm = trim($usuarioForm);
    $passForm = trim($passForm);
    $passForm = sha1($passForm);

    require_once 'conexion.php';

    $conexion = conectar();

    if (!$conexion) {
        header("refresh:2;url=../index.php");
        echo '<p>No se ha podido conectar con la base de datos</p>';
    } else {
        $consulta = 'SELECT usuario, pass, foto, tipo FROM usuario WHERE usuario = ? AND pass = ?';

        $sentencia = mysqli_prepare($conexion, $consulta);

        mysqli_stmt_bind_param($sentencia, 'ss', $usuarioForm, $passForm);

        $q = mysqli_stmt_execute($sentencia);

        mysqli_stmt_bind_result($sentencia, $usernameDB, $passwordDB, $fotoDB,$tipoUsuarioDB);

        if ($q) {
            mysqli_stmt_fetch($sentencia);
            // solo tendran valores cuando coincidan en la busqueda sino seran vacios
            if (!empty($usernameDB) && !empty($passwordDB)) {
                $_SESSION['usuario'] = $usernameDB;
                $_SESSION['fotoUsuario'] = $fotoDB;
                $_SESSION['tipoUsuario']= $tipoUsuarioDB;
                header("refresh:0;url=articulo_listado.php");
                require_once 'encabezado.php';
                var_dump($_SESSION);
            } else {
                header("refresh:1;url=../index.php");
                echo '<p>Error usuario o contraseña incorrectos</p>';
            }
        } else {
            header("refresh:1;url=../index.php");
            echo '<p>Ocurrio un error</p>';
        }
        desconectar($conexion);
    }
} else {
    header("refresh:1;url=../index.php");
    echo '<p>Los campos no pueden estar vacios</p>';
}
