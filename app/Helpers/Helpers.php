<?php
function getInventory() {
    $url = 'http://steamcommunity.com/inventory/76561198000501285/440/2?l=english&count=5000';
    $tuCurl = curl_init();
    curl_setopt($tuCurl, CURLOPT_URL, $url);
    curl_setopt($tuCurl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($tuCurl);
    curl_close($tuCurl);
    $data = json_decode($result);
    dd($data);
}

function check_http_status($url)
{
    $user_agent = 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0)';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSLVERSION, 3);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $page = curl_exec($ch);

    $err = curl_error($ch);
    if (!empty($err))
        return $err;

    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $httpcode;
}

function avatar ($email_hash, $steam_avatar) {
    if ($steam_avatar) {
        $avatar = $steam_avatar;
    }
    else {
        $avatar = 'https://secure.gravatar.com/avatar/'.$email_hash.'?s=32&d=identicon';
    }
    return $avatar;
}

function region($id) {
    switch ($id) {
        case 0:
            $region = 'Нет';
            break;
        case 1:
            $region = 'Китай';
            break;
        case 2:
            $region = 'Гонгконг и Тайвань';
            break;
        case 3:
            $region = 'Индия';
            break;
        case 4:
            $region = 'Польша';
            break;
        case 5:
            $region = 'Германия';
            break;
        case 6:
            $region = 'Россия и СНГ';
            break;
        case 7:
            $region = 'Юго-Восточная Азия';
            break;
        case 8:
            $region = 'Южная Америка';
            break;
        case 9:
            $region = 'Турция';
            break;
    }
    return $region;
}