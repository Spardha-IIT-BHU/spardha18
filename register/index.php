<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Spardha 2018 Registration</title>

  <script src='../js/jquery-3.2.1.min.js'></script>
  <script src='js/form.js'></script>
  
  <link rel="stylesheet" href="css/normalize.css">

  <link rel='stylesheet prefetch' href='../css/font-awesome/css/font-awesome.min.css'>

  <link rel="stylesheet" href="css/style.css">
  
</head>

<body onload="parent.scrollTo(0,0);">
<div class="container">
<?php

include("db.php");
$institute_name=$email=$phone=$opted_events=$error="";
$check=2;
if($_SERVER["REQUEST_METHOD"]=="POST"){
  $check=1;
  if($_POST["other_institute"]!="") $institute_name = mysqli_real_escape_string($conn, clean($_POST["other_institute"]));
  else $institute_name = mysqli_real_escape_string($conn, clean($_POST["institute_name"]));
  $institute_name=strtoupper($institute_name);
  $name = mysqli_real_escape_string($conn, clean($_POST["name"]));
  $designation = mysqli_real_escape_string($conn, clean($_POST["designation"]));
	$email = mysqli_real_escape_string($conn, clean($_POST["email"]));
	$phone = mysqli_real_escape_string($conn, clean($_POST["phone"]));
  $opted_events = mysqli_real_escape_string($conn, clean($_POST["opted_events"]));
    
  $query = "SELECT * FROM `registration2018` WHERE (`institute_name`='$institute_name' or `email`='$email' or `phone`='$phone')";
  $result = mysqli_query($conn, $query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    if ($rows) {
      while($data = mysqli_fetch_row($result)){
        echo "<div id='error' class='alert alert-danger'>";
        if($data[1]==$institute_name) echo $data[1]." has already registered.";
        else if($data[4]==$email) echo "This email id is already used.";
        else if($data[5]==$phone) echo "This phone number is already used.";
        else echo "Please enter valid data.";
        }
        echo "</div>";
      }
  else{    
      $query = "INSERT INTO `registration2018`(`institute_name`, `name`, `designation`, `email`, `phone`, `opted_events`) VALUES ('$institute_name', '$name', '$designation', '$email','$phone','$opted_events')";
      $result = mysqli_query($conn, $query);
      if ($result) {
          include("success.php");
          $check=0;
      }
      else echo $error;
  }
}
if($check){
  if($check==2) echo '<div id="error" class="alert alert-danger" style="display:none;"></div>';
?>
  <form action="" method="POST" id="registration" onsubmit="return validate(this);">
    <div class="row">
      <h4>DETAILS</h4>
      <div class="input-group input-group-icon">
        <select id="institute_name" name="institute_name"></select>
        <div class="input-icon"><i class="fa fa-graduation-cap"></i></div>
      </div>
      <div class="input-group input-group-icon" id="other_institute_div" style="display:none;">
        <input type="text" placeholder="Institute Name" id="other_institute" name="other_institute" value="" />
        <div class="input-icon"><i class="fa fa-building"></i></div>
    </div>
      <div class="input-group input-group-icon">
        <input type="text" placeholder="Name" id="name" name="name" value="" />
        <div class="input-icon"><i class="fa fa-user"></i></div>
    </div>
    <div class="input-group input-group-icon">
        <input type="text" placeholder="Designation" id="designation" name="designation" value="" />
        <div class="input-icon"><i class="fa fa-briefcase"></i></div>
    </div>
    <div class="input-group input-group-icon">        
        <input type="email" placeholder="Email address" id="email" name="email" value="" />
        <div class="input-icon"><i class="fa fa-envelope"></i></div>
    </div>
    <div class="input-group input-group-icon">
        <input type="phone" placeholder="Phone" id="phone" name="phone" value="" /> 
        <div class="input-icon"><i class="fa fa-phone"></i></div>
      </div>
    </div>

    <div class="row">
      <h4>SELECT EVENTS FOR PARTICIAPTION</h4>
      <div class="input-group" id="eventlist">
        <input type="hidden" id="opted_events" name="opted_events" value="" />
    </div>
    <div class="row">
      <h4>TERMS AND CONDITIONS</h4>
      <div class="input-group">
        <input type="checkbox" id="terms" name="terms"/>
        <label for="terms">I accept the rules of Spardha 2018 and agree to abide by them.</label>
      </div>
    </div>
    <div class="row">
      <input type="submit" id="submit" value="Submit"/>
    </div>
  </form>
  <script>
    $("document").ready(function(){
      let div = $('#eventlist');
      const url1 = '../eventdata/eventlist.json';
      $.getJSON(url1, function (data) {
        $.each(data, function (key, entry) {
          div.append('<input type="checkbox" class="event" id="'+entry.name+'" name="'+entry.name+'" /><label for="'+entry.name+'">'+entry.name.toUpperCase()+'</label>');
        })
      });

      let dropdown = $('#institute_name');
      dropdown.empty();
      dropdown.append('<option selected="true" disabled>Select your institute</option>');
      dropdown.prop('selectedIndex', 0);
      const url2 = 'data/institutelist.json';
      $.getJSON(url2, function (data) {
        $.each(data, function (key, entry) {
          dropdown.append($('<option></option>').attr('value', entry.abbreviation).text(entry.name));
        })
      });
    });
  </script>
<?php
}
mysqli_close($conn);

function clean($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>
</div>