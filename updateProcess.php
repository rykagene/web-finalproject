    <!-- Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Fonts CSS -->
    <link rel="stylesheet" href="assets/css/netflix-fonts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<body>
<?php
$xml = new domdocument("1.0");
// formatting
$xml->formatOutput = true;
$xml->preserveWhiteSpace = false;
$xml->load("BSIT3EG1G3.xml");
$netflixOriginals = $xml->getElementsByTagName("topNetflixOriginals");

// get the NEW VALUES and set to variables
$id = $_POST["idcode"];
$netflixTitle = $_POST["netflixTitle"];
$genre = $_POST["selectedGenres"];
$hoursViewed = $_POST["hoursViewed"];
$directedBy = $_POST["directedBy"];
$mainCast = $_POST["mainCast"];
$dateReleased = $_POST["dateReleased"];
$picture = $_POST["picture"];


// variable for identifying record
$flag = 0;


// loop the xml file to access elemets
foreach ($netflixOriginals as $topNetflixOriginals) 
{

    if ($id == $topNetflixOriginals->getAttribute("id")) {
        
        // if($topNetflixOriginals->getElementsByTagName("top")->item(0)->nodeValue == $_POST["top"]) {
        //     echo '<script>alert("similar top number, it must be not similar to istelf.")</script>';
           
        // }
    
        // else if(($topNetflixOriginals->getElementsByTagName("top")->item(0)->nodeValue !== $_POST["top"]) || ($topNetflixOriginals->getElementsByTagName("top")->item(0)->nodeValue != $top)){
        //     $flag = 1;
            
        //     $pic = $xml->createElement("picture"); 
		// 	$imageData = file_get_contents($picture);
		// 	$base64 = base64_encode($imageData);
		// 	$cdata = $xml->createCDATASection($base64);
		// 	$pic->appendChild($cdata);

        //     //create new element and append it to topNetflixOriginals
        //     $newNode = $xml->createElement("topNetflixOriginals");
        //     $newNode->setAttribute("id", "$id");
        //     $newNode->appendChild($xml->createElement("top", $top));
        //     $newNode->appendChild($xml->createElement("netflixTitle", $netflixTitle));
        //     $newNode->appendChild($pic);
        //     $newNode->appendChild($xml->createElement("genre", $genre));
        //     $newNode->appendChild($xml->createElement("hoursViewed", $hoursViewed));
        //     $newNode->appendChild($xml->createElement("directedBy", $directedBy));
        //     $newNode->appendChild($xml->createElement("mainCast", $mainCast));
        //     $newNode->appendChild($xml->createElement("dateReleased", $dateReleased));

            
            
            
       
        //     //get the original/old parent element and set to variable
        //     $oldNode = $topNetflixOriginals;
    
        //     // replacing the new element
        //     $xml->getElementsByTagName("netflixOriginals")->item(0)->replaceChild($newNode, $oldNode);
        //     $xml->save("BSIT3EG1G3.xml");
        //     // prompt
        //     echo '<script>alert("update success")</script>';
    
        //     // back to homepage
        //      header('refresh:0;url=index.php');
        // }
        

            $flag = 1;
            
            $pic = $xml->createElement("picture"); 
			$imageData = file_get_contents($picture);
			$base64 = base64_encode($imageData);
			$cdata = $xml->createCDATASection($base64);
			$pic->appendChild($cdata);
			

            //create new element and append it to topNetflixOriginals
            $newNode = $xml->createElement("topNetflixOriginals");
            $newNode->setAttribute("id", "$id");
            // $newNode->appendChild($xml->createElement("top", $top));
            $newNode->appendChild($xml->createElement("netflixTitle", $netflixTitle));
            $newNode->appendChild($pic);

          
            
            $newNode->appendChild($xml->createElement("genre", $genre));
            $newNode->appendChild($xml->createElement("hoursViewed", $hoursViewed));
            $newNode->appendChild($xml->createElement("directedBy", $directedBy));
            $newNode->appendChild($xml->createElement("mainCast", $mainCast));
            $newNode->appendChild($xml->createElement("dateReleased", $dateReleased));

            
            
            
       
            //get the original/old parent element and set to variable
            $oldNode = $topNetflixOriginals;
    
            // replacing the new element
            $xml->getElementsByTagName("netflixOriginals")->item(0)->replaceChild($newNode, $oldNode);
            $xml->save("BSIT3EG1G3.xml");
            // prompt
        
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>'; // include SweetAlert2 JS file
            echo '<script>';
            echo 'Swal.fire({
                    title: "Success!",
                    text: "Update successfully!",
                    icon: "success",
                    showCancelButton: false,
                    target: "body",
                    confirmButtonText: "OK",
                    confirmButtonColor: "red",
                }).then(() => {
                    window.location.href = "manage.php"; // redirect to homepage
                });';
            echo '</script>';
    
        
       
    }
}

if ($flag == 0) {
    echo "Modification failed... <a href='index.php'>Back</a>";
}
?>
</body>