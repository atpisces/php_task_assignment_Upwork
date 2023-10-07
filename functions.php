<?php

	// PHP function to access SESSION VARIABLES
	session_start();

	// function for LoggingIn via API
	function loginApiCall($email, $password){

	    $api_url = 'https://candidate-testing.api.royal-apps.io/api/v2/token'; // API endpoint

	    $data = array(
	        'email' => $email,
	        'password' => $password,
	        'grant_type' => 'password'
	    );

	    $ch = curl_init($api_url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_POST, true);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	        'Content-Type: application/x-www-form-urlencoded',
	        'Accept: application/json'
	    ));

	    $response = curl_exec($ch);

	    curl_close($ch);

	    $response_data = json_decode($response, true);


	    if (isset($response_data['token_key'])) {
	        $access_token = $response_data['token_key'];
	        $_SESSION['USER_ACCESS_TOKEN'] = $access_token;
	        $_SESSION['USER_FIRST'] = $response_data['user']['first_name'];
	        $_SESSION['USER_LAST'] = $response_data['user']['last_name'];

	        header("Location: authors.php");
	    print_r($response_data);
	    exit;
	    } else {
	        echo "Failed to retrieve access token.";
	    }
	}

	// Single function to handle API requests of GET, DELETE
	function apiCall($action, $endPoint, $requestType, $params){
		if (isset($endPoint)) {
			if($action == "list"){
		    	$api_url = 'https://candidate-testing.api.royal-apps.io/api/v2/'.$endPoint.'?'.$params; // API endpoint
			} else if($action == "delete" || $action == "get_details"){
		    	$api_url = 'https://candidate-testing.api.royal-apps.io/api/v2/'.$endPoint.'/'.$params; // API endpoint
			}

		    $ch = curl_init($api_url);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $requestType);
		    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		        'Authorization: Bearer bf9ed30f7a6835a9925c046731cfaca43eba4437f17735cb792901bddf813d7f91a2122face91429'
		    ));

		    $response = curl_exec($ch);

		    curl_close($ch);

		    $response_data = json_decode($response, true);
		    return $response_data;
		}
	}

	// Logout Button
	$logoutButton = '<div class="row justify-content-end">
						<a href="logout.php" class="btn btn-danger col-2">Logout</a>
					</div>';

?>