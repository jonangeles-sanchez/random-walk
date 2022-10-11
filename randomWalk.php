<!DOCTYPE html>

<html lang="en-US">

<head>

  <?php
  include "randomWalkFunctions.php";
  ?>

  <?php
  $gridSize = intval($_POST['gridSize']);
  $walkLength = intval($_POST['walkLength']);
  $seed = intval($_POST['seed']);
  $grid = initializeGrid($gridSize); //fill the grid with dots

  if ($seed)
    mt_srand($seed);
  else {
    $seed = mt_rand();
    mt_srand($seed);
  }
  ?>

  <meta charset="utf-8">

  <title>Random Walk Generator</title>

  <style>
    button a {
      text-decoration: none;
      color: black;
    }

    button a:hover {
      cursor: inherit;
    }

    pre {
      font-family: monospace;
    }

    p {
      font-size: 100%;
    }

    sub {
      font-size: 50%;
    }

    #results {
      /* border:2px blue solid;*/

      margin-top: 30px;
      padding: 20px;

    }

    <?php

    if (!$gridSize) {
      echo "#results{display:none;}";
    }

    ?>
  </style>

</head>

<body>
  <h1>Random Walk Generator</h1>

  <form action="<?php echo basename($_SERVER['PHP_SELF']); ?>" method="POST">

    Create a walk of up to length

    <select name="walkLength">

      <?php
      for ($val = 1; $val <= 10; $val++) {
        echo "<option value=\"" . $val . "\"";

        if ($val == $walkLength)
          echo "selected=\"selected\"";

        echo ">" . $val . "</option>\n";
      }


      ?>
    </select>


    on a grid of size

    <select name="gridSize">
      <?php
      for ($val = 1; $val <= 25; $val++) {
        echo "<option value=\"" . $val . "\"";

        if ($val == $gridSize)
          echo "selected=\"selected\"";

        echo ">" . $val . "</option>\n";
      }
      ?>
    </select>

    with a random seed of


    <input type="text" name="seed">

    <button type="submit" value="Submit">Submit</button>
    <button type="button"><a href="<?php echo basename($_SERVER['PHP_SELF']); ?>">Reset</a></button>
  </form>

  <div id="results">

  <?php
  //calculateWalk($gridSize, $walkLength);
  ?>
  
  
    <?php
    

    
    echo "Seed = " . $seed . "\n";

    $first = true;

    $row = mt_rand() % $gridSize;
    $col = mt_rand() % $gridSize;

    $alphabet = str_split("ABCDEFGHIJKLMNOPQRSTUVWXYZ");

    $grid[$row][$col] = $alphabet[0]; //set first 'A' in grid

    for ($n = 0; $n < $walkLength; $n++) { //for as many times as they want the alphabet repeated

      for ($letter = 0; $letter < 26; $letter++) { //make a path with the alphabet

        if ($first) { //if this is the first 'A' of all
          $first = false;
          $letter = 1;
        }
        $taken = checkDirections($row, $col, $gridSize, $grid);

        if (allTaken($taken)) { //spans through to next php block
          printGrid($gridSize, $grid);
          
    ?>

          <!-- What are you going to do about this when you move it to a function????-->
  </div>
</body>

</html>

<?php

          exit(0);
        } //from previous php block
        //I don't understand how this works...

        $next = getNextDirection($taken);

        switch ($next) {
          case 0: //go north
            $row--;
            $grid[$row][$col] = $alphabet[$letter];
            break;

          case 1: //go west
            $col--;
            $grid[$row][$col] = $alphabet[$letter];
            break;

          case 2: //go south
            $row++;
            $grid[$row][$col] = $alphabet[$letter];
            break;

          case 3: //go east
            $col++;
            $grid[$row][$col] = $alphabet[$letter];
            break;
        }
      }
    }


    printGrid($gridSize, $grid);


?>


</div>
</body>

</html>
