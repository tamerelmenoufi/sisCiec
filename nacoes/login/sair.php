<?php

session_start();
// Eliminar todas as vari�veis de sess�o.
$_SESSION = array();
// Finalmente, destrui��o da sess�o.
session_destroy();

echo "<script>window.location.href='index.php'</script>";

?>