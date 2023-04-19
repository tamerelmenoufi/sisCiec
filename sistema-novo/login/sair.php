<?php

session_start();
// Eliminar todas as vari�veis de sess�o.
if($_SESSION['confUnidade']) $escola = $_SESSION['confUnidade'];
$_SESSION = array();
// Finalmente, destrui��o da sess�o.
$_SESSION['confUnidade'] = $escola;
// session_destroy();

echo "<script>window.location.href='index.php'</script>";

?>