<?php
// create DOMdocment instantiation to use the xml methods
$xml = new domdocument ("1.0"); 

// formatting
$xml->formatOutput = true;
$xml->preserveWhiteSpace = false;

// this method simply access or manipulate the xml file 
$xml->load("BSIT3EG1G3.xml");

$netflixOriginals = $xml->getElementsByTagName("topNetflixOriginals");

// get user inputs from create.php using POST and store to variable
// $idcode = $_POST["idcode"];
$idcode = uniqid();
// $top = $_POST["top"];
$netflixTitle = $_GET["netflixTitle"]; 
$genre = $_GET["selectedGenres"]; 
$hoursViewed = $_GET["hoursViewed"];
$directedBy = $_GET["directedBy"];
$mainCast = $_GET["mainCast"];
$dateReleased = $_GET["dateReleased"];
$picture = $_GET["picture"];

// variable for identifying record
$flag = 0;

// loop the xml file to access elemets
foreach ($netflixOriginals as $topNetflixOriginals) 
{
    // found one record  
    // if ($top == $topNetflixOriginals->getElementsByTagName("top")->item(0)->nodeValue) {
    //     $flag = 1;
    //     echo '<script>alert("TOP number already used. Use another TOP number")</script>';
    //     header('refresh:0;url=index.php');
    // }
}

if ($flag == 0) {

        // create new xml element using createElement()
        // 1st parameter = element name (must be similar to you xml)
        // 2nd parameter = value you want to input
        $topNetflixOriginals = $xml->createElement("topNetflixOriginals");
        // $top = $xml->createElement("top", $top); 
        $netflixTitle = $xml->createElement("netflixTitle", $netflixTitle); 
  

        $pic = $xml->createElement("picture"); 
        $imageData = file_get_contents($picture);
        $base64 = base64_encode($imageData);
        $cdata = $xml->createCDATASection($base64);
        $pic->appendChild($cdata);

        $genre = $xml->createElement("genre", $genre); 
        $hoursViewed = $xml->createElement("hoursViewed", $hoursViewed);
        $directedBy = $xml->createElement("directedBy", $directedBy);
        $mainCast = $xml->createElement("mainCast", $mainCast);
        $dateReleased = $xml->createElement("dateReleased", $dateReleased);

        // set the record an unique id using setAttribute()
        // this will be primary key
        $topNetflixOriginals->setAttribute("id", $idcode); 

        // all the created elements will be added inside the <topNetflixOriginals>
        // $topNetflixOriginals->appendChild($top); 
        $topNetflixOriginals->appendChild($netflixTitle); 
        $topNetflixOriginals->appendChild($pic);
        $topNetflixOriginals->appendChild($genre); 
        $topNetflixOriginals->appendChild($hoursViewed);
        $topNetflixOriginals->appendChild($directedBy);
        $topNetflixOriginals->appendChild($mainCast);
        $topNetflixOriginals->appendChild($dateReleased);
    

        // add <topNetflixOriginals> inside the <netflixOriginals> which is the root element
        $xml->getElementsByTagName("netflixOriginals")->item(0)->appendChild($topNetflixOriginals); 

        // save
        $xml->save("BSIT3EG1G3.xml");

        // prompt
        echo '<script>alert("Added success")</script>';

        // back to homepage
        header('refresh:0;url=manage.php');


}




?>