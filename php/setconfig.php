<?php

//////////////////////////////////////////////////////////////
////////////////////// DATABASE STUFF ////////////////////////
//////////////////////////////////////////////////////////////
    extract( $_GET );
  require_once 'dbConnection.php';

    try {
      $connection = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }

    $sql = "UPDATE config SET value = CASE property ";
    foreach ($config as $ordinal => $value) {
      $sql .= sprintf("WHEN '%s' THEN '%s' ", $ordinal, $value);
    }
    $sql .= "END";



  $statement = $connection->prepare($sql);

    $statement->execute();

    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if($result)
    {
      echo json_encode("Success");

    }
    else
    {
      echo json_encode($sql);
    }

  $statement = NULL;

?>
