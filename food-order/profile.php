<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Professional Profile</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #007bff;
      margin: 0;
      padding: 0;
      color: #fff; /* Setting default font color to white */
    }

    .profile-container {
      max-width: 800px;
      margin: 50px auto;
      background-color: rgba(255, 255, 255, 0.9);
      border-radius: 8px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
      color: #000; /* Resetting font color to black for the container */
    }

    .profile-header {
      text-align: center;
      margin-bottom: 30px;
    }

    .profile-header h1 {
      font-size: 36px;
    }

    .profile-details {
      padding: 20px;
    }

    .profile-details h2 {
      margin-bottom: 10px;
    }

    .profile-details p {
      margin: 5px 0;
    }
  </style>
</head>
<body>
  <div class="profile-container">
    <div class="profile-header">
      <h1>Professional Profile</h1>
    </div>
    <div class="profile-details">
      <?php
      

      $name = "John Doe";
      $profession = "Software Engineer";
      $experience = "5 years";
      $education = "Bachelor's Degree in Computer Science";
      $skills = "PHP, HTML, CSS, JavaScript, MySQL";

      echo "<h2>Name: $name</h2>";
      echo "<p>Profession: $profession</p>";
      echo "<p>Experience: $experience</p>";
      echo "<p>Education: $education</p>";
      echo "<p>Skills: $skills</p>";
      ?>
  
