<?php
date_default_timezone_set('America/New_York');
// misc tools
$_PUT;
$_DELETE;


/**
 * Returns a mysqli object with a valid connection to the server's database
 */
function mysqlConnect() {
    require $_SERVER['DOCUMENT_ROOT'] . '/config.php';
    return $link;
}

/**
 * Gets the sessionId from header data 
 */
function getSessionId() {
    return getAllHeaders()['X-Session-Id'];
}

/**
 * Returns request data
 */
function getMethod() {
    return $_SERVER['REQUEST_METHOD'];
}

function requireGET() {
    if (getMethod() !== 'GET') {
        failure('GET method required for this endpoint');
    }
}

function requirePOST() {
    if (getMethod() !== 'POST') {
        failure('POST method required for this endpoint');
    }
}

function requirePassword() {
    $password = reqParam('pass', 'GET');
    if ($password !== 'Team_Portal!') {
        failure("Incorect password");
    }
}

function getParams($method) {
    $params = array();

    if ($method == 'GET') {
        $params = $_GET;

    } else if ($method == 'POST') {
        $params = $_POST;

    } else if ($method == 'PUT') {
        global $_PUT;
        if(!isset($_PUT)) {
            parse_str(file_get_contents("php://input"), $_PUT);
        }
        $params = $_PUT;

    } else if ($method == 'DELETE') {
        global $_DELETE;
        if(!isset($_DELETE)) {
            parse_str(file_get_contents("php://input"), $_DELETE);
        }
        $params = $_PUT;

    } else if ($method == 'BOTH') {
        $params = getParams('GET');
        if (empty($params)) {
            $params = getParams('POST');
        }
    }

    return $params;
}

function optParam($key, $method) {
    $params = getParams($method);
    $raw = $params[$key];
    return isset($raw) ? $raw : NULL;
}

function reqParam($key, $method) {
    $val = optParam($key, $method);
    if ($val == NULL) {
        failure('Required param \'' . $key . '\' missing');
    }
    return $val;
}

/**
 * Returns json with an error message
 */
function failure($error) {
    $data = array();
    $data['success'] = false;
    $data['error'] = $error;

    header('Content-Type: application/json');
    exit(json_encode($data));
}

/**
 * Returns json for success with the result if provided
 */
function success($resultArr = array()) {
    $data = array();
    $data['success'] = true;
    $data['result'] = $resultArr;

    header('Content-Type: application/json');
    exit(json_encode($data));
}

/**
 * Prepares a mysqli_stmt safely. Use this in conjunction with execute_stmt().
 */
function prepare_stmt($conn, $query) {
    if (!$stmt = $conn->prepare($query)) {
        failure("Prepare failed: " . $conn->error);
    }
    return $stmt;
}

/**
 * Executes a prepared mysqli_stmt safely. Parameters must already be bound
 */
function execute_stmt($stmt) {
    if (!$stmt->execute()) {
        failure("Execute failed: " . $stmt->error);
    }
    
    $result = $stmt->get_result();
    if($result === false) {
        return null;
    }
    
    $array = array();
    while (!empty(($row = $result->fetch_assoc()))) {
         if(json_encode($row)) {
             $array[] = $row;
         } else {
             //fixEncoding($row);
             //$array[] = $row;
         }
    }
    
    return $array;
}

function execute_query($conn, $query) {
    $stmt = prepare_stmt($conn, $query);
    return execute_stmt($stmt);
}

function fixEncoding(&$array) {
    foreach ($array as $key => $value) {
        $array[$key] = addslashes($value);
    }
}

function decodeJSONValues(&$array) {
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            decodeJSONValues($value);
            $array[$key] = $value;

        } else {
            $newValue = json_decode($value, true);
            if (isset($newValue)) {
                $array[$key] = $newValue;
            }
        }
    }
}

function getRootUrl() {
    $http = empty($_SERVER['HTTPS']) ? "http://" : "https://";
    return $http . $_SERVER['HTTP_HOST'];
}

function getFile($filePath) {
    return file_get_contents($filePath);
}

function getJSONFile($filePath) {
    return json_decode(getFile($filePath), true);
}

function makeAPIRequest($urlPart, $method, array $data = array()) {
    $url = getRootUrl() . "/api" . $urlPart;
    $result = makeRequest($url, $method, $data);
    $decoded = json_decode($result, true);

    return $decoded == null ? $result : $decoded;
}
 
function makeRequest($url, $method, array $data = array()) {
    
    if($method === "GET") {
        $url .= (strpos($url, '?') === FALSE ? '?' : '') . http_build_query($data);
    }

    $header = array(
        'TPL-token: ' . $_COOKIE['tpl_token'] 
    );
    
    $curlOpts = array(
        CURLOPT_URL => $url,
        CURLOPT_HEADER => 0,
        CURLOPT_HTTPHEADER => $header,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_TIMEOUT => 4
    );
    
    if($method !== "GET") {
        $curlOpts[CURLOPT_POST] = 1;
        $curlOpts[CURLOPT_POSTFIELDS] = http_build_query($data);
        $curlOpts[CURLOPT_FRESH_CONNECT] = 1;
        $curlOpts[CURLOPT_FORBID_REUSE] = 1;
    }
    
    $curl = curl_init(); 
    curl_setopt_array($curl, $curlOpts); 

    if( ! $result = curl_exec($curl)) { 
        trigger_error(curl_error($curl)); 
    }

    curl_close($curl);
    return $result;
}