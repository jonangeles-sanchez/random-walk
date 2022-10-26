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

<link rel="stylesheet" type="text/css" href="rwStyle.php">

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
	  	if ($walkLength == 0) 
		 echo "<option value=\"No Limit\" selected=\"selected\">No Limit</option>\n";

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

    with a random seed of

      <!-- Default value previous seed -->
    <input type="text" name="seed" value="<?php echo $seed; ?>">

    <button type="clear and submit" value="Clear and Submit"><a href="<?php echo basename($_SERVER['PHP_SELF']); ?>">Clear and Submit</a></button> 
    <button type="submit" value="Submit">Submit</button> 
    <button type="button"><a href="<?php echo basename($_SERVER['PHP_SELF']); ?>">Reset</a></button>
  </form>

  <div id="results">

  <?php
	if($gridSize != 0)
    	calculateWalk($gridSize, $walkLength);
  ?>
  
  
  </div>
</body>

</html>


