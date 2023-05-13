    // function that shows suggestion kapag nag type ka sa search box.
    function showHint(title) {
        // if textbox is empty
       {
            // create an object
            // XMLHttpRequest() is a javascript function that is responsible for communication of client and server asyncrhonously.
            http = new XMLHttpRequest();
    
            http.onreadystatechange = function() {
               
                if (http.readyState == 4 && http.status == 200) {
     
                    document.getElementById("suggestion_div").innerHTML = http.responseText; //set the value on suggestion list.
                document.getElementById("suggestion_div").style.display = "none"; //display suggestions_div 
                    
                } else {
                    $("#suggestion_div").html("Loading...");
    
    
                }
            };
            http.open("GET", "getMovies.php?q=" + title, true);
            http.send();
        }
    }