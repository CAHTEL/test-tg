<?php

require_once __DIR__ . "/vendor/autoload.php";

const TELEGRAM_BOT_TOKEN = "7458023886:AAE_VPPHce0U4w6j_T-bz3iIJ9ZZzGb7Fkk";
const TELEGRAM_CHAT_ID = "402363816";

$str = "https://api.telegram.org/bot" . TELEGRAM_BOT_TOKEN . "/sendMessage?chat_id=" . TELEGRAM_CHAT_ID . "&text=" . urlencode("Hello, world!");

var_dump(file_get_contents($str));
printData(getAllExpenses());
