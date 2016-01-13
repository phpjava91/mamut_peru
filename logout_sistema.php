<?php

setcookie("nombre_usuario", "", time() - 3600);
setcookie("tipo_usuario", "", time() - 3600);
setcookie("id_usuario", "", time() - 3600);
header("Location: index.php");
?>