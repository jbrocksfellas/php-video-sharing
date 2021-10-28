<?php

require('./includes/dbconnection.php');
$table = "videos";
$sql = "SELECT * FROM `$table`";
$result = mysqli_query($conn, $sql);

include('includes/header.php');
?>

<div class="logo my-2"><img src="static/images/logo.png" width="100px"></div>
<div class="container">
</div>
<div class="loader-ellips">
    <span class="loader-ellips__dot"></span>
    <span class="loader-ellips__dot"></span>
    <span class="loader-ellips__dot"></span>
    <span class="loader-ellips__dot"></span>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');

?>