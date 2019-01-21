<?php
session_start();
$_SESSION['web'] = true;

$utm_source = isset($_GET['utm_source']) && $_GET['utm_source']!='' ? $_GET['utm_source'] : '' ;
$utm_medium = isset($_GET['utm_medium']) && $_GET['utm_medium']!='' ? $_GET['utm_medium'] : '' ;
$utm_campaign = isset($_GET['utm_campaign']) && $_GET['utm_campaign']!='' ? $_GET['utm_campaign'] : '' ;
$utm_term = isset($_GET['utm_term']) && $_GET['utm_term']!='' ? $_GET['utm_term'] : '' ;
$utm_content = isset($_GET['utm_content']) && $_GET['utm_content']!='' ? $_GET['utm_content'] : '' ;
$gclid = isset($_GET['gclid']) && $_GET['gclid']!='' ? $_GET['gclid'] : '' ;
?>
<!doctype html>
<html class="no-js" lang="es">
    <head prefix="og: http://ogp.me/ns#">
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>HAVAS Perú - Servicios de Comunicación Integral</title>
        <meta name="description" content="">
        <meta name="kerwords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta property="og:url" content="" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="" />
        <meta property="og:description" content="" />
        <meta property="og:image" content="" />
    
        <link rel="shortcut icon" href="favicon.ico" />  
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="stylesheet" href="css/main.css?v=<?php echo uniqid(); ?>">
        
    </head>
    <body>
    <div id="page">
        
        <div class="header">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#"></a><img src="/images/havas-group.png" class="img-fluid"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                    
                    </ul>
                
                </div>
            </nav>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-5">
                <form>
                    <div class="form-group">
                        <label for="email">Nombre</label>
                        <input type="texto" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Nombre">
                        
                    </div>

                    <div class="form-group">
                        <label for="email">Email </label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email">
                        
                    </div>

                    <div class="form-group">
                        <label for="asunto">Asunto </label>
                        <input type="text" class="form-control" id="asunto" aria-describedby="emailHelp" placeholder="Asunto                                                         ">
                        
                    </div>

                    <div class="form-group">
                        <label for="email">Mensaje </label>
                        <textarea class="form-control">
                        
                        </textarea>
                    </div>
                                                                           
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                    
                </div>

                <div class="col-md-5">
                   
                    <iframe src="https://www.google.com/maps/d/u/0/embed?mid=zrkL0WyjpjMA.k54ENs_pmXSw" width="640" height="480"></iframe>
                </div>
            </div>
        </div>
    </div>
       

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
       
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"
  type="text/javascript"></script>

        <script src="main.js?v=<?php echo uniqid(); ?>"></script>
        <script>
        // Initialize and add the map
            function initMap() {
            // The location of Uluru
            var uluru = {lat: -25.344, lng: 131.036};
            // The map, centered at Uluru
            var map = new google.maps.Map(
                document.getElementById('map'), {zoom: 4, center: uluru});
            // The marker, positioned at Uluru
            var marker = new google.maps.Marker({position: uluru, map: map});
            }
    </script>
   
    </body>
</html>