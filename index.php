<?php

namespace Pixelink\Flapit;

require_once ('classes/FlapIt.php');

// if ajax is fired
if (isset($_GET['update'])) {
    new flapItCounter("1234", "tok3n", "thanks_de");
}

?>


<!DOCTYPE html>
<html>
  <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css">
      <link href="assets/css/styles.css" rel="stylesheet"  type="text/css">
  </head>

  <body>

  <span id="sendUpdate" class="button">
     <span>Add one ... +1</span>
  </span>

  <script src="assets/js/main.js"></script>
  </body>
</html>
