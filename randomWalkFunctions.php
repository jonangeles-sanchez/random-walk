<?php


/*********************************************************************************
Function to decide which direction we should go next based on a randomly generated
number using 'rand'
 ********************************************************************************/
function getNextDirection($taken)
{
  $next;

  while (true) {
    $next = mt_rand() % 4; //get a new random direction
    if (($next == 0 && !$taken[0]) || ($next == 1 && !$taken[1]) || ($next == 2 && !$taken[2]) || ($next == 3 && !$taken[3]))
      break;
  }
  return $next;
}

/*********************************************************************************
if all directions are from the current location are filled, this will return true
 ********************************************************************************/
function allTaken($taken)
{
  return ($taken[0] && $taken[1] && $taken[2] && $taken[3]);
}

/*********************************************************************************
Function that determines which directions are taken and which are available
 ********************************************************************************/
function checkDirections($row, $col, $size, $grid)
{
  //Function takes in row, column, grid, and size as parameters
  //Used to check the 2D array's indexes    

  //For loop to check all sides
  for ($i = 0; $i < 4; $i++)
    //Each side is set to false by default
    $taken[$i] = false;

  //Up direction is checked
  //If != '.' or out of bounds set taken to true;
  if ($row - 1 < 0 || $grid[$row - 1][$col] != '.')
    $taken[0] = true;
  //Left direction is checked
  //If != '.' or out of bounds set taken to true;
  if ($col - 1 < 0 || $grid[$row][$col - 1] != '.')
    $taken[1] = true;
  //Down direction is checked
  //If != '.' or out of bounds set taken to true;
  if ($row + 1 > $size - 1 || $grid[$row + 1][$col] != '.')
    $taken[2] = true;
  //Right direction is checked
  //If != '.' or out of bounds set taken to true;
  if ($col + 1 > $size - 1 || $grid[$row][$col + 1] != '.')
    $taken[3] = true;


  //Return the $taken array containing boolean values
  return $taken;
}


/*********************************************************************************
Function to fill the grid with dots (periods)
 ********************************************************************************/
function initializeGrid($size)
{
  /*fill grid with dots*/
  for ($i = 0; $i < $size; $i++) {
    for ($j = 0; $j < $size; $j++) {
      $grid[$i][$j] = '.';
    }
  }
  return $grid;
}

/*********************************************************************************
 * Function to change the color of the walk if values are the same as previous submission
 ********************************************************************************/
function changeWalkColors($lengthColors){
  for($i = 0; $i < count($lengthColors); $i++){
    $lengthColors[$i] = "red";
  }
  return $lengthColors;
}

/*********************************************************************************
Function to display the final grid
 ********************************************************************************/
function printGrid($size, $grid, $maxLength)
{
  global $gridSize;
  global $walkLength;
  global $seed;

  //added in-color functionality
  $colorCollection = array("red", "blue", "green", "yellow", "orange", "purple", "pink", "brown", "black","OrangeRed", "Khaki", "Magenta", "Olive", "Cyan", "DarkCyan", "DarkGoldenRod", "DarkGreen", "DarkKhaki", "DarkMagenta", "DarkOliveGreen", "DarkOrange", "DarkOrchid", "DarkRed", "DarkSalmon", "DarkSeaGreen", "DarkSlateBlue", "DarkSlateGray", "DarkTurquoise", "DarkViolet", "DeepPink", "DeepSkyBlue", "DodgerBlue", "FireBrick", "ForestGreen", "Gold", "GoldenRod", "GreenYellow", "HotPink", "IndianRed", "Indigo", "LawnGreen", "LightBlue", "LightCoral", "LightCyan", "LightGoldenRodYellow", "LightGreen", "LightPink", "LightSalmon", "LightSeaGreen", "LightSkyBlue", "LightSlateGray", "LightSteelBlue", "Lime", "LimeGreen", "Maroon", "MediumAquaMarine", "MediumBlue", "MediumOrchid", "MediumPurple", "MediumSeaGreen", "MediumSlateBlue", "MediumSpringGreen", "MediumTurquoise", "MediumVioletRed", "MidnightBlue", "Navy", "OliveDrab", "OrangeRed", "Orchid", "PaleGreen", "PaleTurquoise", "PaleVioletRed", "Peru", "PowderBlue", "RebeccaPurple", "RoyalBlue", "SaddleBrown", "Salmon", "SandyBrown", "SeaGreen", "Sienna", "SkyBlue", "SlateBlue", "SlateGray", "SpringGreen", "SteelBlue", "Teal", "Thistle", "Tomato", "Turquoise", "Violet", "Wheat", "YellowGreen");
  $lengthColors = array(); //this array will hold the color of each length
  //but needs to be randomized when user submits same form
  if(isset($_POST['color'])) {
    for ($i = 0; $i <= $maxLength; $i++) {
      array_push($lengthColors, $colorCollection[mt_rand() % 9]);
    }
  } else if(isset($_POST['color']) && $_POST['previousGridSize'] == $gridSize && $_POST['previousWalkLength'] == $walkLength && $_POST['previousSeed'] == $seed) {
    echo "colors changing\n";
    $lengthColors = changeWalkColors($lengthColors);
  }
  //print_r($lengthColors);
  $color = false;
  if (isset($_POST['color'])) {
    $color = true;
  } else {
    $color = false;
  }

  /*
  echo "<table>";
  for ($i = 0; $i < $size; $i++) {
    echo "<tr>";
    for ($j = 0; $j < $size; $j++) {
      if ($grid[$i][$j] == '.') {
        echo "<td class=\"dot\">" . $grid[$i][$j] . "</td>";
      } else {
        if ($color) {
          $indexNum = substr($grid[$i][$j], 0, 1);
          echo "<td class=<?php echo $lengthColors[$indexNum]; ?> >" . substr($grid[$i][$j], 0, -1) . "</td>";
        } else {
          echo "<td>" . substr($grid[$i][$j], 0, -1) . "</td>";
        }
      }
    }
    echo "</tr>";
  }
  */

  /*
  echo "<table";
  for($i = 0; $i < $size; $i++){
    echo "<tr>";
    for($j = 0; $j < $size; $j++){
      if($grid[$i][$j] == '.'){
        echo "<td class=\"dot\">" . $grid[$i][$j] . "</td>";
      } else {
        if($color) {
          $indexNum = substr($grid[$i][$j], 1);
          echo "<td class=<?php echo $lengthColors[$indexNum]; ?> >" . substr($grid[$i][$j], 0, -1) . "</td>";
        } else {
          echo "<td>" . substr($grid[$i][$j], 0, -1) . "</td>";
        }
      }
    }
    echo "</tr>";
  }
  echo "</table>";
  */

  echo "<table>";
  for ($i = 0; $i < $size; $i++) {
    echo "<tr>";
    for ($j = 0; $j < $size; $j++) {
      if ($grid[$i][$j] == '.') {
        echo "<td class=\"dot\">" . $grid[$i][$j] . "</td>";
      } else {
        if($color){
          $indexNum = substr($grid[$i][$j], 1);
          echo "<td class=\"".$lengthColors[$indexNum]."\">" . substr($grid[$i][$j], 0, -1) . "</td>";
        } else {
          echo "<td>" . substr($grid[$i][$j], 0, -1) . "</td>";
        }
      }
    }
    echo "</tr>";
  }

  return $lengthColors;
}


/*********************************************************************************
 * Function to generate a random walk
 ********************************************************************************/
function calculateWalk($gridSize, $walkLength)
{
  global $grid;
  global $seed;
  global $maxLength;

  //echo "Seed = " . $seed . "\n";
  $first = true;
  /*Generate a random starting point*/
  $row = mt_rand() % $gridSize;
  $col = mt_rand() % $gridSize;
  $alphabet = str_split("ABCDEFGHIJKLMNOPQRSTUVWXYZ");
  $grid[$row][$col] = $alphabet[0] . "0"; //set first 'A' in grid
  $size = 0;
  if($_POST['walkLength'] == "No Limit"){
  	$size = round(($_POST['gridSize']**2)/26);
  } else {
	$size = $_POST['walkLength'];
  }
  for ($n = 0; $n < $size; $n++) { //for as many times as they want the alphabet repeated
    for ($letter = 0; $letter < 26; $letter++) { //make a path with the alphabet
      if ($first) { //if this is the first 'A' of all
        $first = false;
        $letter = 1;
      }
      /*****check whether all sides are blocked******/
      $taken = checkDirections($row, $col, $gridSize, $grid);
      /*if they are, print what we have and exit*/
      if (allTaken($taken)) { //spans through to next php block
        $maxLength = $n;
        printGrid($gridSize, $grid, $maxLength);
        //echo "max length was " . $maxLength . "\n";
        exit(0);
      } //from previous php block
      /*********************************************/
      $next = getNextDirection($taken);
      switch ($next) {
        case 0: //go north
          $row--;
          $grid[$row][$col] = $alphabet[$letter] . $n;
          break;
        case 1: //go west
          $col--;
          $grid[$row][$col] = $alphabet[$letter] . $n;
          break;
        case 2: //go south
          $row++;
          $grid[$row][$col] = $alphabet[$letter] . $n;
          break;
        case 3: //go east
          $col++;
          $grid[$row][$col] = $alphabet[$letter] . $n;
          break;
      }
    }
  }
  $maxLength = $n;
  printGrid($gridSize, $grid, $maxLength);
}

?>
