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
                $html .= 
                '<div class="d-flex flex-column flex-lg-row">
                    <div class="video d-flex flex-column justify-content-center flex-grow-1">
                        <video controls>
                            <source src="./uploads/mov_bbb.mp4" type="video/mp4">
                        </video>
                        <div class="collapse" id=' . $id . '>
                            <div class="card card-body mx-auto">
                            Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates teh relevant trigger. 
                            </div>
                        </div>
                    </div>       
                    <div class="video-details d-flex flex-sm-row flex-md-row flex-lg-column-reverse justify-content-between mb-2">
                        <button class="three-dot border-0" type="button" data-bs-toggle="collapse" data-bs-target=#' . $id . ' aria-controls="three-dots"><i class="bi bi-three-dots"></i></button>
                        <button class="heart-icon border-0 mt-3" ><i class="bi bi-heart-fill" ></i></button>
                        <button class="half-moon-icon border-0 mt-3"><i class="bi bi-moon-fill"></i></button>
                        <a class="btn border-secondary download-now mt-3" role="button" download href=' . "uploads/" . $row["path"] . '><i class="bi bi-download"></i> Download Now</a>
                        <a class="btn btn-sm share-icon mt-3"><i class="bi bi-share-fill"></i></a>
                        <a href="tel:+919625926328" class="btn btn-sm call-icon border-0 mt-3"><i class="bi bi-telephone"></i></a>
                        <a href="https://wa.me/9625926328" class="btn btn-sm whatsapp border-0 mt-3"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div><hr>';
            
        }
        echo $html;
    }
}

?>