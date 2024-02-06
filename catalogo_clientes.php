<?php
session_name('demoUI');
session_start();

// Comprobar si existen las variables de SESSION.
if(empty($_SESSION['userNombre']))
{
    header('Location: /sistema_facturacion');
}else{
// Es utilizando en templateEngine.inc.php
$root = '';
    include('includes/templateEngine.inc.php');

    $twig->display('layout-catalogo-clientes.html',array(
        "userName" => $_SESSION['userNombre'],
        "userID" => $_SESSION['userID'],
        "codigo_perfil" => $_SESSION['codigo_perfil'],
        "codigo_personal" => $_SESSION['codigo_personal'],
        "logo_uno" => $_SESSION['logo_uno'],
        "nombre_institucion" => $_SESSION['institucion'],
        "nombre_personal" => $_SESSION['nombre_personal'],
        "nombre_perfil" => $_SESSION['nombre_perfil']
    ));
}
?>