<!doctype html>
<html lang="en">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/search.css">
    <!-- Fonts CSS -->
    <link rel="stylesheet" href="assets/css/netflix-fonts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Script -->
    <script src="assets/bootstrap/js/jquery-3.6.0.min.js"></script>
    <script src="assets/bootstrap/js/jquery-ui.min.js"></script>
    <script src="assets/js/index.js"></script>

    <title>Top Netflix Originals</title>
  <body class="">

<br>

<a><i onclick="history.back()"class="fa-solid fa-arrow-left fa-2xl m-4" style="color: #ffffff; cursor:pointer"></i></a><br><br>

<div class="container">
   
   <h1 id="top_title" class="text-left"><b>Search</b></h1>
   <div class="row">
       <div class="col">
  
   <div class="d-flex justify-content-end">
   <a href="home.php" type="button" class="btn btn-danger"><i class="fa-solid fa-home"></i> Home</a>
    &nbsp; &nbsp; 
    
     <!-- SEARCH --> 
      <form action="searchProcess.php" method="POST">
               <div class="input-group">
               <input id="searchBox" type="search" name="code" class="form-control bg-dark rounded-pill border-0 text-white" onkeyup="showHint(this.value)" autocomplete="off" placeholder="Search movie/series title" required="required">

   <span class="input-group-append">
                   <button class="btn btn-secondary bg-dark border-0 border rounded-pill ms-n5" type="button">
                       <i class="fa fa-search"></i>
                   </button>
               </span>
              </div>
             </form>
   </div>   

        <!--data -->
  
                <div class="row m-4">
                <?php
                
                $xml = new domdocument("1.0");
                $xml->load("BSIT3EG1G3.xml");
                $netflixOriginals = $xml->getElementsByTagName("topNetflixOriginals");

                // variable for identifying record
                $flag = 0;

                // get the user input from searchbox in the home.php
                $search = $_POST["code"];
                

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


                    // if you are looking for CONTAINS any details from the record 
                    if (
                        str_contains($id, $search) || str_contains(strtolower($netflixTitle), strtolower($search)) 
                        // str_contains(strtolower($genre), strtolower($search)) ||
                        // str_contains(strtolower($hoursViewed),strtolower($search)) ||
                        // str_contains(strtolower($directedBy), strtolower($search)) ||
                        // str_contains(strtolower($mainCast), strtolower($search)) ||
                        // str_contains($dateReleased, $search)
                    ) {

                        // display all result
                        $flag = 1;
                        ?>
            <div class="displayCards col-md-6 col-sm-6 mb-4">
              <div id="card" class="card border-0 netflix-card">
    
                <img src="data:image;base64,<?php echo $picture; ?>" class="card-img-top" alt="<?php echo $netflixTitle; ?>">
    
                <div class="card-body d-none position-absolute start-0 pt-4  text-center text-white w-100 h-100">
                  <h4 class="card-title font-weight-bold "><?php echo $netflixTitle; ?></h4>
                  <p class="card-text"><?php echo $genre; ?></p>
      
                  <button class="btn btn-danger" type="button" data-toggle="collapse" data-target="#multiCollapseExample1" aria-expanded="false" aria-controls="multiCollapseExample1"> More Details</button>
      
                    <div class="collapse multi-collapse" id="multiCollapseExample1">
                    <p></p> 
                    <p class="card-text">Hours Viewed: <?php echo $hoursViewed . ' hours views'?></p>
                    <p class="card-text">Directed by: <?php echo $directedBy; ?></p>
                    <p class="card-text">Cast: <?php echo $mainCast; ?></p>
                    <p class="card-text">Date Released: <?php echo $dateReleased; ?></p>
                    </div>
                </div>
              </div>
            </div>
                      <?php
                    }
                }
                // if no record found
                if ($flag == 0) {

                    echo "<br><br><br><br><br><br><center class='text-white'> Sorry, <b>$search</b> was  not found.<a href='index.php'><center><br><br><br>";
                }
                ?>
              
            <?php 
            //use include() method to integrate other pages to this page
            //show the modal or popup
            // include('update.php');
            include('createPage.php'); 
            ?>
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
    $(this).find('.card-body').css('background-color', 'rgba(0, 0, 0, 0.7)');
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

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
</body>
</html>