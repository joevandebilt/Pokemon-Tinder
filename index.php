<?php session_start() ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PokeSwipe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="./style.css" rel="stylesheet">    
</head>
  <body>
  
    <div class="content-window">
      <div class="card">
        <div class="card-images">
          <div class="card-image-container">
            <img class="card-image" src="">
          </div>
          <div class="card-image-controls d-flex flex-row justify-content-between">
            <button type="button" class="btn btn-secondary image-control prev-image" onclick="ChangeImage(-1);"><i class="fa-solid fa-chevron-left"></i></button>
            <button type="button" class="btn btn-secondary image-control next-image" onclick="ChangeImage(1);"><i class="fa-solid fa-chevron-right"></i></button>
          </div>
        </div>
        <div class="card-meta">
          <h3 class="card-name"></h3>
          <div class="card-height"></div>
          <div class="card-weight"></div>
        </div>
      </div>
      <div class="controls d-flex flex-row justify-content-between">
          <button class="btn btn-danger btn-lg" onclick="Swipe(false);"><i class="fa-solid fa-x"></i></button>
          <button class="btn btn-success btn-lg" onclick="Swipe(true);"><i class="fa-solid fa-check"></i></button>
      </div>
  </div>
    

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="./scripts.js" type="text/javascript"></script>
  </body>
</html>