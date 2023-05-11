



// Update the selected genres
function updateSelectedGenres() {
    var selectedGenres = [];
    $('.badge-selected').each(function() {
      selectedGenres.push($(this).data('value'));
    });
    $('#movie-genres').val(selectedGenres.join(', '));
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
    }
  });


  
  
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