<?php
// Адмінка блоку відгуків: завантаження і видалення скриншотів.
// Відкривається за адресою вашсайт/admin.php

// ↓↓↓ Задайте свій пароль (мінімум 8 символів). Поки пароль порожній — вхід вимкнено.
$ADMIN_PASSWORD = '';

$DIR       = __DIR__ . '/reviews';
$MAX_BYTES = 8 * 1024 * 1024;
$TYPES     = [IMAGETYPE_JPEG => 'jpg', IMAGETYPE_PNG => 'png', IMAGETYPE_WEBP => 'webp'];

session_start();
header('X-Robots-Tag: noindex, nofollow');

if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(16));
}
$csrf    = $_SESSION['csrf'];
$message = '';
$error   = '';

function review_files($dir) {
    $files = [];
    foreach (is_dir($dir) ? scandir($dir) : [] as $f) {
        if (preg_match('/^[\w-]+\.(jpg|png|webp)$/', $f)) $files[] = $f;
    }
    rsort($files); // імена починаються з дати — нові першими
    return $files;
}

$logged = !empty($_SESSION['reviews_admin']);
$is_post = $_SERVER['REQUEST_METHOD'] === 'POST';

if ($is_post && !hash_equals($csrf, $_POST['csrf'] ?? '')) {
    http_response_code(400);
    exit('Сесія застаріла. Оновіть сторінку.');
}

if ($is_post && isset($_POST['login'])) {
    if (strlen($ADMIN_PASSWORD) >= 8 && hash_equals($ADMIN_PASSWORD, (string)($_POST['password'] ?? ''))) {
        session_regenerate_id(true);
        $_SESSION['reviews_admin'] = true;
        header('Location: admin.php');
        exit;
    }
    sleep(2);
    $error = 'Невірний пароль.';
}

if ($is_post && isset($_POST['logout'])) {
    $_SESSION = [];
    session_destroy();
    header('Location: admin.php');
    exit;
}

if ($logged && $is_post && isset($_POST['upload'])) {
    if (!is_dir($DIR)) mkdir($DIR, 0755, true);
    $files = $_FILES['shots'] ?? null;
    $added = 0;
    if ($files && is_array($files['name'])) {
        foreach ($files['name'] as $i => $name) {
            if ($files['error'][$i] !== UPLOAD_ERR_OK) continue;
            if ($files['size'][$i] > $MAX_BYTES) { $error = 'Файл «' . htmlspecialchars($name) . '» більший за 8 МБ.'; continue; }
            $info = @getimagesize($files['tmp_name'][$i]);
            if (!$info || !isset($TYPES[$info[2]])) { $error = 'Файл «' . htmlspecialchars($name) . '» не є JPG, PNG чи WEBP.'; continue; }
            $target = date('YmdHis') . '-' . bin2hex(random_bytes(4)) . '.' . $TYPES[$info[2]];
            if (move_uploaded_file($files['tmp_name'][$i], "$DIR/$target")) $added++;
        }
    }
    if ($added) $message = "Додано скриншотів: $added.";
    elseif (!$error) $error = 'Оберіть хоча б один файл.';
}

if ($logged && $is_post && isset($_POST['delete'])) {
    $f = basename((string)$_POST['delete']);
    if (in_array($f, review_files($DIR), true) && unlink("$DIR/$f")) {
        $message = 'Скриншот видалено.';
    }
}

$list = $logged ? review_files($DIR) : [];
?>
<!DOCTYPE html>
<html lang="uk">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<title>Відгуки — адмінка</title>
<style>
  * { box-sizing: border-box; }
  body { margin: 0; background: #0E1116; color: #E8EBF0; font: 16px/1.5 -apple-system, 'Segoe UI', Roboto, Arial, sans-serif; }
  .box { max-width: 560px; margin: 0 auto; padding: 24px 16px 60px; }
  h1 { font-size: 24px; margin: 0 0 4px; }
  p.sub { color: #8A93A1; margin: 0 0 20px; }
  .card { background: #171B22; border: 1px solid #232934; border-radius: 16px; padding: 18px; margin-bottom: 16px; }
  input[type=password], input[type=file] { width: 100%; padding: 14px; border-radius: 12px; border: 1px solid #232934; background: #0E1116; color: #fff; font-size: 16px; }
  button { cursor: pointer; border: 0; border-radius: 12px; font-weight: 700; font-size: 16px; }
  .btn { width: 100%; margin-top: 12px; padding: 15px; color: #140E00; background: linear-gradient(135deg, #FFB020, #FF7A00); }
  .link { background: none; color: #8A93A1; padding: 0; font-weight: 500; text-decoration: underline; }
  .msg { padding: 12px 14px; border-radius: 12px; margin-bottom: 16px; }
  .ok { background: rgba(79,194,138,.15); color: #7BE0AE; }
  .err { background: rgba(255,90,90,.15); color: #FF9A9A; }
  .grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; }
  .shot { background: #0E1116; border: 1px solid #232934; border-radius: 12px; overflow: hidden; }
  .shot img { display: block; width: 100%; height: 220px; object-fit: cover; object-position: top; }
  .shot form { margin: 0; }
  .del { width: 100%; padding: 10px; background: #232934; color: #FF9A9A; border-radius: 0; }
  .top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
  .empty { color: #8A93A1; text-align: center; padding: 20px 0; }
</style>
</head>
<body>
<div class="box">
<?php if (!$logged): ?>
  <h1>Вхід в адмінку відгуків</h1>
  <p class="sub">Тут можна додавати і видаляти скриншоти відгуків на сайті.</p>
  <?php if (strlen($ADMIN_PASSWORD) < 8): ?>
    <div class="msg err">Пароль не задано. Відкрийте файл admin.php і впишіть пароль (мінімум 8 символів) у рядок $ADMIN_PASSWORD.</div>
  <?php else: ?>
    <?php if ($error): ?><div class="msg err"><?= $error ?></div><?php endif; ?>
    <form method="post" class="card">
      <input type="hidden" name="csrf" value="<?= $csrf ?>">
      <input type="password" name="password" placeholder="Пароль" autofocus required>
      <button class="btn" name="login" value="1">Увійти</button>
    </form>
  <?php endif; ?>
<?php else: ?>
  <div class="top">
    <div>
      <h1>Відгуки</h1>
      <p class="sub" style="margin:0">На сайті: <?= count($list) ?> скриншот(ів)</p>
    </div>
    <form method="post"><input type="hidden" name="csrf" value="<?= $csrf ?>"><button class="link" name="logout" value="1">Вийти</button></form>
  </div>

  <?php if ($message): ?><div class="msg ok"><?= $message ?></div><?php endif; ?>
  <?php if ($error): ?><div class="msg err"><?= $error ?></div><?php endif; ?>

  <form method="post" enctype="multipart/form-data" class="card">
    <input type="hidden" name="csrf" value="<?= $csrf ?>">
    <input type="file" name="shots[]" accept="image/jpeg,image/png,image/webp" multiple required>
    <button class="btn" name="upload" value="1">Додати скриншоти</button>
    <p class="sub" style="margin:10px 0 0;font-size:14px">JPG, PNG або WEBP до 8 МБ. Можна обрати кілька одразу. Нові показуються першими.</p>
  </form>

  <?php if (!$list): ?>
    <div class="empty">Скриншотів ще немає — поки їх немає, блок відгуків на сайті прихований.</div>
  <?php else: ?>
    <div class="grid">
      <?php foreach ($list as $f): ?>
        <div class="shot">
          <a href="reviews/<?= $f ?>" target="_blank"><img src="reviews/<?= $f ?>" alt=""></a>
          <form method="post" onsubmit="return confirm('Видалити цей скриншот?')">
            <input type="hidden" name="csrf" value="<?= $csrf ?>">
            <button class="del" name="delete" value="<?= $f ?>">Видалити</button>
          </form>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
<?php endif; ?>
</div>
</body>
</html>
