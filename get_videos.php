<?php
require('includes/dbconnection.php');
if(isset($_POST['start'])) {
    $start = mysqli_real_escape_string($conn, $_POST['start']);
    $sql = "SELECT * FROM videos LIMIT $start, 5";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0) {
        $html = "";
        while($row = mysqli_fetch_assoc($res) ) {
                $sno = $row["sno"];
                $id = "three-dots$sno";
                $likeCookie = isset($_COOKIE['dhabalikes'. $sno]) ? "red" : "grey";
                $moonCookie = isset($_COOKIE['dhabamoons' . $sno]) ? "#d19208" : "grey";
                $html .= 
                '<div class="d-flex flex-column flex-lg-row">
                    <div class="video d-flex flex-column flex-grow-1">
                        <video controls>
                            <source src="./uploads/' . $row['path'] . '" type="video/mp4">
                        </video>
                        <div class="collapse" id=' . $id . '>
                            <div class="card card-body mx-auto">
                            <h3>' . $row['title'] . '</h3>' . $row['description'] . '
                            </div>
                        </div>
                    </div>
                    <div class="video-details d-flex flex-sm-row flex-md-row flex-lg-column-reverse justify-content-between">
                        <button class="three-dot border-0" type="button" data-bs-toggle="collapse" data-bs-target=#' . $id . ' aria-controls="three-dots"><i class="bi bi-three-dots"></i></button>
                        <button class="heart-icon border-0 mt-3"><i class="bi bi-heart-fill" ></i><p class="count" id='. $row['sno'] .' style="color:grey!important">'. $row['likes'] .'</p></button>
                        <button class="half-moon-icon border-0 mt-3"><i class="bi bi-moon-fill"></i><p class="count" id='. $row['sno'] .' style="color:grey!important">'. $row['moons'] .'</p></button>
                        <a class="btn border-secondary download-now mt-3 text-nowrap" role="button" download href=' . "uploads/" . $row["path"] . '><i class="bi bi-download"></i> Download Now</a>
                        <a href="sms:'. $row['phone'] .'" class="btn btn-sm share-icon mt-3"><i class="bi bi-share-fill"></i></a>
                        <a href="tel:'. $row['phone'] .'" class="btn btn-sm call-icon border-0 mt-3"><i class="bi bi-telephone"></i></a>
                        <a href="https://wa.me/'. $row['phone'] .'" class="btn btn-sm whatsapp border-0 mt-3"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div><hr>';
            
        }
        echo $html;
    }
}

?>