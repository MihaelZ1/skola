<?php
function dohvatJsonSvihAuta() {
  $mysqli = mysqli_connect("localhost", "root", "", "automobili");    // spajanje na server i bazu
    if(!mysqli_connect_errno()) {         // provjera da li je bila greska
        $sql = "SELECT * FROM auto";
        // print($sql);
        $result = mysqli_query($mysqli, $sql);     // izvršavanje upita

        if($result==True) {
            if($mysqli->affected_rows==0) {
              //  echo "Nema nijednog auta u bazi."; 
            } else {
              $collection = array();
              while($row = mysqli_fetch_assoc($result)) { // dohvat svakog retka iz $result
                $myObj = array('id' => $row['id'],
                  'marka' => $row['marka'], 
                  'max_brzina' => $row['max_brzina'], 
                  'god_proizvodnje' => $row['god_proizvodnje'],
                );
                array_push($collection, $myObj);
              }
                $myJSON = json_encode($collection);
                // echo $myJSON;         
                //echo $sql;
                mysqli_free_result($result);  // oslobađanje memorije
                return $myJSON;
          }
        } else {
          // print(" Upit je neuspješno izvršen! ");
        } 
    } else {
      // print(" Greška kod spajanja na bazu! " . mysqli_connect_error());
    }
}

function dohvatJsonAutaPremaBrzini($jsonBrzinaRequest) {
  $mysqli = mysqli_connect("localhost", "root", "", "automobili");    // spajanje na server i bazu
    if(!mysqli_connect_errno()) {         // provjera da li je bila greska
                                  
        $arrayBrzina = json_decode($jsonBrzinaRequest);
        $sql = "SELECT * FROM auto WHERE max_brzina >= {$arrayBrzina->min_brzina} AND max_brzina <= {$arrayBrzina->max_brzina}";
        // print($sql);
        $result = mysqli_query($mysqli, $sql);     // izvršavanje upita

        if($result==True) {
            if($mysqli->affected_rows==0) {
              //  echo "Nema nijednog auta u bazi."; 
            } else {
              $collection = array();
              while($row = mysqli_fetch_assoc($result)) { // dohvat svakog retka iz $result
      
                $myObj = array(
                  'id' => $row['id'],
                  'marka' => $row['marka'], 
                  'max_brzina' => $row['max_brzina'], 
                  'god_proizvodnje' => $row['god_proizvodnje'],
                );
                array_push($collection, $myObj);
              }
                $myJSON = json_encode($collection);
                // echo $myJSON;         
                mysqli_free_result($result);  // oslobađanje memorije
                return $myJSON;
          }
        } else {
          // print(" Upit je neuspješno izvršen! ");
        } 
    } else {
      // print(" Greška kod spajanja na bazu! " . mysqli_connect_error());
    }
}

function unesiJsonAuto($jsonNoviAuto) {
  $mysqli = mysqli_connect("localhost", "root", "", "automobili");    // spajanje na server i bazu
  if(!mysqli_connect_errno()) {
    $arrayNoviAuto = json_decode($jsonNoviAuto);
    $sql = "INSERT INTO auto(marka, max_brzina, god_proizvodnje) values ('{$arrayNoviAuto->marka}', '{$arrayNoviAuto->max_brzina}', '{$arrayNoviAuto->god_proizvodnje}')";
      // print($sql);
    $results = mysqli_query($mysqli, $sql);
    if($results==TRUE) {
      $myObj = array('success' => 'true');
      $myJSON = json_encode($myObj);
      return $myJSON;        
    } else {
      $myObj = array('success' => 'false');
      $myJSON = json_encode($myObj);
      return $myJSON;
    }
  } else {
    $myObj = array('success' => 'false');
    $myJSON = json_encode($myObj);
    return $myJSON;
  }                                                  
}

function deleteJsonAuto($jsonDeleteAuto) {

  $mysqli = mysqli_connect("localhost", "root", "", "automobili");  
  if(!mysqli_connect_errno()) {           
    $arrayDeleteAuto = json_decode($jsonDeleteAuto);
    $sql = "DELETE FROM auto WHERE id =  {$arrayDeleteAuto->id}";
      // print($sql);
    $results = mysqli_query($mysqli, $sql);
    if($results==TRUE) {
      $myObj = array('success' => 'true');
      $myJSON = json_encode($myObj);
      return $myJSON;        
    } else {
      $myObj = array('success' => 'false');
      $myJSON = json_encode($myObj);
      return $myJSON;
    }
  } else {
    $myObj = array('success' => 'false');
    $myJSON = json_encode($myObj);
    return $myJSON;
  }                                                  
}

function updateJsonAuto($jsonDeleteAuto) {
  $mysqli = mysqli_connect("localhost", "root", "", "automobili");    
  if(!mysqli_connect_errno()) {
    $arrayUpdateAuto = json_decode($jsonDeleteAuto);
    $sql = "UPDATE auto SET marka='{$arrayUpdateAuto->marka}', max_brzina='{$arrayUpdateAuto->max_brzina}', god_proizvodnje='{$arrayUpdateAuto->god_proizvodnje}'  WHERE id =  {$arrayUpdateAuto->id}";
      // print($sql);
    $results = mysqli_query($mysqli, $sql);
    if($results==TRUE) {
      $myObj = array('success' => 'true');
      $myJSON = json_encode($myObj);
      return $myJSON;        
    } else {
      $myObj = array('success' => 'false');
      $myJSON = json_encode($myObj);
      return $myJSON;
    }
  } else {
    $myObj = array('success' => 'false');
    $myJSON = json_encode($myObj);
    return $myJSON;
  }                                                  
}
?>                                             
