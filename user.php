<?php
require 'config.php';


if (!empty($_SESSION["id"])) {
  $id = $_SESSION["id"];
  $result = mysqli_query($conn, "SELECT * FROM signin WHERE id = $id");
  $row = mysqli_fetch_assoc($result);
} else {
  header("Location: index.php");
}

// Check if user is logged in
if (empty($_SESSION['id'])) {
  // Redirect to login page if not logged in
  header("Location: index.php");
  exit();
}

// Check if user is an admin
$id = $_SESSION["id"];
$result = mysqli_query($conn, "SELECT * FROM signin WHERE id = $id");
$row = mysqli_fetch_assoc($result);
if ($row['usertype'] == 'admin') {
  // Display error message in alert box and redirect to homepage
  header("Location: admin.php?error=admin_access_denied");
  exit();
}







?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap");
  </style>
  <link rel="stylesheet" href="../sound/pproject/Css/style.css" />
  <link rel="stylesheet" href="../sound/pproject/Css/media.css" />
  <link rel="stylesheet" href="../sound/pproject/Css/fontawesome-stars.css" />
  <style>
    .success {
      z-index: 50;
      position: absolute;
      top: 5%;
      left: 50%;
      transform: translateX(-50%);
      display: block;
      padding: 16px;
      background: linear-gradient(to bottom right, #ffffff, #83ff45);
      color: #333333;
      font-size: 16px;
      font-weight: bold;
      border-radius: 8px;
      box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
      animation: fadeOut 1s ease 4s forwards;
    }

    .success:before {
      content: "✓";
      font-size: 24px;
      margin-right: 8px;
      color: #007f7f;
      text-shadow: 1px 1px #ffffff;
    }

    @media only screen and (max-width: 480px) {
      .success-message {
        font-size: 14px;
        padding: 12px;
        margin: 8px 0;
      }

      .success:before {
        font-size: 20px;
        margin-right: 4px;
      }
    }

    @keyframes fadeOut {
      from {
        opacity: 1;
        transform: translateX(-50%);
      }

      to {
        opacity: 0;
        transform: translateX(-50%) translateY(-50%);
      }
    }
  </style>

</head>

<body>

  <?php

  if (isset($_GET["successlogin"])) {
    echo "<div class='success' id='success1'> Welcome " . $row['name'] . "!
  </div>";
    echo "<script>
          setTimeout(function() {
            document.getElementById('success1').style.display = 'none';
            history.replaceState(null, '', window.location.href.split('?')[0]);
          }, 3000);
        </script>";
  }

  ?>



  <div class="container">
    <!-- sidebar start -->
    <div class="sidebar">
      <!-- sidebar logo start -->
      <div class="logo">
        <a href=""><img src="../sound/css/images/20230222_220650.png" alt="" /><span>SOUND</span></a>
      </div>

      <!-- sidebar logo end -->

      <!-- side bar home search library buttons start -->
      <div class="sidebarhome">

        <a href="" class="home">
          <i class="fa-solid fa-house"></i>
          <h6 class="home-text">Home</h6>
        </a>

        <a href="" class="maghome home">
          <i class="magnifying fa-solid fa-magnifying-glass"></i>
          <h6 class="search-mag home-text">Search</h6>
        </a>

        <a href="" class="home">
          <i class="fa-solid fa-book-bookmark"></i>
          <h6 class="home-text">Your Library</h6>
        </a>

      </div>

      <!-- side bar home search library buttons end-->

      <div class="playandlike">
        <div class="playlist">
          <i class="cl fa-solid fa-plus"></i><a href="">Create Playlist</a>
        </div>
        <div class="likedsongs">
          <i class="cl fa-regular fa-heart"></i><a href="">Liked Songs</a>
        </div>
      </div>
    </div>

    <!-- sidebar end -->

    <!-- center content start -->
    <div class="center">
      <!-- searchbar start -->
      <div class="searchbar">


        <!-- searchbox start -->
        <div class="searchbox">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input id="livesearch" name="songsearch" class="searchinput" type="text" placeholder="What do you want to listen to?" />
          <i class="fa-solid fa-xmark"></i>
        </div>
        <!-- searchbox end -->

        <!-- useraccount start -->
        <div id="user" class="useraccount">
          <?php
          if (isset($_SESSION["id"])) {
            $id = $_SESSION["id"];
            $result = mysqli_query($conn, "SELECT * FROM signin WHERE id = $id");
            $row = mysqli_fetch_assoc($result);
          }
          ?>
          <h5 id="userid"><?php echo ($row["name"]); ?></h5>
          <i class="fa-solid fa-angle-down"></i>


        </div>

        <!-- useraccount end -->
      </div>
      <!-- searchbar end -->

      <!-- Search Category Start -->

      <div class="searchlinkwithlogout">
        <div id="main-search-link-box" class="search_category">
          <a class="search-links" href="#" link="../sound/pproject/Ajax-Searches/ajax-live-search-for-All.php">All</a>
          <a class="search-links" href="#" link="../sound/pproject/Ajax-Searches/search-by-song-name.php">Song Name</a>
          <a class="search-links" href="#" link="../sound/pproject/Ajax-Searches/search-by-Artist.php">Artist</a>
          <a class="search-links" href="#" link="../sound/pproject/Ajax-Searches/search-by-Album.php">Albums / Film Name</a>
          <a class="search-links" href="#" link="../sound/pproject/Ajax-Searches/search-by-year.php">Year</a>
          <a class="search-links" href="#" link="../sound/pproject/Ajax-Searches/search-by-bollywood.php">Bollywood</a>
          <a class="resholly search-links" href="#" link="../sound/pproject/Ajax-Searches/search-by-hollywood.php">Hollywood</a>
        </div>
        <div class="">
          <div id="logout" class="logout_section">
            <div class="logout"> <a href="logout.php"> Logout</a></div>
          </div>
        </div>
      </div>

      <!-- Search Category END -->

      <!-- <div ></div> -->

      <?php
      include '../sound/pproject/config.php';

      // $sql = "SELECT * FROM song_table WHERE Song_Name LIKE  '{$search_value}%'";
      $sql = "SELECT * FROM song_table";


      $result = mysqli_query($conn, $sql) or die("Query Unsuccessful.");
      $output = "";
      ?>

      <div class="artist_and_song_details">
        <!-- artist pic and name start -->

        <div id="show-search" class="main_div_for_songs">


          <?php
          if (mysqli_num_rows($result) > 0) {

          ?>

          <?php
           // <!-- this code for rating -->


  // Fetch user id
  $User_id = strval($_SESSION['id']);

  // Fetch all songs
  $query = "SELECT * FROM song_table";
  $result = mysqli_query($conn, $query);

  if (!$result) {
    die("Query failed: " . mysqli_error($conn));
  }

  // Fetch rating and average rating for each song
  while ($row = mysqli_fetch_assoc($result)) {
    $Song_id  = $row['Song_id'];

    // Star rating

$query = "SELECT * FROM song_rating WHERE Song_id = " . $Song_id . " and User_id = " . $User_id;
$productResult = mysqli_query($conn, $query);

if (!$productResult) {
  die("Query failed: " . mysqli_error($conn));
}

$getRating = mysqli_fetch_array($productResult);
$rating = ($getRating != null && $getRating['rating'] != null) ? $getRating['rating'] : null;


    // Rating
    $query = "SELECT ROUND(AVG(rating), 1) as numRating FROM song_rating WHERE Song_id = " . $Song_id;
    $avgresult = mysqli_query($conn, $query);

    if (!$avgresult) {
      die("Query failed: " . mysqli_error($conn));
    }

    $fetchAverage = mysqli_fetch_array($avgresult);
    $numRating = $fetchAverage['numRating'];

    if ($numRating <= 0) {
      $numRating = "No&nbspratings&nbspgiven.";
    }

    // Generate HTML for each song
    $output = "<div class='main_song_bar'>
  <div class='song_img'>
    <a id='myBtn' class='songbarplay' id='songbarplay' href='#'>
      <img src='/sound/pproject/admin/{$row["Song_Img"]}' alt='' />
      <audio src='/sound/pproject/admin/{$row["Song_File"]}'></audio>

      <div class='song_title'>
        <h4 class='songplaytitle'>{$row["Song_Name"]}</h4> 
        <div class='song_artist_name_with_song_duration'>
        
          <div class='artist_name'>
            <p>{$row["Artist_Name"]}</p>
          </div>

          <div class='song_duration'>
            {$row["Song_TimeDuration"]}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
          </div>

        </div>


      
      </div>
      <div class='song_id' data-id='{$row["Song_id"]}'></div>
      <div class='card mb-3'>
        <div class='card-body'>
          <!-- 5 Star Rating -->
          <select name='star_rating_option' class='rating' id='star_rating_{$row["Song_id"]}' data-id='rating_{$row["Song_id"]}'>
            <option value='1'>1</option>
            <option value='2'>2</option>
            <option value='3'>3</option>
            <option value='4'>4</option>
            <option value='5'>5</option>
          </select>
         <div class='avgrating'>
         Your&nbspRating&nbsp:&nbsp; <span class='yourrating' id='numeric_rating_{$row["Song_id"]}'>" . ($rating != null ? $rating : $numRating) .  "</span>&nbsp;
         </div>
        <div class='avgrating'>Average&nbspRating&nbsp:&nbsp; <span class='average_rating'>" . ($numRating) .  "</span>
        </div>
        </div>
      </div>
      <i class='playfill bi bi-play-fill' id='1'></i>
    </a>
  </div>
</div>";

              ?>


              





          <?php
              echo "$output";
            }
          }else{
            
          };

          ?>

        </div>

      </div>

    </div>
    <!-- center content end -->

    <!-- bottom with master play start -->
    <div class="bottom">
      <div class="responsive-master-play">

        <!-- wave start -->
        <div class="responsive-none-main waveflex wave">
          <div class="wave1" id="jsactive1"></div>
          <div class="wave2" id="jsactive2"></div>
          <div class="wave3" id="jsactive3"></div>
        </div>
        <!-- /wave end -->
        <!-- poster start -->
        <div class="responsive-none-main masterplay_poster">
          <a href="#" class="poster_master_play">
            <img src="" alt="" class="song_display_poster" />
          </a>

        </div>
        <!-- /poster end -->
        <!-- ----------#######--------- -->

        <!-- Master Play Song Name And artist Name start -->

        <div class="responsive-none-main titleandartist">
          <div class="songtitle">
            <h4 class="songplayname"></h4>
          </div>
          <div>
            <p class="artist"></p>
          </div>
        </div>

        <!-- Master Play Song Name And artist Name End  -->
      </div>

      <!-- main masterplay start -->
      <div class="masterplay">
        <!-- wave start -->
        <div class="responsive-none-media wave">
          <div class="wave1" id="jsactive1"></div>
          <div class="wave2" id="jsactive2"></div>
          <div class="wave3" id="jsactive3"></div>
        </div>
        <!-- /wave end -->
        <!-- ----------#######--------- -->
        <!-- poster start -->
        <div class="responsive-none-media masterplay_poster">
          <a href="#" class="poster_master_play">
            <img src="" alt="" class="song_display_poster" />
          </a>

        </div>
        <!-- /poster end -->
        <!-- ----------#######--------- -->

        <!-- Master Play Song Name And artist Name start -->

        <div class="responsive-none-media titleandartist">
          <div class="songtitle">
            <h4 class="songplayname"></h4>
          </div>
          <div>
            <p class="artist"></p>
          </div>
        </div>

        <!-- Master Play Song Name And artist Name End  -->
        <!-- ----------#######--------- -->

        <!-- play pause icons start -->

        <div class="iconsandrangebar">
          <div class="icons">
            <div class="shuffle">
              <i id="shuffle-btn" class="fa-solid fa-shuffle"></i>
            </div>
            <div class="back">
              <i class="fa-solid fa-backward" id="back"></i>
            </div>
            <div class="play">
              <i class="fa-solid fa-play" id="master_playicon"></i>
              <i class="bi bi-pause" id="pause"></i>
            </div>


            <!-- Audio Main Tag -->
            <a href="" id="songchange">
              <audio id="player" src=""></audio>
            </a>
            <!-- Audio Main Tag -->


            <div class="next">
              <i class="fa-solid fa-forward" id="next"></i>
            </div>
            <div class="repeat">
              <i class="fa-solid fa-repeat"></i>
            </div>
            <div class="download">

              <a id="download-link" href="#" download>
                <i class="fa-solid fa-cloud-arrow-down"> </i>
              </a>

            </div>
          </div>

          <!-- range / seekbar start -->

          <!-- <div class="range"> -->

          <div class="progressbar_withtime">
            <div class="" id="currentime">0:00</div>

            <div class="seek_and_dot">
              <div class="bar2" id="bar2"></div>
              <div class="dot" id="seek_dot"></div>
              <div class="">
                <input class="masterinput" type="range" id="seek" min="0" max="100" />
              </div>
            </div>
            <div class="" id="pasttime">0:00</div>
          </div>
        </div>
        <!-- play pause icons end -->

        <!-- volume start -->
        <div class="volume_main">
          <div class="volume_btn_icon">
            <i class="fa-solid fa-volume-high" id="vol_icon"></i>
          </div>

          <div class="volume_submain">
            <div class="">
              <input class="valrange" type="range" min="0" max="100" id="vol" />
            </div>

            <div class="vol_dot" id="vol_dot"></div>
            <div class="vol_bar" id="vol_bar"></div>
          </div>
        </div>
        <!-- volume end-->

        <!-- /main masterplay end -->
      </div>
      <!-- /bottom -->
    </div>
  </div>








  <!-- bottom with master play end -->
</body>

<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"></script>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="../sound/pproject/js/script.js"></script>
<script src="../sound/pproject/js/livesearch.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bar-rating/1.2.2/jquery.barrating.min.js" integrity="sha512-nUuQ/Dau+I/iyRH0p9sp2CpKY9zrtMQvDUG7iiVY8IBMj8ZL45MnONMbgfpFAdIDb7zS5qEJ7S056oE7f+mCXw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>





<script>
  $('a.songbarplay').click(function() {
    var clickedText = $(this).find('.songplaytitle').text();
    $('.songplayname').text(clickedText);
  });





  $('a.songbarplay').click(function() {
    var clickedText = $(this).find('.artist_name').text();
    $('.artist').text(clickedText);
  });



  // THIS CODE FOR SONG PLAY SELECTED

  // Add click event to all divs with the class 'my-div'

  $('.songbarplay').on('click', function() {

    // Add class to the clicked div

    $(this).addClass('selected');


    // Remove class from other divs with the same class

    $('.songbarplay').not(this).removeClass('selected');


  });


  // THIS CODE FOR SONG PLAY SELECTED
</script>

</html>


<script type='text/javascript'>
    $(document).ready(function() {


      $('#star_rating_<?php echo $Song_id; ?>').barrating('set', <?php echo $rating; ?>);
    });


    $(function() {
      $('.rating').barrating({
        theme: 'fontawesome-stars',
        onSelect: function(value, text, event) {

          var el = this;
          var el_id = el.$elem.data('id');



          if (typeof(event) !== 'undefined') {

            var split_id = el_id.split('_');
            var Song_id = split_id[1];

            $.ajax({
              url: 'ajax_rating.php',
              type: 'POST',
              data: {
                Song_id: Song_id,
                rating: value
              },
              dataType: 'json',
              success: function(data) {
                var average = data['numRating'];
                $('#numeric_rating_' + Song_id).text(average);
              }
            });
          }
        }
      });

    });
  </script>
