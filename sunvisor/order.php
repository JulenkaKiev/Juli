<?php
// Приймає заявку з лендингу: зберігає в orders.csv і (за бажанням) надсилає в Telegram.

// Заповніть, щоб отримувати заявки в Telegram. Порожні значення — лише запис у файл.
$TELEGRAM_BOT_TOKEN = '';
$TELEGRAM_CHAT_ID   = '';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false]);
    exit;
}

// Ловушка для ботів: приховане поле має бути порожнім.
if (!empty($_POST['website'])) {
    echo json_encode(['ok' => true]);
    exit;
}

$name    = trim(strip_tags($_POST['name'] ?? ''));
$phone   = preg_replace('/[^\d+]/', '', $_POST['phone'] ?? '');
$package = ($_POST['package'] ?? '1') === '2' ? '2' : '1';
$prices  = ['1' => 549, '2' => 949];

if (mb_strlen($name) < 2 || strlen(preg_replace('/\D/', '', $phone)) < 10) {
    http_response_code(422);
    echo json_encode(['ok' => false, 'error' => 'invalid']);
    exit;
}

$name = mb_substr($name, 0, 100);
$utm  = [];
foreach (['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term'] as $key) {
    if (!empty($_GET[$key]))  $utm[$key] = $_GET[$key];
}
$referer = $_SERVER['HTTP_REFERER'] ?? '';
if ($referer && ($query = parse_url($referer, PHP_URL_QUERY))) {
    parse_str($query, $params);
    foreach ($params as $key => $value) {
        if (strpos($key, 'utm_') === 0 && is_string($value)) $utm[$key] = $value;
    }
}

$row = [
    date('Y-m-d H:i:s'),
    $name,
    $phone,
    $package . ' шт',
    $prices[$package] . ' грн',
    http_build_query($utm),
];

$file = __DIR__ . '/orders.csv';
$fh = fopen($file, 'a');
if ($fh) {
    fputcsv($fh, $row);
    fclose($fh);
}

if ($TELEGRAM_BOT_TOKEN && $TELEGRAM_CHAT_ID) {
    $text = "🛒 Нова заявка: козирок\n"
          . "Ім'я: {$name}\n"
          . "Телефон: {$phone}\n"
          . "Кількість: {$package} шт — {$prices[$package]} грн"
          . ($utm ? "\nUTM: " . http_build_query($utm, '', ', ') : '');
    @file_get_contents(
        "https://api.telegram.org/bot{$TELEGRAM_BOT_TOKEN}/sendMessage",
        false,
        stream_context_create(['http' => [
            'method'  => 'POST',
            'header'  => 'Content-Type: application/x-www-form-urlencoded',
            'content' => http_build_query(['chat_id' => $TELEGRAM_CHAT_ID, 'text' => $text]),
            'timeout' => 5,
        ]])
    );
}

echo json_encode(['ok' => true]);
