<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <!-- Style CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/update.css">
  <!-- Fonts CSS -->
  <link rel="stylesheet" href="assets/css/netflix-fonts.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Script -->
  <script src="assets/bootstrap/js/jquery-3.6.0.min.js"></script>
  <script src="assets/bootstrap/js/jquery-ui.min.js"></script>
  <script src="assets/js/script.js"></script>
  <title>Update Details</title>
</head>


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
foreach ($netflixOriginals as $topNetflixOriginals) {
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
  if ($update_id == $id) {
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
                <input type="text" class="form-control" id="idcode" name="idcode" value="<?php echo $id; ?>"
                  readonly="readonly">
                <label for="idcode">ID </label>
              </div>
              <div class="form-floating mb-3">
                <input id="inputTitle" onkeyup="checkTitle()" type="text" class="form-control" name="netflixTitle"
                  required="required" placeholder="Title" autocomplete="off" value="<?php echo $netflixTitle ?>">

                <label for="inputTitle" class="form-label">Title</label>
                <div id="titlePrompt"></div>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="directedBy" name="directedBy" value="<?php echo $directedBy ?>"
                  required="required" placeholder="Director/s">
                <label for="directedBy" class="form-label">Director</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="mainCast" name="mainCast" value="<?php echo $mainCast ?>"
                  required="required" placeholder="Cast">
                <label for="mainCast" class="form-label">Cast</label>
              </div>
              <div class="form-floating mb-3">
                <input type="date" class="form-control" id="dateReleased" name="dateReleased"
                  value="<?php echo $dateReleased ?>" required="required" placeholder="Date Released">
                <label for="dateReleased" class="form-label">Date Release:</label>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text">Views</span>
                <input id="hoursViewed" name="hoursViewed" value="<?php echo $hoursViewed ?>" type="number" min="1"
                  class="form-control">
                <span class="input-group-text">hours</span>
              </div>
              <div class="input-group mb-3">
                <input type="file" class="form-control" id="picture" name="picture" required="required"
                  placeholder="Upload">
              </div>


              <!-- genre div -->
              <div class="form-floating mb-3">
                <div class="mb-3">
                  <input type="hidden" id="selected-genres-input" class="d-none" name="selectedGenres" required="required">

                  <label for="selected-genres" class="form-label">Genres:</label>
                  <div id="selected-genres" class="form-control">
                    <button class="btn float-end outline-0 border-0" type="button" id="resetBtn"><i
                        class="fa-solid fa-xmark"></i></button>
                  </div>

                </div>
                <div class="mb-3">
                  <div id="genres" class="">
                    <?php
                    $genres = array(
                      "Drama",
                      "Thriller",
                      "Comedy",
                      "Fantasy",
                      "Romance",
                      "Science Fiction",
                      "Adventure",
                      "Sports",
                      "Action",
                      "Western",
                      "Horror",
                      "Musical",
                      "Mystery"
                    );

                    foreach ($genres as $genre) {
                      echo '<span class="badge rounded-pill bg-primary me-1" data-value="' . $genre . '">' . $genre . '</span>';
                    }
                    ?>

                  </div>
                </div>
              </div>
              <!-- end genre div -->

          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col w-100">
                <a type="button" href="manage.php" class="btn btn-outline-danger w-100"><i class="fa-solid fa-close"></i>
                  Cancel</a>

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
<!--  END OF CREATE MODAL-->


<!-- library for table sorting -->
<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>