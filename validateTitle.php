<?php
	// create object to use xml methods.
	$xml = new domdocument();

	// load xml files to access and manipulate data.
	$xml->load("BSIT3EG1G3.xml");

	// get all the topNetflixOriginals elements. 
	$netflixOriginals = $xml->getElementsByTagName("topNetflixOriginals");

	// get the value from inputTitle from create.php
	$createTitle = $_REQUEST["q"];

	// lookup all records from BSIT3EG1G3.xml
	foreach ($netflixOriginals as $topNetflixOriginals) 
	{
		//select top number and title of record then set to variable
		// $top = $topNetflixOriginals->getElementsByTagName("top")->item(0)->nodeValue;
		$netflixTitle = $topNetflixOriginals->getElementsByTagName("netflixTitle")->item(0)->nodeValue;
		
		//test if netflixTitle matches record regardless of case sensitivity
		if (strtolower($createTitle)==strtolower($netflixTitle)) 
		{									
			?>
			<p id="existingTitle" class="small" style="color:red;" >
				Sorry,  <b><?php echo  $createTitle ?></b> is already added. Try different title.
			</p>
			<?php
			break;
		}
	}
?>


