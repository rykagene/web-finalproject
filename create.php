<style>
	body {
		font-family: 'Netflix Sans';
		font-weight: bolder;
	}
</style>
<script>
	//this function will check if the top number of movie/series is already used. 
	function checkTop() {

		// get the value from user & set to variable.
		var top = document.getElementById("inputTop").value;

		// if walang tinype si user, walang lalabas na prompt.
		if (top.length == 0) {
			document.getElementById("topPrompt").innerHTML = "";
		}

		else { 

			// 2ND STEP: create an obeject.// XMLHttpRequest() is a javascript object used for asynchronous communiction between client and server .
			http = new XMLHttpRequest();

			http.onreadystatechange = function() {  

                 // STEP 6: kapag yung respond ng server ay 4, request finished and response is ready at okay.
				if (http.readyState == 4 && http.status == 200) {

					// STEP 7: proper action. dito na mag-display yung text na "sorry, top you entered is already used".
					document.getElementById("topPrompt").innerHTML = http.responseText;
				}
				else {
					document.getElementById("topPrompt").innerHTML = "Loading...";
				}
			};
				
			http.open("GET", "validateTop.php?q=" + top, true);
			http.send(); //STEP 3: object sends request to a web server

			// STEP 4: ipprocess ng serve yung request.
			// STEP 5: server will send a response. yung response na isesend ay readyState at status na may corresponding meaning.
			
		}
		
	}

	// this function will check if the title of movie/series is already used. 
	// same lang to ng ginagawa sa taas kaya di ko na nilagyan ng comments. 
	function checkTitle() {
		var netflixTitle = document.getElementById("inputTitle").value;
		if (netflixTitle.length == 0) {
			document.getElementById("titlePrompt").innerHTML = "";
		}
		else {
			http = new XMLHttpRequest();
				http.onreadystatechange = function() {  
					if (http.readyState == 4 && http.status == 200) {
						document.getElementById("titlePrompt").innerHTML = http.responseText;
					}
					else {
						document.getElementById("titlePrompt").innerHTML = "Loading...";
					}
				};
				http.open("GET", "validateTitle.php?q=" + netflixTitle, true);
				http.send();
		}
		
	}

	
</script>



<!-- MODAL FOR CREATE -->




<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title font-weight-bold" id="myModalLabel">Add record</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">

          <!-- user input  -->
          <form method="POST" action="createProcess.php">
            <div class="form-floating mb-3 d-none">
              <input type="text" class="form-control" id="idcode" name="idcode" value="<?php uniqid() ?>" readonly="readonly">
              <label for="idcode" class="form-label">ID:</label>
            </div>
			
            <!-- <div class="row form-floating mb-3">
              <input id="inputTop" onkeyup="checkTop()" type="number" min="1" class="form-control" name="top" required="required">
              <label for="inputTop" class="form-label">Top:</label>
              <div id="topPrompt"></div>
            </div> -->
            <div class="form-floating">
              <input id="inputTitle" onkeyup="checkTitle()" type="text" class="form-control" name="netflixTitle" required="required">
              <label for="inputTitle" class="form-label">Title:</label>
              <div id="titlePrompt"></div>
            </div>
            <!-- <div class="row form-floating mb-3">
              <input type="file" class="form-control" id="picture" name="picture" required="required">
              <label for="picture" class="form-label">Image:</label>
            </div> -->
			<div class="input-group mb-3">
				<input type="file" class="form-control" id="picture" name="picture" required="required">
				<label class="input-group-text" for="picture">Upload</label>
			</div>

            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="genre" name="genre" required="required">
              <label for="genre" class="form-label">Genre:</label>
            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="hoursViewed" name="hoursViewed" required="required">
              <label for="hoursViewed" class="form-label">Views:</label>
			  <span class="input-group-text">hrs</span>
            </div>
            <div class=" form-floating mb-3">
              <input type="text" class="form-control" id="directedBy" name="directedBy" required="required">
              <label for="directedBy" class="form-label">Director/s:</label>
            </div>
            <div class=" form-floating mb-3">
              <input type="text" class="form-control" id="mainCast" name="mainCast" required="required">
              <label for="mainCast" class="form-label">Cast:</label>
            </div>
            <div class=" form-floating mb-3">
              <input type="date" class="form-control" id="dateReleased" name="dateReleased" required="required">
              <label for="dateReleased" class="form-label">Date Release:</label>
            </div>

          </div>
        </div>

            <div class="modal-footer">
				
           
				
				<!-- send all the user input to createProcess.php -->
				<button id="createBtn"type="submit" name="createProcess.php"onclick="check()" class="btn btn-danger btn-primary w-100"></span> Add</a>

			
            </div>
			</form>
        </div>
    </div>
</div>