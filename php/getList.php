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
       $state = $data_array['state'];
       $city = $data_array['city'];

       $jsonFilePath= get_docroot()."../../www.asonelist.com/list/{$state}/{$city}/data.json";
       
       if (file_exists($jsonFilePath)) {
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
        if (!array_key_exists('shopping', $data)) $data['shopping'] = ['category' => []];
        if (!array_key_exists('nonshopping', $data)) $data['nonshopping'] = ['category' => []];
        foreach ($data_array['shoppingCategory'] as $cat ) {
                if (!array_key_exists($cat, $data['shopping']['category'])) $data['shopping']['category'][$cat] = [];
        }

        foreach ($data_array['websiteCategory'] as $cat ) {
               if (!array_key_exists($cat, $data['nonshopping']['category'])) $data['nonshopping']['category'][$cat] = [];
        }

      
      header('Content-Type: application/json');
      echo json_encode($data);

?>