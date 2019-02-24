<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Start</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdn.rawgit.com/monkeecreate/jquery.simpleWeather/master/jquery.simpleWeather.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

        <style>
            body { font-size: 150%; background-color: #111; color: #999; }
            a:visited { color: #f3f3f3; text-decoration:none; }
            a:hover { color: #f3f3f3; text-decoration:none; }
            a:active { color: #f3f3f3; text-decoration:none; }
            a { color: #f3f3f3; text-decoration:none; }
            h2 { color: #999; }
            .nav-tabs { border-bottom: 0px solid #ddd; }
            .slices {padding-left:0px!important;padding-right:0px!important;padding-bottom:12px;}
            .round {border-radius:5px;}
            img {
    /* filter: url(filters.svg#grayscale); Firefox 3.5+ */
      filter: gray; /* IE5+ */
      -webkit-filter: grayscale(1); /* Webkit Nightlies & Chrome Canary */
      -webkit-transition: all .2s ease-in-out;  
    }

    img:hover {
    filter: none;
      -webkit-filter: grayscale(0);
      -webkit-transform: scale(1.00);
    }
        </style>
        <script>
        $(document).ready(function(){
   setInterval('updateClock()', 1000);
});

function updateClock (){
 	var currentTime = new Date ( );
  	var currentHours = currentTime.getHours ( );
  	var currentMinutes = currentTime.getMinutes ( );
  	var currentSeconds = currentTime.getSeconds ( );

  	// Pad the minutes and seconds with leading zeros, if required
  	currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
  	currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;

  	// Choose either "AM" or "PM" as appropriate
  	var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";

  	// Convert the hours component to 12-hour format if needed
  	currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;

  	// Convert an hours component of "0" to "12"
  	currentHours = ( currentHours == 0 ) ? 12 : currentHours;

  	// Compose the string for display
  	var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
  	
  	
   	$("#clock").html(currentTimeString);	  	
 }
 </script>

    </head>
    <body>
    
        <div class="container">
            <div class="row">
                <div class="col-md-8">


                        <?php 
                    $newsSource = array(
                        array(
                            "title" => "BBC",
                            "url" => "http://feeds.bbci.co.uk/news/rss.xml?edition=us"
                        ),
                        array(
                            "title" => "CNN",
                            "url" => "http://rss.cnn.com/rss/cnn_topstories.rss"
                        ),
                        array(
                            "title" => "NPR News",
                            "url" => "https://www.npr.org/rss/rss.php?id=1001"
                        ),
                        array(
                            "title" => "Reuters World News",
                            "url" => "http://feeds.reuters.com/Reuters/worldNews"
                        )

                    );
                    function printFeed($url){
                        $rss = simplexml_load_file($url);
                        $count = 0;
                        print '<ul>';
                        foreach($rss->channel->item as$item) {
                            $count++;
                            if($count > 7){
                                break;
                            }
                            print '<li><a target="_blank" href="'.$item->link.'">'.$item->title.'</a></li>';
                        }
                        print '</ul>';
                    }
                    foreach($newsSource as $source) {
                        print '<h2>'.$source["title"].'</h2>';
                        printFeed($source["url"]);
                    }
                ?> 

                </div>
                <div class="col-md-4" style="margin-top:20px;">
                
                            <div style="font-size:55px; height:50px; margin-bottom:30px;" id="clock"></div>
                            <div class="col-md-12" style="padding-left:0px;padding-right:0px;padding-top:0px;padding-bottom:0px;margin-bottom:10px;">
                                    <?php
                                    print ($_SERVER['REMOTE_ADDR']);
                                    $ip = $_SERVER['REMOTE_ADDR'];
                                    $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
                                    print (" | ");
                                    echo $details->city; // -> "Mountain View"
                                    print (", ");
                                    echo $details->region;
                                    ?>
                            </div>
                            <br /><br />
                            <div class="col-md-6 slices">
                            <a href="https://www.google.com/"><img src="slices/google.png" height="35" width="170" class="round" /></a>
                            </div>
                            <div class="col-md-6 slices">
                            <a href="https://www.youtube.com"><img src="slices/youtube.png" height="35" width="170" class="round" /></a>
                            </div>
                            <div class="col-md-6 slices">
                            <a href="https://www.duckduckgo.com"><img src="slices/duckduckgo.png" height="35" width="170" class="round" /></a>
                            </div>
                            <div class="col-md-6 slices">
                            <a href="https://www.netflix.com"><img src="slices/netflix.png" height="35" width="170" class="round" /></a>
                            </div>
                            <div class="col-md-6 slices">
                            <a href="https://www.gmail.com"><img src="slices/gmail.png" height="35" width="170" class="round" /></a>
                            </div>
                            <div class="col-md-6 slices">
                            <a href="http://127.0.0.1:32400/web/index.html"><img src="slices/plex.png" height="35" width="170" class="round" /></a>
                            </div>
                            <div class="col-md-6 slices">
                            <a href="https://play.google.com/music/"><img src="slices/playmusic.png" height="35" width="170" class="round" /></a>
                            </div>
                            <div class="col-md-6 slices">
                            <a href="https://thepiratebay.org/"><img src="slices/piratebay.png" height="35" width="170" class="round" /></a>
                            </div>
                            <div class="col-md-6 slices">
                            <a href="https://rarbg.to/"><img src="slices/rarbg.png" height="35" width="170" class="round" /></a>
                            </div>
                            <div class="col-md-6 slices">
                            <a href="https://1337x.to/"><img src="slices/1337.png" height="35" width="170" class="round" /></a>
                            </div>
                            <div class="col-md-6 slices">
                            <a href="http://audiobookbay.nl/"><img src="slices/audiobook.png" height="35" width="170" class="round" /></a>
                            </div>
                            <div class="col-md-6 slices">
                            <a href="https://snowfl.com/"><img src="slices/snowfl.png" height="35" width="170" class="round" /></a>
                            </div>
                            <div class="col-md-6 slices">
                            <a href="https://www.limetorrents.info/"><img src="slices/limetorrents.png" height="35" width="170" class="round" /></a>
                            </div>                            
                            <div class="col-md-6 slices">
                            <a href="https://reddit.com/"><img src="slices/reddit.png" height="35" width="170" class="round" /></a>
                            </div>
                            <div class="col-md-6 slices">
                            <a href="https://en.wikipedia.org/wiki/Special:Random"><img src="slices/wikipedia.png" height="35" width="170" class="round" /></a>
                            </div>
                            <div class="col-md-6 slices">
                            <a href="https://www.atlasobscura.com/random"><img src="slices/atlas.png" height="35" width="170" class="round" /></a>
                            </div>
                            <div class="col-md-6 slices">
                            <a href="https://messages.android.com/"><img src="slices/messages.png" height="35" width="170" class="round" /></a>
                            </div>

			    </div>
                
                
                </div>
            </div>
        </div>
    </body>
</html>
