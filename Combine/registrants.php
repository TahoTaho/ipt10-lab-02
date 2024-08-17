<?php

define('CUSTOMERS_FILE_PATH', 'registrations.csv');

function get_customers_data($limit = 10000)
{
    $opened_file_handler = fopen(CUSTOMERS_FILE_PATH, 'r');

    $data = [];
    $headers = [];
    $row_count = 0;

    while (!feof($opened_file_handler) && $row_count < $limit + 1) {
        $row = fgetcsv($opened_file_handler, 1024);
        if (!empty($row)) {
            if ($row_count == 0) {
                array_push($headers, $row);
            } else {
                array_push($data, $row);
            }
        }
        $row_count++;
    }

    fclose($opened_file_handler);

    return [
        'headers' => $headers,
        'data' => $data
    ];
}

$start_time = microtime(true);
$customers = get_customers_data(10000); // Load 10,000 customers
$end_time = microtime(true);
$load_time = $end_time - $start_time;

?>
<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #2</title>
    <link rel="icon" href="https://phpsandbox.io/assets/img/brand/phpsandbox.png">
    <link rel="stylesheet" href="https://assets.ubuntu.com/v1/vanilla-framework-version-4.15.0.min.css" />   
</head>
<body>

<h1>
    Customers
</h1>

<table aria-label="Customers Dataset">
    <thead>
        <tr>
            <th>Complete Name</th>
            <th>Birthday</th>
            <th>Age</th>
            <th>Contact Number</th>
            <th>Sex</th>
            <th>Program</th>
            <th>Complete Address</th>
            <th>Email Address</th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach ($customers['data'] as $record):
    ?>
        <tr>
            <td><?php echo $record[0]; ?></td>
            <td><?php echo $record[3]; ?></td>
            <td><?php echo $record[6]; ?></td>
            <td><?php echo $record[7]; ?></td>
            <td><?php echo $record[4]; ?></td>
            <td><?php echo $record[8]; ?></td>
            <td><?php echo $record[5]; ?></td>
            <td><?php echo $record[1]; ?></td>
        </tr>
    <?php
    endforeach;
    ?>
    </tbody>
</table>


</body>
</html>