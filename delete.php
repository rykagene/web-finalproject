<!-- DELETE PAGE  -->

<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              
                <h4 class="modal-title" id="myModalLabel">Delete record</h4>
            </div>
            <div class="modal-body">	
        
				<form method="GET" action="deleteProcess.php">

					<center>
						<select value="2" style="width: 80%; "class="form-select" id="inputId" type="text" name="id">
						
							<?php
								$xml = new domdocument("1.0");
								$xml->load("BSIT3EG1G3.xml");
								$netflixOriginals = $xml->getElementsByTagName("topNetflixOriginals");
	
								foreach($netflixOriginals as $topNetflixOriginals) {
									$id = $topNetflixOriginals->getAttribute("id");
									$top = $topNetflixOriginals->getElementsByTagName("top")->item(0)->nodeValue;
									$netflixTitle = $topNetflixOriginals->getElementsByTagName("netflixTitle")->item(0)->nodeValue;
									echo "<option>" ."Top".": $top ".$netflixTitle."</option>";
								}
							?>
							</select>
					</center>
						
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <input type="submit" class="btn btn-danger" value="Delete">
            </div>
			</form>
        </div>
    </div>
</div>