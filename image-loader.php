<?php 

function generateGallery($datadir) {

    $folders = scandir($datadir);

    // loops through folders
    foreach($folders as $folder) {

        if (!in_array($folder, array(".", ".."))) {
            
            $filesFromFolder = glob($datadir . "/" . $folder . "/" . "*"); // all files from folder
            $h2 = str_replace("_", " ", $folder); // replaces underscores with a space

            echo "<div>";
            echo "<h2>" . ucfirst($h2) . "</h2>";

            echo "<div class='lightgallery gallery-img-group'>";
            // loops through images in folder
            foreach(glob($datadir . "/" . $folder . "/*_thumb.*") as $image) {
                $random = "gallery-img-" . rand(1, 5); // generates a css class
                $alt = basename($image); // generates alt
                
                $img = strstr($image, "_thumb", true);
                
                // finds the images based on  the name and puts them to array
                $imgArray = array_filter($filesFromFolder, function($el) use ($img) {
                    return (strpos($el, $img) !== false);
                });
                
                // finds the original size image from array
                foreach($imgArray as $arrayimg) {
                    if (!strstr($arrayimg, "_thumb")) { // if strstr returns false, og img is found
                        $original = $arrayimg;
                        break;
                    } 
                }

                echo "<a href='" . $original . "'>";
                echo "<img class='$random' src='$image' alt='$alt'/>";
                echo "</a>";
            }

            echo "</div>";
            echo "</div>";
        }

    }
    
}

?>