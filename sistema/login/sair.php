<?php

session_start();
// Eliminar todas as variáveis de sessão.
$_SESSION = array();
// Finalmente, destruição da sessão.
session_destroy();

echo "<script>window.location.href='index.php'</script>";

?>