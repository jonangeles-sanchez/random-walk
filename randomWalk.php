<!-- Jonathan Angeles & Johnny Arraya -->
<!-- 10/10/2017 -->
<!-- This program will randomly walk a user through a maze. -->
<!-- On my honor, I have neither given nor received any academic aid or information that would violate the Honor Code of Mars Hill University. -->

<!DOCTYPE html>

<html lang="en-US">

<head>

  <?php
  include "randomWalkFunctions.php";
  ?>

<link rel="stylesheet" type="text/css" href="randomWalk.css">

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


</head>


<body>
  <h1>Random Walk Generators</h1>

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


      if($walkLength < 1)
        $walkLength = 1;
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
      if($gridSize < 1)
        $gridSize = 1;
      else if($gridSize > 25)
        $gridSize = 25;
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
