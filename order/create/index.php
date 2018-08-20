<?php
ini_set('error_reporting', 0);

const API_URL = 'https://api.adcombo.com/api/v2/order/create/';
const API_KEY = 'bd50ecc788397512eb571cf1ac79d127';
const COUNTRIES = array('IT');

function log_order($request_url, $response)
{
    $ip = $_REQUEST['REMOTE_ADDR'];
    $date_now = date('Y-m-d H:i:s');
    $fp = fopen('orders.txt', 'a+');
    fwrite($fp, "Offer id: 2999\nIP: {$ip}\nDate: {$date_now}\nRequest url: {$request_url}\nResponse: {$response}\n\n\n=====================\n\n\n");
    fclose($fp);
}

function is_mobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

function redirect($path) {
    header('Location: ' . $path);
    echo '<meta http-equiv="refresh" content="0;url=' . $path . '">';
    exit();
}

if (file_exists('mobile') && is_mobile()) {
    redirect('mobile');
}

if (isset($_REQUEST['price']))
{
    $params = $_REQUEST;

    if (!isset($params['country_code'])) {
        $params['country_code'] = COUNTRIES[array_rand(COUNTRIES)];
    }

    $params['api_key'] = API_KEY;
    $params['offer_id'] = '2999';
    $params['base_url'] = $_SERVER['REQUEST_URI'];
    $params['referrer'] = $_SERVER['HTTP_REFERER'];
    $params['ip'] = $_SERVER['REMOTE_ADDR'];
    $parsed_referer = parse_url($_SERVER['HTTP_REFERER']);
    parse_str($parsed_referer['query'], $land_params);

    $request_url = API_URL . '?' . http_build_query($params + $land_params);

    $resp = file_get_contents($request_url);
    log_order($request_url, $resp);
    $data = json_decode($resp, true);

    if ($data['code'] == 'ok') {
        $order_data = base64_encode($params['name'] . '|' . $params['phone']);
        redirect('success.php?order_data=' . $order_data);
    }
}
?>