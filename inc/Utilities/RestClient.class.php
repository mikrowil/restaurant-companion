<?php

class RestClient    {
    //Call is the main function, we will pass in the HTTP VERB, and we will also pass in the data

    static function call(String $method, $callData) {


    //Request Header
    $requestHeader = array('requesttype' => $method);

    //Merge the array for the data content
    $data = array_merge($requestHeader, $callData);

    $options = array(
            'http'=> array(
                'header' => "Content-Type: application/json\r\n",
                'method' => $method,
                'content' => json_encode($data)
            )
        );

        $context = stream_context_create($options);
        $result = file_get_contents(API_URL, false, $context);

        return $result;

    }
}