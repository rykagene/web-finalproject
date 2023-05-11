
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Fonts CSS -->
    <link rel="stylesheet" href="assets/css/netflix-fonts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    
    <script src="assets/js/script.js"></script>
    


   
  </head>

<style>
    
  body {
    font-family: 'Netflix Sans';
    background-image:  url('bg.jpg');
    background-repeat: no-repeat;
    background-size: cover
    
    
  }
  

/* Hint suggestion */
#suggestion_div {
    display: "none";
    z-index: 1;
    width: 30%;
    position: absolute; right: 25px; margin-top: 0px;

}

.dropdown-item {
    background: #c4c4c4;
    padding: 18px;
}

#top_title {
    font-size: 60px;
    color: white;
    font-weight: 700;
}
.card-hovered {
  background-color: #333;
  transition: 0.25s ease-in-out;

}
.more {
text-decoration: underline;
}

#topNumber {
    font-size: 60px;
    position: absolute;
    right: 0;
    margin: 25px;
}
.displayCards {
    -webkit-transition: all 1s;
    -moz-transition: all 1s;
    -o-transition: all 1s;
    transition:all 1s;
}

.badge-dragging {
  opacity: 0.5;
}

#selected-genres {
  height: auto;
  min-height: 50px;
}

.badge-selected {
  cursor: pointer;
}
.top-movies  {

  padding: 25px;


}
    .image {
      transition: transform 0.15s;
    }
    .image.zoom {
      transform: scale(1.2);
      z-index: 1;
    }
  


  
 
</style>

<?php 





$xml = new domdocument("1.0");
$xml->load("BSIT3EG1G3.xml");
$netflixOriginals = $xml->getElementsByTagName("topNetflixOriginals");

// variable for identifying record
$flag = 0;

// get the user input from searchbox in the index.php
// $search = $_POST["code"];
$update_id = $_GET["update_id"];

// loop xml elements to access the nodes
foreach($netflixOriginals as $topNetflixOriginals) {
	$picture = $topNetflixOriginals->getElementsByTagName("picture")->item(0)->nodeValue;
	// $top = $topNetflixOriginals->getElementsByTagName("top")->item(0)->nodeValue;
	$netflixTitle = $topNetflixOriginals->getElementsByTagName("netflixTitle")->item(0)->nodeValue;
	$genre = $topNetflixOriginals->getElementsByTagName("genre")->item(0)->nodeValue;
	$hoursViewed = $topNetflixOriginals->getElementsByTagName("hoursViewed")->item(0)->nodeValue;
	$directedBy = $topNetflixOriginals->getElementsByTagName("directedBy")->item(0)->nodeValue;
	$mainCast = $topNetflixOriginals->getElementsByTagName("mainCast")->item(0)->nodeValue;
	$dateReleased = $topNetflixOriginals->getElementsByTagName("dateReleased")->item(0)->nodeValue;
	$id = $topNetflixOriginals->getAttribute("id");

// get the NEW VALUES and set to variables

if($update_id == $id) {
	$flag = 1;
	?>
	<div class="container" tabindex="1" aria-labelledby="myModalLabel" aria-hidden="true">
    	<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Edit details</h4>
				<a type="button" class="btn-close" href="manage.php" aria-label="Close"></a>
            </div>
            <div class="modal-body">
			<form method="POST" action="updateProcess.php" onsubmit="return validateForm()">
          <div class="form-floating mb-3 d-none">
            <input type="text" class="form-control" id="idcode" name="idcode" value="<?php echo $id; ?>" readonly="readonly">
            <label for="idcode">ID </label>
          </div>
          <div class="form-floating mb-3">
            <input id="inputTitle" onkeyup="checkTitle()" type="text" class="form-control" value="<?php echo $netflixTitle?>"  name="netflixTitle" required="required" placeholder="Title">
            <label for="inputTitle" class="form-label">Title</label>
            <div id="titlePrompt"></div>
          </div>
          <div class="form-floating mb-3">
          <input type="text" class="form-control" id="directedBy" name="directedBy" value="<?php echo $directedBy?>"  required="required" placeholder="Director/s">
              <label for="directedBy" class="form-label">Director</label>
          </div>
          <div class="form-floating mb-3">
          <input type="text" class="form-control" id="mainCast" name="mainCast" value="<?php echo $mainCast?>" required="required" placeholder="Cast">
              <label for="mainCast" class="form-label">Cast</label>
          </div>
          <div class="form-floating mb-3">
          <input type="date" class="form-control" id="dateReleased" name="dateReleased" value="<?php echo $dateReleased?>"  required="required" placeholder="Date Released">
              <label for="dateReleased" class="form-label">Date Release:</label>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Views</span>
            <input id="hoursViewed" name="hoursViewed" value="<?php echo $hoursViewed?>" type="number" min="1" class="form-control">
            <span class="input-group-text">hours</span>
          </div>
          <div class="input-group mb-3">
            <input type="file" class="form-control" id="picture" name="picture" required="required" placeholder="Upload">
          </div>
		  
      
	        <!-- genre div -->
			<div class="form-floating mb-3">
                <div class="mb-3">
                <input type="hidden" id="selected-genres-input" class="d-none"name="selectedGenres" required="required">
				
                    <label for="selected-genres" class="form-label">Genres:</label>
                    <div id="selected-genres" class="form-control">
                        <button class="btn float-end outline-0 border-0" type="button" id="resetBtn"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                    
                </div>
                <div class="mb-3">
                    <!-- <label for="genres" class="form-label">Available Genres:</label> -->
                    <div id="genres" class="">
                            <span class="badge rounded-pill bg-primary me-1" data-value="Drama">Drama</span>
                    <span class="badge rounded-pill bg-primary me-1" data-value="Thriller">Thriller</span>
                    <span class="badge rounded-pill bg-primary me-1" data-value="Comedy">Comedy</span>
                    <span class="badge rounded-pill bg-primary me-1" data-value="Fantasy">Fantasy</span>
                    <span class="badge rounded-pill bg-primary me-1" data-value="Romance">Romance</span>
                    <span class="badge rounded-pill bg-primary me-1" data-value="Science Fiction">Science Fiction</span>
                    <span class="badge rounded-pill bg-primary me-1" data-value="Adventure">Adventure</span>
                    <span class="badge rounded-pill bg-primary me-1" data-value="Sports">Sports</span>
                    <span class="badge rounded-pill bg-primary me-1" data-value="Action">Action</span>
                    <span class="badge rounded-pill bg-primary me-1" data-value="Western">Western</span>
                    <span class="badge rounded-pill bg-primary me-1" data-value="Horror">Horror</span>
                    <span class="badge rounded-pill bg-primary me-1" data-value="Musical">Musical</span>
                    <span class="badge rounded-pill bg-primary me-1" data-value="Mystery">Mystery</span>
                  
                    </div>
                </div>
          </div>
          <!-- end genre div -->

		  </div>
		<div class="card-footer">
		<div class="row">
			<div class="col w-100">
			<a type="button" href="manage.php" class="btn btn-outline-danger w-100"><i class="fa-solid fa-close"></i> Cancel</a>
        
			</div>
			<div class="col w-100">
			<button type="submit" class="btn btn-danger w-100"><i class="fa-solid fa-edit"></i> Update</button>
			</div>
		</div>
		</div>
		
	  
      
      </form>
    </div>
  </div>
</div>


<?php
}



?>

 


<?php }
 ?>
<script>
function validateForm() {
  var selectedGenres = $("#selected-genres-input").val();
  if (selectedGenres.trim() == "") {
    $("#selected-genres").tooltip({
      title: "Please select at least one genre.",
      placement: "top",
      trigger: "manual"
    }).tooltip("show");
    setTimeout(function() {
      $("#selected-genres").tooltip("hide");
    }, 2000);
    return false;
  }
  return true;
}

</script>


<script>
	// Add click event listener to the button in Modal 1
$('#openModal2Btn').click(function() {
  // Show Modal 2
  $('#modal2').modal('show');
});

    // Update the selected genres
function updateSelectedGenres() {
  var selectedGenres = [];
  $('.badge-selected').each(function() {
    selectedGenres.push($(this).data('value'));
  });
  $('#movie-genres').val(selectedGenres.join(', '));
  console.log(selectedGenres);
}

// Remove a genre from the available genres
function removeGenre(genre) {
  $('#genres span[data-value="' + genre + '"]').remove();
}
// Add a genre back to the available genres
function addGenre(genre) {
  // Check if the genre is already present in the available genres list
  var existingBadge = $('#genres span[data-value="' + genre + '"]');
  if (existingBadge.length > 0) {
    // If the genre is already present, just remove the badge-selected class and return
    existingBadge.removeClass('badge-selected');
    return;
  }

  // If the genre is not already present, create a new badge and add it to the available genres list
  var badge = $('<span class="badge rounded-pill bg-primary me-1" data-value="' + genre + '">' + genre + '</span>');
  badge.draggable({
    containment: 'document',
    helper: 'clone',
    zIndex: 100,
    revert: true,
    start: function() {
      $(this).addClass('badge-dragging');
    },
    stop: function() {
      $(this).removeClass('badge-dragging');
    }
  });
  $('#genres').append(badge);
}


// Make the badges droppable
$('.badge').draggable({
  containment: 'document',
  helper: 'clone',
  zIndex: 100,
  revert: true,
  start: function() {
    $(this).addClass('badge-dragging');
  },
  stop: function() {
    $(this).removeClass('badge-dragging');
  }
});
$('#selected-genres').droppable({
  accept: '.badge',
  drop: function(event, ui) {
    var badge = ui.draggable.clone();
    badge.removeClass('badge-primary');
    badge.addClass('badge-secondary badge-selected');
    badge.appendTo($(this));
    ui.draggable.draggable('option', 'revert', false);
    updateSelectedGenres();
    removeGenre(ui.draggable.data('value'));
    updateSelectedGenresInput();
  }
});

function updateSelectedGenresInput() {
  var selectedGenres = $('.badge-selected').map(function() {
    return $(this).data('value');
  }).get().join(',');
  $('#selected-genres-input').val(selectedGenres);
}

function updateSelectedGenres() {
  // ...
  updateSelectedGenresInput();
}


// Make the selected genres removable
$('#selected-genres').on('click', '.badge-selected', function() {
  var genre = $(this).data('value');
  $(this).remove();
  addGenre(genre);
  updateSelectedGenres();
});

// Clear selected genre options
$('#resetBtn').click(function() {
  // Remove selected genres from the selected list and add them back to the available list
  $('.badge-selected').each(function() {
    var genre = $(this).data('value');
    $(this).remove();
    addGenre(genre);
  });
  // Clear the selected genre input field
  $('#movie-genres').val('');
});


</script>
<!--  END OF CREATE MODAL-->


<!-- library for table sorting -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  
</body>
</html>