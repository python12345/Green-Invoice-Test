<?php 

	class APIClient {
	    public $key; 
	    public $secret; 

	    function __construct($key, $secret) { 
	        $this->key = $key; 
	        $this->secret = $secret; 
	    } 
	    public function getJWTToken() { 
	    	try {
	    		$invoice_url = "https://private-anon-273c2945a9-greeninvoice.apiary-mock.com/api/v1/account/token";
	    		$data = array('id' => $this->key, 'secret' => $this->secret);

	    		$options = array(
    				'http' => array(
				        'header'  => "Content-type: application/json",
				        'method'  => 'POST',
				        'content' => http_build_query($data)
				    )
				);
				$context  = stream_context_create($options);
				$result = file_get_contents($invoice_url, false, $context);
				if($result == FALSE){
					return "Error";
				}
				else{
					return $result;
				}
	    	} catch (Exception $e) {
	    		return $e;
	    	}
	    }

	    public function addItem($params) { 
	    	try{
		    	$invoice_url = "https://private-anon-273c2945a9-greeninvoice.apiary-mock.com/api/v1/items";
		        // $json_params = json_encode($params);

		    	$options = array(
					'http' => array(
				        'header'  => "Content-type: application/json",
				        'method'  => 'POST',
				        'content' => http_build_query($params)
				    )
				);
				$context  = stream_context_create($options);
				$result = file_get_contents($invoice_url, false, $context);
				if($result == FALSE){
					return "Error";
				}
				else{
					return $result;
				}
	    	} catch (Exception $e) {
	    		return $e;
	    	}
	    }

	    public function getItem($id) { 
	    	if(!is_string($id))
	    	{
	    		return "Error, id not string";
	    	}
	    	else{	
		      	try {
		      		$invoice_url = "https://private-anon-273c2945a9-greeninvoice.apiary-mock.com/api/v1/items/".urlencode($id);
					$invoice_json = file_get_contents($invoice_url);
					return $invoice_json;
		    	} catch (Exception $e) {
		    		return $e;
		    	}  
	    	}
	    }
	}
 ?>
