<?php

/**
 * @param string $message
 * @param int $code
 */
function response($message, $code = 200)
{
    echo var_dump($message);
    die(http_response_code($code));
}

/**
 * @param string $message
 * @param int $code
 */
function responseJson($message, $code = 200)
{
    header('Content-type: application/json');
    echo json_encode($message);
    die(http_response_code($code));
}

/**
 * @param string $url
 */
function redirect($url)
{
    header("Location: $url");
    $error = "asd";
}

/**
 */
function redirectBack()
{
    $headers = apache_request_headers();
    $lastUrl = $headers["Referer"];
    redirect($lastUrl);
}

/**
 * Example $data = ["string", 2,"another string" ,2.02], => $types = "sisd"
 * String = 's';
 * Integer = 'i';
 * Double = 'd';
 * @param array $data
 * @return string
 */
function dataTypesToString($data)
{
    $types = '';
    foreach ($data as $dt) {
        $varType = gettype($dt);
        switch ($varType) {
            case 'integer':
                $types .= 'i';
                break;
            case 'string':
                $types .= 's';
                break;
            case 'double':
                $types .= 'd';
                break;
            default:
                $types .= 's';
        }
    }
    return $types;
}

/**
 * Remove items from array
 * @param $array
 * @param array $toRemove
 * @return array
 */
function filterVars($array, $toRemove = [])
{
    if (count($toRemove) === 0)
        $toRemove = [
            'connection',
            'table',
            'primaryKey',
            'query',
            'values',
            'timestamps',
            'with',
            'CREATED_AT',
            'UPDATED_AT'
        ];
    return array_filter(
        $array,
        function ($key) use ($toRemove) {
            foreach ($toRemove as $item) {
                if ($item == $key) {
                    return false;
                }
            }
            return true;
        }, ARRAY_FILTER_USE_KEY
    );
}

/**
 * @param string $view
 * @param array $data
 * @param boolean $withLayout
 */
function view($view, $data = null, $withLayout = true)
{
    if ($data) {
        extract($data);
    }
    if ($withLayout)
        include "./views/layout/header.php";

    require_once "./views/$view.php";

    if ($withLayout)
        include "./views/layout/footer.php";
}

/**
 * @param string $component
 * @param array $data
 * @param string $prefix
 */
function includeComponent($component, $data = null, $prefix = "")
{
    if ($data) {
        extract($data, EXTR_PREFIX_ALL, $prefix);
    }
    include "./views/$component.php";
}

/**
 * Check if user is authenticated.
 * @return bool
 */
function isAuthenticated()
{
    if (isset($_COOKIE["auth"]))
        return $_COOKIE["auth"] == "1";
    else
        return false;
}
