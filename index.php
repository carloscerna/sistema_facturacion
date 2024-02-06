<?php
session_name('demoUI');
session_start();
$_SESSION['path_root'] = trim($_SERVER['DOCUMENT_ROOT']);
// Es utilizando en templateEngine.inc.php
$root = '';

if(!empty($_SESSION) && $_SESSION['userLogin'] == true){
    include('includes/templateEngine.inc.php');

    $twig->display('layout_index.html',array(
        "userName" => $_SESSION['userNombre'],
        "userID" => $_SESSION['userID'],
        "dbname" => $_SESSION['dbname'],
        "codigo_perfil" => $_SESSION['codigo_perfil'],
        "codigo_personal" => $_SESSION['codigo_personal'],
        "logo_uno" => $_SESSION['logo_uno'],
        "nombre_institucion" => $_SESSION['institucion'],
        "nombre_personal" => $_SESSION['nombre_personal'],
        "nombre_perfil" => $_SESSION['nombre_perfil']
        ));    
}else{
    header("Location:login.php");
}
?>