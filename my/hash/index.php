<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Steganography</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css"
      integrity="sha256-9mbkOfVho3ZPXfM7W8sV2SndrGDuh7wuyLjtsWeTI1Q="
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="style.css" />
    <script src="steganography.min.js"></script>
  </head>
  <body>
    <div class="cont">
      


        <div class="">
                  <input
          class="ui primary button"
          type="file"
          name="pic"
          accept="image/*"
          onchange="readURL(this);"
        />
        <div class="ui input">
          <input id="text" type="text" />
        </div>

        <button class="ui secondary button" onclick="hideText()">
          Hide Message Into Image
        </button>

        </div>
        <div class="img-cont">
          <div  class="img1">
            <h5>Source Image</h5>

            <img id="image1" src="" alt="" />
          </div>


          <div class="">
            <h5>Message Encoded Image</h5>
            <img id="image2" src="" alt="" />

          </div>

        </div>

        
    <div class="">

      <input class="ui secondary button" type="file" name="pic" accept="image/*" onchange="decode(this);" />
      <img class = "opa" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" alt="">
      <h5>Decoded Text:</h5>
      <h2 id="decoded"></h2>

    </div>





      
    </div>



    <script>
      var imgdatauri;

      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function(e) {
            document.querySelector("#image1").src = e.target.result;
            imgdatauri = e.target.result;
          };
        }
        reader.readAsDataURL(input.files[0]);
      }


      function decode(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();
        
            reader.onload = function(e) {
                console.log(steg.decode(e.target.result));
              
              document.querySelector('#decoded').innerText = steg.decode(e.target.result);
            };
          }
          reader.readAsDataURL(input.files[0]);
        }

      function hideText() {
        var hiddentext = document.querySelector("#text").value;
        //add random ID to hiddetext
        var randomID = '100'
  
        
        hiddentext = randomID + hiddentext;

        document.querySelector("#image2").src = steg.encode(hiddentext, imgdatauri);
      }

    </script>

<?php
function sendid(){

  include "../../dbconn.php";
  //session start
  session_start();
  //insert into database
  $sql = "INSERT INTO test (ID) VALUES ('100')";
  $result = mysqli_query($conn, $sql);
}
        
        
?>


  </body>
</html>
