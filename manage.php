
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
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.css">



   
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
 
 
  <script>
  // function that shows suggestion kapag nag type ka sa search box.
  function showHint(title) {
    // if textbox is empty
    if (title.length == 0) {
        document.getElementById("show").style.display = "none";
    } else {
        // create an object
        // XMLHttpRequest() is a javascript function that is responsible for communication of client and server asyncrhonously.
        http = new XMLHttpRequest();

        http.onreadystatechange = function() {
           
            if (http.readyState == 4 && http.status == 200) {
                $("#suggestion_div").html(http.responseText); 
               


            } else {
                $("#suggestion_div").html("Loading...");


            }
        };
        http.open("GET", "getMovies.php?q=" + title, true);
        http.send();
    }
}
  </script>
  <body class="">

    <br>
    
    <div class="container">
   
    <h1 id="top_title" class="text-left"><b>Manage </b></h1>
    <div class="row">
        <div class="col">
   
    <div class="d-flex justify-content-end">
    <a href="index.php" type="button" class="btn btn-danger m-1"><i class="fa-solid fa-home"></i> Home</a>
    <!-- CREATE -->
      <button type="button" class="btn btn-danger m-1" data-bs-toggle="modal" data-bs-target="#create"><i class="fa-solid fa-plus"></i> Add</button>
      &nbsp; 
      <!-- SEARCH --> 
       <form action="searchProcess.php" method="POST">
                <div class="input-group ">
                <input id="searchBox" type="text" name="code" class="form-control bg-dark rounded-pill border-0 text-white" onkeyup="showHint(this.value)" required="required" autocomplete="off" placeholder="Search any movie/series title">
 
    <span class="input-group-append">
                    <button class="btn btn-secondary bg-dark border-0 border rounded-pill ms-n5" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
  


                </div>
              </form>
            
    
    </div>   
  
    <!-- SEARCH SUGGESTION RESULT -->
    <div id="suggestion_div"></div>

    <!-- DELETE -->
    <!-- <a href="#delete" class="btn btn-danger" data-toggle="modal"></span>Delete</a> -->

 
          
    
   
    
       <!-- SEARCH --> 
       <!-- <form action="searchProcess.php" method="POST">
        <div class="input-group-append">
       
            <input id="searchBox"type="text" name="code" class="form-control bg-dark border-0 text-white" onkeyup="showHint(this.value)"  required="required" autocomplete="off" placeholder="Search any movie/series title"> 
            <input type="submit" class="btn btn-danger" value="Search">
             
        </div>
    </form> -->

       
    

   
        
 



    
  

    <!-- READ -->
    <br>
    <div class="row">
    <?php
  $xml = new domdocument ("1.0"); 
  $xml->load("BSIT3EG1G3.xml");
  $netflixOriginals = $xml->getElementsByTagName("topNetflixOriginals");

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
  ?>
  <div class="displayCards col-md-4 col-sm-6 mb-4">
  <div id="card" class="card border-0 netflix-card">
    
    <img src="data:image;base64,<?php echo $picture; ?>" class="card-img-top" alt="<?php echo $netflixTitle; ?>">
    
    <div class="card-body d-none position-absolute start-0 pt-5  text-center text-white w-100 h-100">
      <h4 class="card-title font-weight-bold "><?php echo $netflixTitle; ?></h4>
      <p class="card-text"><?php echo $genre; ?></p>
      
     <div class="row">
     <div class="col"></div>
      <div class="col"> 

      <form method="GET" action="update.php">
        <input type="hidden" name="update_id" value="<?php echo $id; ?>">
        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-edit" style="color: #fff;"></i>&nbsp;Edit</a>
      </form>
      <!-- <a href="#update" data-bs-toggle="modal" class="btn btn-sm btn-danger"><i class="fas fa-edit" style="color: #fff;"></i>&nbsp;Edit</a> -->





      </div>
      
      <div class="col">
      <form method="post" id="formDelete_<?php echo $id; ?>" action="deleteProcess.php">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <button type="submit" class="btn btn-sm btn-danger delete-btn" data-id="<?php echo $id; ?>"><i class="fas fa-trash" style="color: #fff;"></i>&nbsp;Delete</button>
</form>

<script>
$('.delete-btn').click(function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'red',
        cancelButtonColor: 'lightgray',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: "deleteProcess.php",
                data: { id: id },
                success: function(data) {
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Your item has been deleted.',
                        icon: 'success',
                        confirmButtonColor: 'red',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        // Reload page after success message
                        location.reload();
                    });
                },
                error: function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'There was an error deleting your item.',
                        icon: 'error',
                        confirmButtonColor: 'red',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    })
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

      </div>
      <div class="col"></div>
     </div>
      
    </div>

  </div>
</div>






  

<script>
  $(document).ready(function() {
    // Add hover effect to card
    $('.card').hover(function() {
      $(this).find('.card-body').removeClass('d-none');
      $(this).addClass('card-hovered');
    }, function() {
      $(this).find('.card-body').addClass('d-none')
      $(this).removeClass('card-hovered');
    });
    $('.card').hover(function() {
    $(this).find('.card-body').css('background-color', 'rgba(0, 0, 0, 0.8)');
  });
  $('.accordion-trigger').click(function() {
    $('.accordion-content').show();
    
  });
  $('#filter').click(function() {
    $('.displayCards').removeClass('col-md-12').addClass('col-md-4',1000);
  });
  $('#filter2').click(function() {
    $('.displayCards').removeClass('col-md-4').addClass('col-md-12',1000);
  });


    
  });

 








</script>




    <?php 
      //show the modal
      include('createPage.php');
      // include('update.php');
      include('delete.php'); 
    ?>
  <?php 
    }
  ?>
</div>



  

        </div>
    </div>
</div>
<?php include('create.php'); ?>

<!-- library for table sorting -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  
</body>
</html>