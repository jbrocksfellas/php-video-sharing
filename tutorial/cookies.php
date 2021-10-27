<?php

echo "Welcome to the world of cookie<br>";

setcookie("category", "Books", time() + 86400, "/");
echo "The cookie is set";

?>