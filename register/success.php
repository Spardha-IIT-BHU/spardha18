<?php
    $query = "SELECT * FROM `registration2018` WHERE institute_id='$institute_id'";
    $result = mysqli_query($conn,$query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    if ($rows==1) {
      while($data = mysqli_fetch_row($result)){
        echo "<div class='alert alert-success'>";
        echo "Successfuly registered for Spardha 2018!";
        echo "</div>";
        echo "<div class='row'>";
        echo "<img src='../images/logos/spardha.png' align='center' style='width:100%;'/>";
        echo "<h4>".$data[3]."</h4>";
        echo "<h4>Registration number: ".$data[1]."</h4>";
        echo "<h4>Registered events: ";
        echo join(', ', array_map('ucfirst', explode(',', $data[8])));
        echo "</h4></div>";
      }
    }
?>
