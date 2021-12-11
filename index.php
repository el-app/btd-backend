<?php
require 'config/config.php';
define("BASE_URL", dirname($_SERVER['SCRIPT_NAME']));
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
 <style>
     a {
       color: black;
     }
     p {
      font-size: 1.7rem;
      border: 1px solid rgba(0,0,0,.1);
      box-shadow: 0 10px 20px rgba(0,0,0,.22), 0 14px 56px rgba(0,0,0,.25);
     }
     p span:nth-child(1) {
       display: inline-block;
       font-size: 2rem;
       font-weight: 700;
       min-width: 15vw;
       padding: 6px 15px;
       text-align: center;
       color: #fff;
     }
     p span:nth-child(2) {
      font-size: 1.8rem;
      font-weight: 700;
      margin-left: 1rem;
     }
     .method { padding: 20px; }
     .get, .post, .put, .delete { text-transform: uppercase; }
     .get { background-color: #026F87; }
     .post { background-color: #93D9C6; }
     .put { background-color: #ECC905; }
     .delete { background-color: #f93e3e; }
     nav.navbar { background-color: #026F87 !important; }

 </style>
    <title>BTD API</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <a class="navbar-brand" href="#">API INSTITUT BEAUTE DIVINE</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <div class="container">
    <?php
        foreach ($_ROUTES as $entity => $ref) {
            $response = "<div id='$entity' class='method'><h4>".ucwords($entity)."</h4>";

            foreach ($CRUD as $method => $description) {
              $response .= "<p><span class='$method'> $method </span> 
              <span class='url'>
                <a href='".BASE_URL."/api/$entity'target='_blank'>/api/$entity</a>
              </span> 
              ".$description['description'];

              $response .= ($method !== 'get') ? $ref['one'] : $ref['all'];
            }

            echo $response.'</p></div>';
        }
    ?>
</body>
</html>