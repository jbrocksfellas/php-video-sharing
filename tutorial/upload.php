<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>upload</title>
</head>

<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $file = $_POST['file'];
        $description = $_POST['description'];
        
        require('./includes/dbconnection.php');
        
        if (!$conn) {
            die("Sorry we failed to connect: " . mysqli_connect_error());
        } else {
            // submit to the database
            $sql = "INSERT INTO `videos` (`name`, `description`, `path`, `likes`, `date`) VALUES ('$title', '$description', '$file', '5', current_timestamp())";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "form submitted successfully";
            } else {
                echo "table not created successfully" . mysqli_error($conn);
            }
        }
    }
    ?>
    <h2>Upload a video</h2>
    <form action="/lbproject/upload.php" method="post" id="uploadform">
        title<input type="text" name="title"><br>

        file<input type="file" name="file" id="file"><br>
        <textarea name="description">Enter text here...</textarea><br>
        <button type="submit">submit</button>
    </form>

</body>

</html>