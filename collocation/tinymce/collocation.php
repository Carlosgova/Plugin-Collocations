<?php


$ch = curl_init('http://api.local/rest/users');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string))
);

$result = curl_exec($ch);

$url = "http://patexpert-engine.upf.edu/cgi-bin/har/harapi.pl";

if(!($_POST['collocation'])){
    die(" Write a collocation!");
}

if (isset($_POST['case1'])){
    $params = "?case=1&input=" . urlencode($_POST["collocation"]);
}else{
    if(isset($_POST['case2'])){
        $params = "?case=2&input=" . urlencode($_POST["collocation"]) . "&perpage=" . $_POST["Perpage"];
        
        }else{
         if(isset($_POST['case3'])){
             $params = "?case=3&input=" . urlencode($_POST["collocation"]). "&inputpos="  . $_POST["Inputpos"] . "&colpos=". $_POST["Colpos"] . "&position=" . $_POST["Position"];            
        
             }else{ 
                 if(isset($_POST['case4'])){
                 $params = "?case=4&input=" . urlencode($_POST["collocation"]);
                 }else{
                    die("ERROR, no case selected");
                 }
             }                      
         }
}

$curl = curl_init($url . $params);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
$json_response = curl_exec($curl);

$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);


if ($status != 200) {
    die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
}



curl_close($curl);



$jsonIterator = new RecursiveIteratorIterator(
new RecursiveArrayIterator(json_decode($json_response, TRUE)), RecursiveIteratorIterator::SELF_FIRST);


if (isset($_POST['case1'])){
foreach ($jsonIterator as $key => $val) {
    if (is_array($val)) {
        echo "<br> result nº: $key<br>";
    } else {
        if($key == 0){
             echo "Group: $val<br>";
        }else{
            if($key == 1){
                 echo "Pattern: $val<br>";
            }else{
                 echo "Example construction: $val<br>";
            }
        }
    }
}


}else{
    if(isset($_POST['case2'])){
        //some magic happens here                      
     }else{
         if(isset($_POST['case3'])){
          foreach ($jsonIterator as $key => $val) {  
             if (is_array($val)) {
               echo "<br> result: $key<br>";                
             }else{
               if($key == 0){
                        echo "Group: $val<br>";   
               }else{
                      if($key == 1){
                        echo "Range: $val<br>";
                        }else{
                                echo "Concurrency: $val<br>";
                         }       
                   }
                 }
             }
         }else{
              if(isset($_POST['case4'])){
                  die("Sorry, Case 4 has not been implemented yet ");
              }else{ die("ERROR gravíssim");}
              
        }
}
}

?>
