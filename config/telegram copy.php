<?php

define('TELEGRAM_BOT_TOKEN', 'ISI-BOT-TOKEN');
define('TELEGRAM_CHAT_ID', 'ISI-CHAT-ID');

function sendTelegramMessage($message)
{
    $url = "https://api.telegram.org/bot"
         . TELEGRAM_BOT_TOKEN
         . "/sendMessage";

    $data = [
        'chat_id' => TELEGRAM_CHAT_ID,
        'text' => $message,
        'parse_mode' => 'HTML'
    ];

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if ($response === false) {
        curl_close($ch);
        return false;
    }

    curl_close($ch);

    return json_decode($response, true);
}
