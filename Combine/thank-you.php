<?php

require "helpers/helper-functions.php";

session_start();

$contact_number = $_POST['contact_number'];
$program = $_POST['program'];
$agree = $_POST['agree'];

$_SESSION['contact_number'] = $contact_number;
$_SESSION['program'] = $program;
$_SESSION['agree'] = $agree;

$csv_file_path = 'registrations.csv';
$file_handle = fopen($csv_file_path, 'a');

if ($file_handle !== false) {
  fputcsv($file_handle, [
      $_SESSION['fullname'],
      $_SESSION['email'],
      $_SESSION['password'], 
      $_SESSION['birthdate'],
      $_SESSION['sex'],
      $_SESSION['address'],
      $_SESSION['age'],
      $_SESSION['contact_number'],
      $_SESSION['program'],
      $_SESSION['agree']
  ]);
    // Close the file
    fclose($file_handle);

    // Clear session data
    session_destroy();
} else {
    echo "Error opening file.";
}

?>
<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #2</title>
    <link rel="icon" href="https://phpsandbox.io/assets/img/brand/phpsandbox.png">
    <link rel="stylesheet" href="https://assets.ubuntu.com/v1/vanilla-framework-version-4.15.0.min.css" />   
</head>
<body>

<section class="p-section--hero">
  <div class="row--50-50-on-large">
    <div class="col">
      <div class="p-section--shallow">
        <h1>
          Thank You Page
        </h1>
      </div>
      <div class="p-section--shallow">
      
        <table aria-label="Session Data">
            <thead>
                <tr>
                    <th></th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($_SESSION as $key => $val):
            ?>
                <tr>
                    <th><?php echo htmlspecialchars($key); ?></th>
                    <td>
                      <?php echo htmlspecialchars($val); ?>
                    </td>
                </tr>
            <?php
            endforeach; 
            ?>
            </tbody>
        </table>  
      

      </div>
    </div>
  </div>
</section>

</body>
</html>