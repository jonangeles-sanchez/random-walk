<!DOCTYPE html>
<html lang="en-US">
<?php include "randomWalkFunctions.php" ?>

<head>
    <meta charset="utf-8">
    <title>Random Walk Basic</title>
    <link rel="stylesheet" type="text/css" href="randomWalk.css">
    <meta charset="utf-8">
    <title>Random Walk Generator</title>

    <?php
        $gridSize=intval($_GET['gridSize']);
        $walkLength=intval($_GET['walkLength']);
        $seed=intval($_GET['seed']);
        $grid=initializeGrid($gridSize);//fill the grid with dots
 
        if($seed)
          mt_srand($seed);
        else{
          $seed=mt_rand();
          mt_srand($seed);
         }
    ?>

    <?php
        getNextDirection($taken);
        allTaken($taken);
        checkDirections($row, $col, $size, $grid);
        initializeGrid($size);
        printGrid($size, $grid);
    ?>

</head>

<body>
    <h1>Random Walk Generator</h1>
    <form action="<?php echo basename($server['PHP_SELF']); ?>">
        Create a walk of length
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
        on a grid of size of
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
        <button type="submit" value="submit">submit</button>
        <button type="button"><a href="<?php echo basename($_SERVER['PHP_SELF']); ?>">Reset</a></button>
    </form>

    <div id="results">

        <?php
        generateRandomPoint($seed, $walkLength, $gridSize);
        ?>
    </div>
</body>

</html>
<?php
  getDirection($taken, $row, $col, $alphabet, $letter);
?>
</div>
</body>

</html>