<?php
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