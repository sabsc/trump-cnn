<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Trump and CNN</title>
  <meta name="description" content="The relationship between President Donald Trump and CNN. See what the public is saying.">
  <meta name="author" content="Sabrina Cheung">
  <link rel="icon" 
      type="image/png" 
      href="favicon.ico">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <link rel="stylesheet" href="css/styles.css">
  <script type='text/javascript' src='config.js'></script>

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<header></header>

<body>

    
    <h1>The War Between Trump and CNN</h1>
    <p id="author">By Sabrina Cheung</p>
    <p>President Donald Trump and CNN have an ongoing "Twitter war," and it actually carries significance beyond Internet memes.</p>
    <img class="img-fluid" src="trump-beat-cnn.png"/>
    <p class="brief-desc">Trump retweeting a video of him physically assaulting CNN.</p>
    
    
    <h2>How Trump and CNN Feel About Each Other</h2>
    <p>Trump and CNN often use langauge that indicates distaste toward each other. </p>
    <p>Does Trump really attack CNN, and does CNN really report neutrally&#63; This can be analyzed using <a href="https://aylien.com/"  target="_blank">Aylien</a>, a sentiment analysis program based on natural language.</p>
    <p>Aylien provides a positive or negative rating on the text, with a confidence score between 0 (not confident) to 1 (100% accurate). Don't believe it? Read tweets for yourself.</p>
    <h3>What Trump Has to Say About CNN</h3>
    <p>If Trump mentioned "CNN" in his most recent tweets from personal account (<a href="https://twitter.com/realDonaldTrump"  target="_blank">@realDonaldTrump</a>), they'll populate below with sentiment analysis.</p>
    
    <?php


    define('APPLICATION_ID', "2e900f1f");
    define('APPLICATION_KEY', "4fb1928e8f38b978bf5ab45ff7082ce0");

    function call_api($endpoint, $parameters) {
      $ch = curl_init('https://api.aylien.com/api/v1/' . $endpoint);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Accept: application/json',
        'X-AYLIEN-TextAPI-Application-Key: ' . APPLICATION_KEY,
        'X-AYLIEN-TextAPI-Application-ID: '. APPLICATION_ID
      ));
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
      $response = curl_exec($ch);
      return json_decode($response);
    }

    $endpoints = array("sentiment", "classify");


    ini_set('display_errors', 1);
    require_once('TwitterAPIExchange.php');

    /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
    $settings = array(
        'oauth_access_token' => "1353114230-UQLo6V2BHBB3L2BR6uljn0WhMD7EdY5r7M5Na4W",
        'oauth_access_token_secret' => "3wEZPIZGl3JrALtWTYomfzOHoIDMgxSgOvC6yeBS3Xsjt",
        'consumer_key' => "pWAT8SRJfVhmvUCFCyoCNYHu1",
        'consumer_secret' => "2DlRxbJlisKrCWJyxzOzpgrrkckrIU1PO5O7Xovvi8NEf59Q68"
    );

    $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
    $getfield = '?screen_name=realDonaldTrump&count=150&tweet_mode=extended';
    $requestMethod = 'GET';
    $twitter = new TwitterAPIExchange($settings);
    $tweetData = json_decode( $twitter->setGetfield($getfield)
                 ->buildOauth($url, $requestMethod)
                 ->performRequest(),$assoc=TRUE);

    

    foreach($tweetData as $index => $items){
        $userArray = $items['user'];
        $tweet = $items['full_text'];
        $dates = $items['created_at'];
        if (stristr($items['full_text'], "CNN")){

            echo '<div class="each-tweet">';
            echo '<div class="row">';
            echo '<div class="col-lg-1">';
            echo '<a href="https://twitter.com/'.$userArray['screen_name'].'"  target="_blank">'.'<img class="icon" src="'.$userArray['profile_image_url_https'].'"/></a>';
            echo '</div><div class="col-lg-11">';
            echo '<div class="tweet-text">';

            echo "<b>".$userArray['name']."</b>";

            echo ' ('.'<a href="https://twitter.com/'.$userArray['screen_name'].'"  target="_blank">'.'@'.$userArray['screen_name'].'</a>)<br>';

            echo '<span class="dates"><a href="https://twitter.com/'.$userArray['screen_name'].'\/status/'.$items["id_str"].'">'.$dates.'</span></a>';
            echo '<p class="tweet">'.$items['full_text']."</p>";

            // foreach($endpoints as $endpoint)
            //   {
            //     switch($endpoint){
            //       case "sentiment":
            //       {
            //         $params = array('text' => $items['full_text']);
            //         $sentiment = call_api('sentiment', $params);
            //         if(stristr(sprintf("%s", $sentiment->polarity), "negative")){
            //         echo '<div class="sentiment">';
            //         echo sprintf('Sentiment: %s (%F'." confidence) 
            // ", $sentiment->polarity, $sentiment->polarity_confidence);
            //         echo '</div>';
            //         } else if(stristr(sprintf("%s", $sentiment->polarity), "positive")){
            //         echo '<div class="sentiment3">';
            //         echo sprintf('Sentiment: %s (%F'." confidence) 
            // ", $sentiment->polarity, $sentiment->polarity_confidence);
            //         echo '</div>';
            //         } else if(stristr(sprintf("%s", $sentiment->polarity), "neutral")){
            //         echo '<div class="sentiment2">';
            //         echo sprintf('Sentiment: %s (%F'." confidence) 
            // ", $sentiment->polarity, $sentiment->polarity_confidence);
            //         echo '</div>';
            //         }

            //         break;
            //       }
                  
                  
            //     }

            // }
        }


        echo "</div></div></div></div>";
        
    }

    // echo '</div>';

    ?>




    <br>
    <h3>What CNN Has to Say About Trump</h3>
    <p>On the flipside, if CNN mentioned "Trump" recently from their main account (<a href="https://twitter.com/CNN"  target="_blank">@CNN</a>), international account (<a href="https://twitter.com/CNNi"  target="_blank">@CNNi</a>) or breaking news account (<a href="https://twitter.com/CNNbrk"  target="_blank">@CNNbrk</a>), they'll populate below with sentiment analysis.</p>
    <p>Thirty tweets at maximum are analyzed in order to not reach the cap that Aylien allows. CNN tends to mention Trump more than Trump mentions CNN, as CNN is a news network.</p>

    <?php

    
    ini_set('display_errors', 1);
    require_once('TwitterAPIExchange.php');

    /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
    $settings = array(
        'oauth_access_token' => "1353114230-UQLo6V2BHBB3L2BR6uljn0WhMD7EdY5r7M5Na4W",
        'oauth_access_token_secret' => "3wEZPIZGl3JrALtWTYomfzOHoIDMgxSgOvC6yeBS3Xsjt",
        'consumer_key' => "pWAT8SRJfVhmvUCFCyoCNYHu1",
        'consumer_secret' => "2DlRxbJlisKrCWJyxzOzpgrrkckrIU1PO5O7Xovvi8NEf59Q68"
    );

    $url = 'https://api.twitter.com/1.1/lists/statuses.json';
    $getfield = '?owner_screen_name=_sabcheung&count=50&slug=cnn&tweet_mode=extended';
    $requestMethod = 'GET';
    $twitter = new TwitterAPIExchange($settings);
    $tweetData = json_decode( $twitter->setGetfield($getfield)
                 ->buildOauth($url, $requestMethod)
                 ->performRequest(),$assoc=TRUE);


    foreach($tweetData as $index => $items){
        $userArray = $items['user'];
        $tweet = $items['full_text'];
        if (stristr($items['full_text'], "Trump")){

            echo '<div class="each-tweet">';
            echo '<div class="row">';
            echo '<div class="col-lg-1">';
            echo '<a href="https://twitter.com/'.$userArray['screen_name'].'"  target="_blank">'.'<img class="icon" src="'.$userArray['profile_image_url_https'].'"/></a>';
            echo '</div><div class="col-lg-11">';
            echo '<div class="tweet-text">';
            echo "<b>".$userArray['name']."</b>";

            echo ' ('.'<a href="https://twitter.com/'.$userArray['screen_name'].'" target="_blank">'.'@'.$userArray['screen_name'].'</a>)<br/>';

            echo '<span class="dates"><a href="https://twitter.com/'.$userArray['screen_name'].'\/status/'.$items["id_str"].'">'.$dates.'</span></a>';

            echo '<p class="tweet">'.$items['full_text']."</p>";

            // foreach($endpoints as $endpoint)
            //   {
            //     switch($endpoint){
            //       case "sentiment":
            //       {
            //         $params = array('text' => $items['full_text']);
            //         $sentiment = call_api('sentiment', $params);
            //         if(stristr(sprintf("%s", $sentiment->polarity), "negative")){
            //         echo '<div class="sentiment">';
            //         echo sprintf('Sentiment: %s (%F'." confidence) 
            // ", $sentiment->polarity, $sentiment->polarity_confidence);
            //         echo '</div>';
            //         } else if(stristr(sprintf("%s", $sentiment->polarity), "positive")){
            //         echo '<div class="sentiment3">';
            //         echo sprintf('Sentiment: %s (%F'." confidence) 
            // ", $sentiment->polarity, $sentiment->polarity_confidence);
            //         echo '</div>';
            //         } else if(stristr(sprintf("%s", $sentiment->polarity), "neutral")){
            //         echo '<div class="sentiment2">';
            //         echo sprintf('Sentiment: %s (%F'." confidence) 
            // ", $sentiment->polarity, $sentiment->polarity_confidence);
            //         echo '</div>';
            //         }
            //         break;
            //       }
                  
                  
            //     }

            // }
        }


        echo "</div></div></div></div>";
        
    }


    ?>

    <br><br>

    <h2>Public Sentiment</h2>
    <h3 id="live-feed">Live Feed</h3>
    
    


    <?php
    ini_set('display_errors', 1);
    require_once('TwitterAPIExchange.php');

    /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
    $settings = array(
        'oauth_access_token' => "1353114230-UQLo6V2BHBB3L2BR6uljn0WhMD7EdY5r7M5Na4W",
        'oauth_access_token_secret' => "3wEZPIZGl3JrALtWTYomfzOHoIDMgxSgOvC6yeBS3Xsjt",
        'consumer_key' => "pWAT8SRJfVhmvUCFCyoCNYHu1",
        'consumer_secret' => "2DlRxbJlisKrCWJyxzOzpgrrkckrIU1PO5O7Xovvi8NEf59Q68"
    );

    $url = 'https://api.twitter.com/1.1/search/tweets.json';
    $getfield = '?q=trump+cnn&count=20&tweet_mode=extended';
    $requestMethod = 'GET';
    $twitter = new TwitterAPIExchange($settings);
    $tweetData = json_decode( $twitter->setGetfield($getfield)
                 ->buildOauth($url, $requestMethod)
                 ->performRequest(),$assoc=TRUE);
    $polarizedCount = 0;

    // echo $tweetData; 
    echo '<p>Here are the most recent tweets that include "Trump" or "CNN," including mentions. These tweets are often polarized. Tweets that include "fake," "fradulent", "lie," "lying," "stupid" or "idiot" are highlighted.*</p>';
    echo '<div class="public-tweet-display" id="livefeed">';

    

    foreach($tweetData['statuses'] as $index => $items){
       // if(!stristr($items['text'], 'RT @')){

            if(stristr(strtolower($items['full_text']), 'fake') or stristr(strtolower($items['full_text']), 'fradulent') or stristr(strtolower($items['full_text']), ' lie') or stristr(strtolower($items['full_text']), 'lying') or stristr(strtolower($items['full_text']), 'stupid') or stristr(strtolower($items['full_text']), 'idiot')){

                $userArray=$items['user'];
                echo '<div class="each-tweet">';
                echo '<div class="highlight">';
                echo '<div class="row">';
                echo '<div class="col-lg-1">';
                echo '<a href="https://twitter.com/'.$userArray['screen_name'].'" target="_blank">'.'<img class="icon" src="'.$userArray['profile_image_url_https'].'"/></a>';
                echo '</div><div class="col-lg-11">';
                echo '<div class="tweet-text">';
                echo "<b>".$userArray['name']."</b>";

                echo ' ('.'<a href="https://twitter.com/'.$userArray['screen_name'].'"  target="_blank">'.'@'.$userArray['screen_name'].'</a>)<br/>';
                echo '<span class="dates"><a href="https://twitter.com/'.$userArray['screen_name'].'\/status/'.$items["id_str"].'">'.$dates.'</span></a>';
                echo '<p class="tweet">'.$items['full_text']."</p>";

                echo "</div></div></div></div></div>";
                $polarizedCount += 1;


                

            } else {
                $userArray=$items['user'];
                echo '<div class="each-tweet">';
                echo '<div class="row">';
                echo '<div class="col-lg-1">';
                echo '<a href="https://twitter.com/'.$userArray['screen_name'].'" target="_blank">'.'<img class="icon" src="'.$userArray['profile_image_url_https'].'"/></a>';
                echo '</div><div class="col-lg-11">';
                echo '<div class="tweet-text">';
                echo "<b>".$userArray['name']."</b>";

                echo ' ('.'<a href="https://twitter.com/'.$userArray['screen_name'].'" target="_blank">'.'@'.$userArray['screen_name'].'</a>)<br/>';
                echo '<span class="dates"><a href="https://twitter.com/'.$userArray['screen_name'].'\/status/'.$items["id_str"].'">'.$dates.'</span></a>';
                echo '<p class="tweet">'.$items['full_text']."</p>";

                echo "</div></div></div></div>";
            }
        
       // }
    }
    echo '</div>';
    echo '<i class="polarized-subtext">*There are currently <b>'.$polarizedCount.'</b> of these tweets displayed. If there are not many now, refresh in a few minutes.</i>';



    echo '<br>';


    ?>

    <?php

    ?>


    <br><br>

    <h2>The Size of CNN</h2>
    <p>CNN is one of the largest news companies in both the United States and the world. Given CNN's size, Trump saying CNN is fradulent without solid evidence could be interpreted as an attack on journalism.</p>
    <p>Here are the locations of CNN's bureaus for context. Headquarters are shown as stars, with the world headquarters in red.</p>


    <div id="map"></div>
    <br><br>
    <h2>Implications</h2>
    <p>The Twitter war between Trump and CNN indicate more than just the tensions that stemmed from the 2016 national elections. They're symptomatic of a larger problem.</p>
    <p>On the other hand, one could consider that CNN wasn't flourishing before the 2016 national elections. In a "<a href="https://www.nytimes.com/2017/04/04/magazine/cnn-had-a-problem-donald-trump-solved-it.html" target="_blank">weird symbiosis</a>," giving Trump media attention helped CNN regain footing. Could that mean that Trump's comments aren't a bad thing after all?</p>
    <p>Probably not. Trump tweets <a href="http://beta.latimes.com/nation/la-na-pol-trump-mock-beating-20170702-story.html" target="_blank">videos of CNN getting beat up</a>. CNN <a href="https://www.usatoday.com/story/news/politics/onpolitics/2017/11/28/cnn-boycott-white-house-christmas-party-politico-reports/903618001/" target="_blank">boycotts</a> the White House Christmas party. One of these actions is violent and encourages the American public to be violent.</p>
    <p>Look again at the tweets from the <a href="#livefeed">live feed</a>. Many users accuse CNN of being "fake." Although most commonly directed toward CNN, many other media outlets have been called "fake news." There is a larger-scale devaluation of journalism. People are feeling more inclined to call news "fake" simply because they don't like it.</p>
    <p>Finally, the Trump-CNN feud is indication that the public is becoming more polarized. Many tweets in the live feed are intense. People type in capital letters and swear. Journalism is getting caught in the crossfire. &#9608;</p>
    <br><br>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script src="tweetLinkIt.js"></script>
    <script>
          $('.tweet').tweetLinkify();
    </script>
    <script>
      function initMap() {
        var atlanta = {lat: 33.749, lng: -84.388};

        var icons = {
            world_hq: {
                icon: {
                    path: 'M 125,5 155,90 245,90 175,145 200,230 125,180 50,230 75,145 5,90 95,90 z',
                    fillColor: '#ef6e62',
                    fillOpacity: 0.8,
                    scale: .13,
                    strokeColor: '#a81205',
                    strokeWeight: 2
                }
            },

            hq: {
                icon: {
                    path: 'M 125,5 155,90 245,90 175,145 200,230 125,180 50,230 75,145 5,90 95,90 z',
                    fillColor: '#ceaded',
                    fillOpacity: 0.8,
                    scale: .13,
                    strokeColor: '#7e47b2',
                    strokeWeight: 2
                }
            },

            loc: {
                icon: {
                    path: 'M 100, 100 m -75, 0 a 75,75 0 1,0 150,0 a 75,75 0 1,0 -150,0',
                    fillColor: '#ceaded',
                    fillOpacity: 0.8,
                    scale: .1,
                    strokeColor: '#7e47b2',
                    strokeWeight: 2
                }
            }
        };

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: atlanta
        });

        var features = [
            {
                name: 'Atlanta',
                position: new google.maps.LatLng(33.749, -84.388),
                type: 'world_hq'
            },
            {
                name: 'Abu Dhabi',
                position: new google.maps.LatLng(24.4539, 54.3773),
                type: 'hq'
            },
            {
                name: 'Hong Kong',
                position: new google.maps.LatLng(22.3964, 114.1095),
                type: 'hq'
            },
            {
                name: 'London',
                position: new google.maps.LatLng(51.5074, 0.1278),
                type: 'hq'
            },
            {
                name: 'Chicago',
                position: new google.maps.LatLng(41.8781, -87.6298),
                type: 'loc'
            },
            {
                name: 'Dallas',
                position: new google.maps.LatLng(32.7767, -96.7970),
                type: 'loc'
            },
            {
                name: 'Denver',
                position: new google.maps.LatLng(39.7392, -104.9903),
                type: 'loc'
            },
            {
                name: 'Los Angeles',
                position: new google.maps.LatLng(34.0522, -118.2437),
                type: 'loc'
            },
            {
                name: 'Miami',
                position: new google.maps.LatLng(25.7617, -80.1918),
                type: 'loc'
            },
            {
                name: 'New York',
                position: new google.maps.LatLng(40.7128, -74.0060),
                type: 'loc'
            },
            {
                name: 'Silicon Valley',
                position: new google.maps.LatLng(37.3875, -122.0575),
                type: 'loc'
            },
            {
                name: 'Washington, D.C.',
                position: new google.maps.LatLng(38.9072, -77.0369),
                type: 'loc'
            },
            {
                name: 'Amman',
                position: new google.maps.LatLng(31.9454, 35.9284),
                type: 'loc'
            },
            {
                name: 'Bangkok',
                position: new google.maps.LatLng(13.7563, 100.5018),
                type: 'loc'
            },
            {
                name: 'Beijing',
                position: new google.maps.LatLng(39.9042, 116.4074),
                type: 'loc'
            },
            {
                name: 'Beirut',
                position: new google.maps.LatLng(33.8938, 35.5018),
                type: 'loc'
            },
            {
                name:  'Berlin',
                position: new google.maps.LatLng(52.5200, 13.4050),
                type: 'loc'
            },
            {
                name: 'Buenos Aires',
                position: new google.maps.LatLng(-34.6037, -58.3816),
                type: 'loc'
            },
            {
                name: 'Cairo',
                position: new google.maps.LatLng(30.0444, 31.2357),
                type: 'loc'
            },
            {
                name: 'Dubai',
                position: new google.maps.LatLng(25.2048,  55.2708),
                type: 'loc'
            },
            {
                name: 'Havana',
                position: new google.maps.LatLng(23.1136, 82.3666),
                type: 'loc'
            },
            {
                name: 'Islamabad',
                position: new google.maps.LatLng(33.7294, 73.0931),
                type: 'loc'
            },
            {
                name: 'Istanbul',
                position: new google.maps.LatLng(41.0082, 28.9784),
                type: 'loc'
            },
            {
                name: 'Jerusalem',
                position: new google.maps.LatLng(31.7683, 35.2137),
                type: 'loc'
            },
            {
                name: 'Johannesburg',
                position: new google.maps.LatLng(-26.2041, 28.0473),
                type: 'loc'
            },
            {
                name: 'Kabul',
                position: new google.maps.LatLng(34.5553, 69.2075),
                type: 'loc'
            },
            {
                name: 'Lagos',
                position: new google.maps.LatLng(6.5244, 3.3792),
                type: 'loc'
            },
            {
                name: 'Madrid',
                position: new google.maps.LatLng(40.4168, -3.7038),
                type: 'loc'
            },
            {
                name: 'Mexico City',
                position: new google.maps.LatLng(19.4326, -99.1332),
                type: 'loc'
            },
            {
                name: 'Moscow',
                position: new google.maps.LatLng(55.7558, 37.6173),
                type: 'loc'
            },
            {
                name: 'Mumbai',
                position: new google.maps.LatLng(19.0760, 72.8777),
                type: 'loc'
            },
            {
                name: 'Nairobi',
                position: new google.maps.LatLng(-1.2921, 36.8219),
                type: 'loc'
            },
            {
                name: 'New Delhi',
                position: new google.maps.LatLng(28.6139, 77.2090),
                type: 'loc'
            },
            {
                name: 'Paris',
                position: new google.maps.LatLng(48.8566, 2.3522),
                type: 'loc'
            },
            {
                name: 'Rome',
                position: new google.maps.LatLng(41.9028, 12.4964),
                type: 'loc'
            },
            {
                name: 'Santiago',
                position: new google.maps.LatLng(-33.4489, -70.6693),
                type: 'loc'
            },
            {
                name: 'Seoul',
                position: new google.maps.LatLng(37.5665, 126.9780),
                type: 'loc'
            },
            {
                name: 'Tokyo',
                position: new google.maps.LatLng(35.6895, 139.6917),
                type: 'loc'
            }



        ];



        features.forEach(function(feature) {
            var marker = new google.maps.Marker({
                position: feature.position,
                icon: icons[feature.type].icon,
                title: feature.name,
                map: map
            });

            var infowindow = new google.maps.InfoWindow({
                content: marker.title
            });


            marker.addListener('mouseover', function() {
                infowindow.open(map, marker);
            });

            marker.addListener('mouseout', function(){
                infowindow.close();
            });

            marker.addListener('click', function() {
                map.setZoom(6);
                map.setCenter(marker.getPosition());
            });
        });
      }
    </script>
    
    <script async defer
    src='https://maps.googleapis.com/maps/api/js?key=AIzaSyD1vcE_G8Mo8vCzA_yn1vRBNblprUpV7Zw&callback=initMap'>
    </script>
    
</body>
</html>




