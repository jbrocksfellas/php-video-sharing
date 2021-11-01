<?php
require('includes/dbconnection.php');
if(isset($_POST['start'])) {
    $sharePath = "24dhabha.com/uploads/";
    $start = mysqli_real_escape_string($conn, $_POST['start']);
    $sql = "SELECT * FROM videos LIMIT $start, 5";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0) {
        $html = "";
        while($row = mysqli_fetch_assoc($res) ) {
                $sno = $row["sno"];
                $id = "three-dots$sno";
                $share = "share$sno";
                $likeCookie = isset($_COOKIE['dhabalikes'. $sno]) ? "red" : "grey";
                $moonCookie = isset($_COOKIE['dhabamoons' . $sno]) ? "#d19208" : "grey";
                $html .= 
                '<div class="modal fade" id=' . $share . ' tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Share</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body d-flex justify-content-center">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=https://'. $sharePath . $row["path"] .'" class="fa fa-facebook"></a>
                                <a href="https://twitter.com/intent/tweet?url=https://'. $sharePath . $row["path"] .'" class="fa fa-twitter"></a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url=https://'. $sharePath . $row["path"] .'" class="fa fa-linkedin"></a>
                                <a href="mailto:?&subject=&body=https://'. $sharePath . $row["path"] .'" class="fa fa-google"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column flex-lg-row">
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
                        <a class="btn btn-sm share-icon mt-3" data-bs-toggle="modal" data-bs-target=#' . $share . '><i class="bi bi-share-fill"></i><p class="count icon-names" style="color:grey!important">Share</p></a>
                        <a href="tel:'. $row['phone'] .'" class="btn btn-sm call-icon border-0 mt-3"><i class="bi bi-telephone"></i><p class="count icon-names" style="color:grey!important">Phone</p></a>
                        <a href="https://wa.me/'. $row['phone'] .'" class="btn btn-sm whatsapp border-0 mt-3"><i class="bi bi-whatsapp"></i><p class="count icon-names" style="color:grey!important">Whatsapp</p></a>
                    </div>
                </div><hr>';
            
        }
        echo $html;
    }
}
