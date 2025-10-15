<?php
      include 'ashare.php';

      if (json_last_error() !== JSON_ERROR_NONE) {
        // Handle JSON decoding error
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "Invalid JSON: " . json_last_error_msg()]);
        exit();
      }
       $json_data = file_get_contents("php://input");
       $data_array = json_decode($json_data, true); // Decodes to an associative array
       $base= get_docroot()."../../www.asonelist.com/list";
       if (!is_dir($base) ) mkdir ($base);
       $jsonFilePath = $base.'/lastestsubmit.json';
       if (file_exists($jsonFile)) {
           $jsonContent = file_get_contents($jsonFilePath);

           // Decode the JSON string into a PHP array or object
           $data = json_decode($jsonContent, true); // true for associative array, false for object

           if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
              // Handle JSON decoding errors
              echo "Error decoding JSON: " . json_last_error_msg();
           }
        } else {
          $data = [];
        }
        $data_array['status'] = 0;
        $data_array['RequestTime'] = time();

        $data[] = $data_array; 
        file_put_contents($jsonFilePath,json_encode($data, JSON_PRETTY_PRINT));  
      
      header('Content-Type: application/json');
      echo json_encode([ 'msg' => 'append to '.$jsonFilePath]);

?>