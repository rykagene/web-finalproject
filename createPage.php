

<!--  CREATE MODAL-->
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body">
        <form method="GET" action="createProcess.php" onsubmit="return validateForm()">
          <div class="form-floating mb-3 d-none">
            <input type="text" class="form-control" id="idcode" name="idcode" value="<?php echo uniqid() ?>" readonly="readonly">
            <label for="idcode">Email </label>
          </div>
          <div class="form-floating mb-3">
            <input id="inputTitle" onkeyup="checkTitle()" type="text" class="form-control" name="netflixTitle" required="required" placeholder="Title">
            <label for="inputTitle" class="form-label">Title</label>
            <div id="titlePrompt"></div>
          </div>
          <div class="form-floating mb-3">
          <input type="text" class="form-control" id="directedBy" name="directedBy" required="required" placeholder="Director/s">
              <label for="directedBy" class="form-label">Director</label>
          </div>
          <div class="form-floating mb-3">
          <input type="text" class="form-control" id="mainCast" name="mainCast" required="required" placeholder="Cast">
              <label for="mainCast" class="form-label">Cast</label>
          </div>
          <div class="form-floating mb-3">
          <input type="date" class="form-control" id="dateReleased" name="dateReleased" required="required" placeholder="Date Released">
              <label for="dateReleased" class="form-label">Date Release:</label>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Views</span>
            <input id="hoursViewed" name="hoursViewed" type="number" min="1" class="form-control">
            <span class="input-group-text">hours</span>
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

          <div class="form-floating mb-3"></div>
          <div class="form-floating mb-3"></div>
          <div class="input-group mb-3">
            <input type="file" class="form-control" id="picture" name="picture" required="required" placeholder="Upload">
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="submit" name="createProcess.php" class="btn btn-danger w-100"><i class="fa-solid fa-plus"></i> Add Record</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script src="assets/js/script.js"></script>
<script>
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

<!--  END OF CREATE MODAL-->


