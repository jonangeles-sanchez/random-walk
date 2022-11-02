<!-- Jonathan Angeles & Johnny Arraya & Leonardo Bernerdes & Michael Hyde -->
<!-- 10/12/2022 -->
<!-- This program will randomly walk a user through a maze. -->
<!-- On my honor, I have neither given nor received any academic aid or information that would violate the Honor Code of Mars Hill University. -->

<!DOCTYPE html>

<html lang="en-US">

<head>

  <?php
  include "randomWalkFunctions.php";
  ?>

 
 <script>//defer - move to the top/head

 /************************************************************************
 This function clears the value, generates a new value from myForm, and
 submits the new value in javascript.
 *************************************************************************/
	function clearSubmitFunction() {
		//This sets the value equal to nothing(clears the value)
		document.getElementById("seedField").value = "";
		//This line submits myForm that generates in the value 
		document.getElementById("myForm").submit();
	}

 </script>

<link rel="stylesheet" type="text/css" href="rwStyle.php">

  <?php
  $gridSize = intval($_POST['gridSize']);
  $walkLength = intval($_POST['walkLength']);
  $seed = intval($_POST['seed']);
  $grid = initializeGrid($gridSize); //fill the grid with dots

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if ($seed)
      mt_srand($seed);
    else {
      $seed = mt_rand();
      mt_srand($seed);
    }
  } else {
    $seed = "";
  }
  ?>

  <meta charset="utf-8">

  <title>Random Walk Generator</title>


</head>


<body>
  <h1>Random Walk Generators</h1>

  <form id = "myForm" action="<?php echo basename($_SERVER['PHP_SELF']); ?>" method="POST">

    Create a walk of up to length

    <select name="walkLength">

      <?php
	  $isSelected = false;
      for ($val = 1; $val <= 10; $val++) {
        echo "<option value=\"" . $val . "\"";

        if ($val == $walkLength){
          echo "selected=\"selected\"";
		  $isSelected = true;
		}

        echo ">" . $val . "</option>\n";
      }
	  	if ($isSelected){ 
			echo "<option value=\"No Limit\">No Limit</option>\n";	
		} else {
			echo "<option value=\"No Limit\" selected=\"selected\">No Limit</option>\n";
		}

	/*
      if($walkLength < 1)
        $walkLength = 1;
	*/
      ?>
    </select>
    <input type="hidden" name="previousWalkLength" value="<?php echo $walkLength; ?>">


    on a grid of size

    <select name="gridSize">
      <?php
      for ($val = 1; $val <= 25; $val++) {
        echo "<option value=\"" . $val . "\"";

        if ($val == $gridSize)
          echo "selected=\"selected\"";

        echo ">" . $val . "</option>\n";
      }
       //Make 25 default
      if($gridSize == 0)
        echo "<option value=\"25\" selected=\"selected\">25</option>\n";
      
	  /*
      if($grid < 1){
        $gridSize = 25;
      } else if($grid > 25){
        $gridSize = 25;
      }
	  */
      /*
      if($gridSize < 1)
        $gridSize = 1;
      else if($gridSize > 25)
        $gridSize = 25;
      */
      
      
      ?>
    </select>
    <input type="hidden" name="previousGridSize" value="<?php echo $gridSize; ?>">

    with a random seed of

      <!-- Default value previous seed -->
    <input type="text" name="seed" id = "seedField" value="<?php echo $seed; ?>">
    <input type="hidden" name = previousSeed value = "<?php echo $seed; ?>">


  <?php
/**********************************************************************
  This generates the Clear and Submit Button and calls from 
  the function clearSubmitFunction().
***********************************************************************/
	echo "<button type=\"button\"  onclick = \"clearSubmitFunction()\">Clear and
	Submit</button>";
  ?>
    <button type="submit" value="Submit">Submit</button> 
    <button type="button"><a href="<?php echo basename($_SERVER['PHP_SELF']); ?>">Reset</a></button>
    <input type="checkbox" id="color" name="color" <?php 
      if(!$_POST) echo "checked";
      else if(isset($_POST['color'])) echo "checked = 'checked'";    
    ?>>
    <label for="color">In Color</label>
  </form>

  <div id="results">

  <?php
  /*
   * Change color of walk if values are the same as previous submission
   */
  if($gridSize > 0){
    if(isset($_POST['color']) && $_POST['previousGridSize'] == $gridSize && $_POST['previousWalkLength'] == $walkLength && $_POST['previousSeed'] == $seed){
      echo "colors must change \n";//Add function to change color
    
    }
    calculateWalk($gridSize, $walkLength);
  }
  ?>
 

  
  </div>
</body>

</html>


