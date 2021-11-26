<?php
//setting header to json
header('Content-Type: application/json');

//database
$connection = mysqli_connect("appdb", "user", "password", "appDB") or die(mysqli_error($connection));

//query to get data from the table
$query = "SELECT price, posted FROM rates";

//execute query
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));

//loop through the returned data
$data = array();
foreach ($result as $row) {
  $data[] = $row;
}

//free memory associated with result
$result->close();

//close connection
$connection->close();

//now print the data
print json_encode($data);
?>