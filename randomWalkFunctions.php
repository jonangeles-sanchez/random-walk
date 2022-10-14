<?php
/*********************************************************************************
Function to decide which direction we should go next based on a randomly generated
number using 'rand'
 ********************************************************************************/
function getNextDirection($taken){
  $next;

  while(true){
      $next=mt_rand()%4;//get a new random direction
      if(($next==0 && !$taken[0]) || ($next==1 && !$taken[1]) || ($next==2 && !$taken[2]) || ($next==3 && !$taken[3]))
	break;
    }
  return $next;
}

/*********************************************************************************
if all directions are from the current location are filled, this will return true
 ********************************************************************************/
function allTaken($taken){
    return ($taken[0] && $taken[1] && $taken[2] && $taken[3]);
}

/*********************************************************************************
Function that determines which directions are taken and which are available
 ********************************************************************************/
function checkDirections($row, $col, $size, $grid){
    for($i=0;$i<4;$i++)
      $taken[$i]=false;
    
    if($row-1<0 || $grid[$row-1][$col]!='.')
      $taken[0]=true;
    if($col-1<0 || $grid[$row][$col-1]!='.')
      $taken[1]=true;
    if($row+1>$size-1 || $grid[$row+1][$col]!='.')
      $taken[2]=true;
    if($col+1>$size-1 || $grid[$row][$col+1]!='.')
      $taken[3]=true;
  
    return $taken;
}


/*********************************************************************************
Function to fill the grid with dots (periods)
 ********************************************************************************/
function initializeGrid($size){
    /*fill grid with dots*/
     for($i=0;$i<$size;$i++){
       for($j=0;$j<$size;$j++){
         $grid[$i][$j]='.';
         }
       } 
     return $grid;  
}
   
/*********************************************************************************
Function to display the final grid
 ********************************************************************************/
function printGrid($size, $grid){
    /*
    echo "<pre>";
    for($i=0;$i<$size;$i++){
        for($j=0;$j<$size;$j++)
        echo $grid[$i][$j] . " ";
        printf("\n");
        }
    echo "</pre>";
    */
    echo "<table>";
    for($i=0;$i<$size;$i++){
        echo "<tr>";
        for($j=0;$j<$size;$j++){
            echo "<td>" . $grid[$i][$j] . "</td>";
        }
        echo "</tr>";
    }
}

/*********************************************************************************
 * Function to generate a random walk
********************************************************************************/
function calculateWalk($gridSize, $walkLength){
	global $grid;
    $seed = mt_rand();
    mt_srand($seed);
    echo "Seed = " . $seed . "\n";
    $first = true;
    /*Generate a random starting point*/
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
        /*****check whether all sides are blocked******/
        $taken = checkDirections($row, $col, $gridSize, $grid);
        /*if they are, print what we have and exit*/
        if (allTaken($taken)) { //spans through to next php block
          printGrid($gridSize, $grid);
          exit(0);
        } //from previous php block
        /*********************************************/
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
}



?>
