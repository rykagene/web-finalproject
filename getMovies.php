<?php

$xml = new domdocument();
$xml->load("BSIT3EG1G3.xml");
$netflixOriginals = $xml->getElementsByTagName("topNetflixOriginals");

$q = ucwords($_REQUEST["q"]); //ucwords capital first letter of words
$result = "";


foreach ($netflixOriginals as $topNetflixOriginals) {

	$id = $topNetflixOriginals->getAttribute("id");
	$picture = $topNetflixOriginals->getElementsByTagName("picture")->item(0)->nodeValue;
	$netflixTitle = $topNetflixOriginals->getElementsByTagName("netflixTitle")->item(0)->nodeValue;
	


	if ($q == substr($netflixTitle, 0, strlen($q))) {

		$result .="<a id='result-item' href='' data-toggle='modal' class='dropdown-item bg-dark text-white'>" . $netflixTitle . "</a>";
	}

}

// Set $response to "No records found." in case no hint was found
// or the values of the matching values
if ($result == '') {
	$result .= "<p class='dropdown-item rounded bg-dark text-white'> No result found.</p>";}

	if ($q == '') {
		return;
	
	}


//show the results or "No records found."
echo $result;

?>
