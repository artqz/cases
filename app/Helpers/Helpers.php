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