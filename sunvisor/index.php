<?php session_start();
$period_cookie = 2592000; // 30 дней (2592000 секунд)

if($_GET){
    setcookie("utm_source",$_GET['utm_source'],time()+$period_cookie);
    setcookie("utm_medium",$_GET['utm_medium'],time()+$period_cookie);
    setcookie("utm_term",$_GET['utm_term'],time()+$period_cookie);
    setcookie("utm_content",$_GET['utm_content'],time()+$period_cookie);
    setcookie("utm_campaign",$_GET['utm_campaign'],time()+$period_cookie);
}

if(!isset($_SESSION['utms'])) {
    $_SESSION['utms'] = array();
    $_SESSION['utms']['utm_source'] = '';
    $_SESSION['utms']['utm_medium'] = '';
    $_SESSION['utms']['utm_term'] = '';
    $_SESSION['utms']['utm_content'] = '';
    $_SESSION['utms']['utm_campaign'] = '';
}
$_SESSION['utms']['utm_source'] = $_GET['utm_source'] ? $_GET['utm_source'] : $_COOKIE['utm_source'];
$_SESSION['utms']['utm_medium'] = $_GET['utm_medium'] ? $_GET['utm_medium'] : $_COOKIE['utm_medium'];
$_SESSION['utms']['utm_term'] = $_GET['utm_term'] ? $_GET['utm_term'] : $_COOKIE['utm_term'];
$_SESSION['utms']['utm_content'] = $_GET['utm_content'] ? $_GET['utm_content'] : $_COOKIE['utm_content'];
$_SESSION['utms']['utm_campaign'] = $_GET['utm_campaign'] ? $_GET['utm_campaign'] : $_COOKIE['utm_campaign'];

//created by WebDEVils
?>
<html lang="uk">
<head>
<meta charset="utf-8"/>
<meta content="width=480" name="viewport"/>
<title>Поляризаційний козирок для авто — сонце більше не сліпить</title>
<meta content="Козирок 2 в 1 з поляризаційним екраном і бічною шторкою. Захищає від сонця спереду і збоку, прибирає відблиски. Оплата при отриманні." name="description"/>
<link href="favicon.png" rel="shortcut icon" type="image/png"/>
<link href="css/push.css" rel="stylesheet"/>
<link href="css/Bratello.css" rel="stylesheet" type="text/css"/>
<link href="css/fontss.css" rel="stylesheet"/>
<link href="css/slicka.css" rel="stylesheet"/>
<link href="css/options.css" rel="stylesheet"/>
<link href="css/nastyle.css" rel="stylesheet"/>
<link href="css/swiper-bundle.min.css" rel="stylesheet"/>
<link href="css/all.min.css" rel="stylesheet" type="text/css"/>
<link href="css/add.css" rel="stylesheet"/>
<link href="css/styles.css" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700;900&display=swap" rel="stylesheet">
<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1627430141996907');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1627430141996907&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
<style>
body {
    font-family: 'Outfit', sans-serif;
    cursor: default;
}
.fake-notification {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    background: linear-gradient(90deg, #F07800, #FF9F1C);
    color: #fff;
    padding: 12px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(255, 159, 28, 0.3);
    font-size: 14px;
    z-index: 9999;
    display: none;
    align-items: center;
    gap: 12px;
    width: 95%;
    max-width: 400px;
    border: none;
    font-family: Arial, sans-serif;
}
.fake-notification.show {
    display: flex;
    animation: slideDown 0.5s ease-out;
}
.fake-notification.hide {
    animation: slideUp 0.5s ease-in forwards;
}
@keyframes slideDown {
    from { top: -50px; opacity: 0; }
    to { top: 20px; opacity: 1; }
}
@keyframes slideUp {
    from { top: 20px; opacity: 1; }
    to { top: -50px; opacity: 0; }
}
.fake-notification .notif-icon-wrap {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: #fff;
    border: 3px solid #FF9F1C;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.fake-notification .notif-icon-wrap svg {
    width: 24px;
    height: 24px;
    fill: #666;
}
.fake-notification .notif-content {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    line-height: 1.3;
}
.fake-notification .notif-title {
    font-weight: 900;
    font-size: 16px;
    color: #fff;
}
.fake-notification .notif-desc {
    font-size: 13px;
    color: #eee;
}
.fake-notification .notif-time {
    color: #fff;
    font-weight: bold;
    font-size: 13px;
    white-space: nowrap;
    background: rgba(255,255,255,0.2);
    padding: 2px 8px;
    border-radius: 20px;
}

.offer video { display: block; width: 100%; height: auto; }

/* Benefits Checklist Style */
.benefits-checklist-new {
    display: flex;
    flex-direction: column;
    gap: 20px;
    padding: 0 15px;
    margin: 30px auto;
    max-width: 420px;
}
.benefits-checklist-new .benefit-item {
    display: flex;
    align-items: center;
    gap: 15px;
    background: transparent;
}
.benefits-checklist-new .benefit-icon {
    width: 44px;
    height: 44px;
    background: linear-gradient(135deg, #FF9F1C, #F07800);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    font-weight: 900;
    flex-shrink: 0;
    box-shadow: 0 4px 10px rgba(255, 159, 28, 0.3);
    border: 3px solid #fff;
}
.benefits-checklist-new .benefit-text {
    text-align: left;
    font-size: 16px;
    color: #333;
    line-height: 1.4;
}
.benefits-checklist-new .benefit-text strong {
    display: block;
    font-size: 20px;
    color: #F07800;
    font-weight: 900;
    margin-bottom: 5px;
    text-transform: uppercase;
    text-shadow: 1px 1px 0px rgba(0,0,0,0.05);
}

/* Normal text blocks */
.text-bg {
    padding: 20px;
    margin: 25px 15px;
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.3);
    text-align: left;
}
.text-bg h3 {
    color: #1a1a1a;
    font-size: 19px;
    font-weight: 900;
    margin-top: 0;
    margin-bottom: 8px;
    text-transform: uppercase;
}
.text-bg p {
    color: #333;
    font-size: 18px;
    line-height: 1.6;
    margin: 0;
}

/* Google Reviews */
.google-reviews-container {
    background: #ECEFF3;
    padding: 20px 15px;
    font-family: Arial, sans-serif;
    margin-top: 20px;
}
.google-rating-header {
    background: #fff;
    border-radius: 15px;
    padding: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    margin-bottom: 20px;
}
.google-rating-header .left {
    display: flex;
    align-items: center;
    gap: 10px;
}
.google-rating-header .left img {
    width: 40px;
}
.google-rating-header .left .title-g {
    font-weight: bold;
    font-size: 16px;
    color: #333;
}
.google-rating-header .left .verified {
    color: #008744;
    font-size: 11px;
    display: flex;
    align-items: center;
    gap: 3px;
    font-weight: bold;
}
.google-rating-header .right {
    text-align: right;
}
.google-rating-header .right .score {
    font-size: 28px;
    font-weight: 900;
    color: #202124;
}
.google-rating-header .right .out-of {
    font-size: 14px;
    color: #70757a;
}
.google-stats {
    display: flex;
    justify-content: space-between;
    font-size: 11px;
    color: #70757a;
    margin-top: 10px;
    padding-top: 10px;
    border-top: 1px solid #eee;
}
.google-stats .green {
    color: #008744;
    font-weight: bold;
}
.progress-bar {
    height: 4px;
    background: #e0e0e0;
    border-radius: 2px;
    margin-top: 5px;
    overflow: hidden;
}
.progress-bar .fill {
    height: 100%;
    background: #FF9F1C;
    width: 94%;
}

.google-review-card {
    background: #fff;
    border-radius: 15px;
    padding: 15px;
    margin-bottom: 15px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}
.g-rev-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 10px;
}
.g-rev-user {
    display: flex;
    align-items: center;
    gap: 10px;
}
.g-rev-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 16px;
}
.g-rev-name {
    font-weight: bold;
    font-size: 15px;
    color: #202124;
}
.g-rev-stars {
    color: #fbbc04;
    font-size: 14px;
    margin-top: 2px;
}
.g-rev-badge {
    background: #e6f4ea;
    color: #137333;
    padding: 3px 8px;
    border-radius: 12px;
    font-size: 10px;
    font-weight: bold;
    display: flex;
    align-items: center;
    gap: 3px;
    text-transform: uppercase;
}
.g-rev-badge.new {
    background: #e8f0fe;
    color: #1967d2;
}
.g-rev-text {
    font-size: 14px;
    color: #3c4043;
    line-height: 1.5;
    margin-bottom: 10px;
}
.g-rev-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 12px;
    color: #70757a;
}
.g-rev-actions {
    display: flex;
    gap: 15px;
    align-items: center;
}
.g-rev-actions div {
    display: flex;
    align-items: center;
    gap: 5px;
}

/* Sticky Bottom Button */
.sticky-bottom-bar {
    position: fixed;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%) translateY(100%);
    width: 100%;
    max-width: 480px;
    background: rgba(31, 41, 51, 0.96);
    backdrop-filter: blur(8px);
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 20px;
    box-shadow: 0 -4px 20px rgba(0,0,0,0.4);
    z-index: 999;
    box-sizing: border-box;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
    transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.4s;
    opacity: 0;
    pointer-events: none;
    border: 1px solid rgba(255,255,255,0.1);
    border-bottom: none;
}
.sticky-bottom-bar.visible {
    transform: translateX(-50%) translateY(0);
    opacity: 1;
    pointer-events: auto;
}
.sticky-bottom-bar .price-info {
    color: white;
}
.sticky-bottom-bar .price-info .main-price {
    font-size: 20px;
    font-weight: 900;
    line-height: 1;
}
.sticky-bottom-bar .price-info .stock {
    font-size: 12px;
    color: #FFD59A;
    display: flex;
    align-items: center;
    gap: 4px;
    margin-top: 4px;
}
.sticky-bottom-bar .stock::before {
    content: '';
    display: inline-block;
    width: 8px;
    height: 8px;
    background: #FFD59A;
    border-radius: 50%;
}
.sticky-bottom-bar .btn-order {
    background: linear-gradient(135deg, #FF9F1C, #F07800);
    color: white;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    font-weight: 900;
    font-size: 18px;
    padding: 15px 35px;
    border-radius: 50px;
    text-decoration: none;
    box-shadow: 0 10px 25px rgba(255, 159, 28, 0.4);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: 2px solid rgba(255,255,255,0.2);
    display: inline-block;
    animation: pulseGlow 2s infinite;
}
@keyframes pulseGlow {
    0% { box-shadow: 0 0 0 0 rgba(255, 159, 28, 0.7); }
    70% { box-shadow: 0 0 0 15px rgba(255, 159, 28, 0); }
    100% { box-shadow: 0 0 0 0 rgba(255, 159, 28, 0); }
}

.sticky-bottom-bar .btn-order:active {
    transform: translateY(2px) scale(0.98);
    box-shadow: 0 2px 10px rgba(255, 159, 28, 0.3);
}

.main-title-box {
    padding: 0;
    text-align: center;
    margin: 0;
}
.main-title-box h1 {
    display: block;
    background: linear-gradient(135deg, #FF9F1C, #F07800);
    padding: 12px 10px;
    border-radius: 0;
    color: #ffffff;
    font-size: 24px;
    font-weight: 900;
    margin: 0;
    text-transform: uppercase;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    border: none;
    border-bottom: 4px solid #B85A00;
    line-height: 1.2;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
    letter-spacing: 0.5px;
}
.main-title-box h1::before {
    content: '🚗 ';
}

/* Multi-pack Offer Block */
.multi-pack-offer {
    background: #F7F8FA;
    border-radius: 12px;
    margin: 30px auto;
    max-width: 420px;
    width: 92%;
    padding: 20px 0 0 0;
    overflow: hidden;
    color: #1F2933;
    font-family: Arial, sans-serif;
    box-shadow: 0 15px 35px rgba(31,41,51,0.12);
    border: 1px solid rgba(31,41,51,0.15);
}
.multi-pack-offer h2 {
    text-align: center;
    font-size: 18px;
    font-weight: 900;
    margin: 0 0 15px 0;
    text-transform: uppercase;
    color: #1F2933;
    letter-spacing: 1px;
}
.mp-row {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 18px 15px;
    border-top: 1px solid #E3E7EC;
    background: #F7F8FA;
    gap: 12px;
}
.mp-row.highlight {
    background: linear-gradient(90deg, #FFF4E3, #FFE7C2);
    border-left: 4px solid #FF9F1C;
}
.mp-row .mp-qty {
    font-size: 18px;
    color: #3E4C59;
}
.mp-row .mp-price {
    font-size: 24px;
    font-weight: 900;
    color: #F07800;
    margin: 0;
    padding: 0;
    position: static !important;
}
.mp-row .mp-discount {
    background: #ff3b30;
    color: white;
    padding: 5px 10px;
    border-radius: 6px;
    font-weight: 900;
    font-size: 15px;
}
.mp-ribbon-wrap {
    position: absolute;
    top: 0;
    right: 0;
    width: 65px;
    height: 65px;
    overflow: hidden;
    z-index: 2;
}
.mp-ribbon-wrap .mp-ribbon {
    position: absolute;
    top: 14px;
    right: -26px;
    background: #ff7b00;
    color: #000;
    font-weight: 900;
    font-size: 12px;
    text-align: center;
    width: 100px;
    transform: rotate(45deg);
    text-transform: uppercase;
    box-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

/* ===== ПАЛІТРА ПІД АВТОТОВАР — перекриває зовнішні css ===== */
body { background: #F3F5F7; }
.wrap { background: #F3F5F7; }
.button,
.btn-block .button,
.order_form .button {
    background: linear-gradient(135deg, #FF9F1C, #F07800) !important;
    color: #fff !important;
    border-color: #F07800 !important;
    box-shadow: 0 8px 20px rgba(255,159,28,0.35) !important;
}
.price_item.new .value,
.price_item.new .text { color: #F07800 !important; }
.price_item.old .value { color: #8a9694 !important; }
.title span { color: #F07800 !important; }
.order-list h4 { color: #FF9F1C !important; }
.field:focus { border-color: #FF9F1C !important; outline: none; }
.benefit_item { color: #1F2933 !important; }
</style>
</head>
<body style="cursor: default;">
<div class="wrap">


<div class="offer_section offer3">
<div class="main-title-box">
    <h1>ПОЛЯРИЗАЦІЙНИЙ КОЗИРОК ДЛЯ АВТО<br><span style="font-size:15px;font-weight:600;">Сонце не сліпить · захист спереду і збоку · без відблисків</span></h1>
</div>

<section class="offer">
<video src="images1/main.mp4" poster="images1/main.png" autoplay muted loop playsinline preload="auto"></video>
<div class="benefits_list clearfix">
<div class="benefit_item">Доставка по Україні</div>
<div class="benefit_item">Обмежена пропозиція</div>
<div class="benefit_item">Оплата при отриманні</div>
</div>
<div class="price_block clearfix">
<div class="price_item old" style="opacity: .6;">
<div class="text">Звичайна ціна:</div>
<div class="value">1199 грн</div>
</div>
<div class="price_item new">
<div class="text" style="font-size: 21px; font-weight: 600; text-transform: uppercase; 
            line-height: 23px;"><span>Ціна сьогодні</span></div>
<div class="value">799 грн</div>
</div>
</div>
<br/>
<div class="btn-block">
<a class="button" href="#order6" style="position: relative;">
<span class="flex absolute h-10 w-10 top-2 left-7" style="position: absolute; left: 1.75rem; top: 0.5rem; display: flex; height: 2.5rem; width: 2.5rem;">
<span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-200 opacity-75"></span>
</span>
            Замовити зі знижкою
          </a>
</div>
</section>
</div>
<section class="generate" style="background:#F3F5F7; padding-bottom: 80px;">

<div class="multi-pack-offer">
    <h2>БЕРЕШ ДВА — ЕКОНОМИШ</h2>
    <div class="mp-row">
        <div class="mp-qty">1 шт =</div>
        <div class="mp-price">799 грн</div>
    </div>
    <div class="mp-row highlight">
        <div class="mp-qty">2 шт =</div>
        <div class="mp-price">1348 грн</div>
        <div class="mp-discount">−250 грн</div>
        <div class="mp-ribbon-wrap"><div class="mp-ribbon">ХІТ</div></div>
    </div>
</div>

<div class="benefits-checklist-new">
    <div class="benefit-item">
        <div class="benefit-icon">✓</div>
        <div class="benefit-text">
            <strong>Сонце не б'є в очі</strong>
            Зранку і ввечері низьке сонце більше не пробивається під козирок. Не мружитесь і бачите дорогу.
        </div>
    </div>
    <div class="benefit-item">
        <div class="benefit-icon">✓</div>
        <div class="benefit-text">
            <strong>Захист спереду і збоку</strong>
            Бічна шторка висувається до вікна, а лобове скло лишається закритим. Звичайний козирок так не вміє.
        </div>
    </div>
    <div class="benefit-item">
        <div class="benefit-icon">✓</div>
        <div class="benefit-text">
            <strong>Без сліпучих відблисків</strong>
            Поляризаційний екран гасить блиск мокрого асфальту, скла і хрому машин попереду.
        </div>
    </div>
    <div class="benefit-item">
        <div class="benefit-icon">✓</div>
        <div class="benefit-text">
            <strong>Ставиться за 1 хвилину</strong>
            Два ремені на липучці, без інструментів. Підходить для більшості авто.
        </div>
    </div>
</div>

<img src="images1/q1.png" class="img-text" alt="">

<div class="text-bg">
    <h3>Поляризаційний козирок 2 в 1</h3>
    <p><strong>Їдете проти сонця — і бачите дорогу</strong><br/><br/>
    Кріпиться на ваш штатний козирок і додає дві зони захисту: бічну шторку та поляризаційний екран.<br/><br/>
    Корпус з еко-шкіри, на ньому кишеня на блискавці для документів і карток.</p>
</div>

<section class="b1">
<div class="slider-photo">
<div class="item">
<img class="img-text" src="images1/q2.png"/>
</div>
</div>
</section>

<div class="text-bg">
    <h3>Знайома ситуація?</h3>
    <p>Зранку або ввечері сонце світить прямо в очі. Опускаєте козирок — воно пробивається під ним. Повертаєте до бічного вікна — відкривається лобове скло. Їдете, мружачись, майже наосліп.<br/><br/>
    Цей козирок закриває і перед, і бік одночасно, а поляризаційний екран прибирає сліпуче світло.</p>
</div>

<section class="b1">
<div class="slider-photo">
<div class="item">
<img class="img-text" src="images1/q3.png"/>
</div>
</div>
</section>

<div class="text-bg">
    <h3>Чим відрізняється від звичайного козирка</h3>
    <p>Штатний козирок закриває тільки одну сторону, низьке сонце проходить під ним, а від відблисків він не допомагає взагалі.<br/><br/>
    Тут екран опускається нижче, шторка закриває бічне вікно, а поляризація працює як сонцезахисні окуляри для всього лобового скла.</p>
</div>



<section class="b1">
<div class="slider-photo">
<div class="item">
<img class="img-text" src="images1/q4.png"/>
</div>
</div>
</section>

<div class="text-bg">
    <h3>Що входить і коли рятує</h3>
    <p><strong>1. Корпус з кріпленням</strong> — фіксується на штатний козирок двома ременями на липучці.<br/><br/>
    <strong>2. Бічна шторка</strong> — висувається на 27 см і закриває сонце збоку.<br/><br/>
    <strong>3. Поляризаційний екран</strong> — опускається під козирок і гасить відблиски.<br/><br/>
    <strong>Коли реально рятує:</strong> дорога на роботу проти ранкового сонця; дорога додому на заході; мокрий асфальт після дощу; довгі поїздки трасою.</p>
</div>
<img src="images1/q5.png" class="img-text" alt="">
<div class="text-bg">
    <h3>Характеристики</h3>
    <p><strong>Корпус:</strong> 31 × 13,5 см, еко-шкіра<br/>
    <strong>Бічна шторка:</strong> 27 × 11 см<br/>
    <strong>Поляризаційний екран:</strong> 27 × 12 см<br/>
    <strong>Кріплення:</strong> 2 ремені на липучці, обрізаються під козирок<br/>
    <strong>Кишеня:</strong> на блискавці<br/>
    <strong>Підходить:</strong> легкові авто, SUV, вантажівки<br/>
    <strong>Важливо:</strong> екран для світлого часу доби, вночі його піднімають<br/><br/>
    <strong>Беріть два</strong> — для водія і пасажира або для другого авто в родині. Другий комплект на 250 грн дешевше.</p>
</div>



<section class="b1">
<h2 class="title"><span>Як замовити?</span></h2>
<ul class="order-list">
<li>
<div class="txt">
<h4>Крок 1:</h4>
<p>Заповніть форму замовлення</p>
</div>
</li>
<li>
<div class="txt">
<h4>Крок 2:</h4>
<p>Дочекайтесь дзвінка оператора</p>
</div>
</li>
<li>
<div class="txt">
<h4>Крок 3:</h4>
<p>Оплатіть товар після отримання</p>
</div>
</li>
</ul>
</section>
</section>
<div class="offer_section offer3">
<div class="main-title-box">
    <h1>ПОЛЯРИЗАЦІЙНИЙ КОЗИРОК ДЛЯ АВТО<br><span style="font-size:15px;font-weight:600;">Сонце не сліпить · захист спереду і збоку · без відблисків</span></h1>
</div>
<div class="today">
<div class="marquee-container">
<div class="marquee-text">
            ДРУГИЙ КОЗИРОК — НА 250 ГРН ДЕШЕВШЕ · ОПЛАТА ПРИ ОТРИМАННІ
          </div>
</div>
</div>
<section class="offer">
<img alt="" src="images1/main.png"/>
<div class="benefits_list clearfix">
<div class="benefit_item">Доставка по Україні</div>
<div class="benefit_item">Обмежена пропозиція</div>
<div class="benefit_item">Оплата при отриманні</div>
</div>
<div class="price_block clearfix">
<div class="price_item old" style="opacity: .6;">
<div class="text">Звичайна ціна:</div>
<div class="value">1199 грн</div>
</div>
<div class="price_item new">
<div class="text" style="font-size: 21px; font-weight: 600; text-transform: uppercase; 
            line-height: 23px;"><span>Ціна сьогодні</span></div>
<div class="value">799 грн</div>
</div>
</div>
<div style="text-align: center; margin: 10px auto; display: block; font-size: 24px; line-height: 26px;     color: black;">
<strong>Залишіть заявку</strong>
<p>та отримайте консультацію</p>
</div>
<form action="order.php" class="order_form" id="order6" method="POST" name="order-form">
<select class="field" name="count">
    <option value="2;1348">2 шт (вигода 250 грн) - 1348 грн</option>
    <option value="1;799">1 шт - 799 грн</option>
</select>
<input class="field" name="name" placeholder="Введіть Ваше ім'я" type="text"/>
<input class="field" name="phone" placeholder="Введіть Ваш телефон" required="" type="tel"/>
<button class="button" style="position: relative;">
<span class="flex absolute h-10 w-10 top-2 left-7" style="position: absolute; left: 1.75rem; top: 0.5rem; display: flex; height: 2.5rem; width: 2.5rem;">
<span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-200 opacity-75"></span>
</span>
            Придбати
          </button>
</form>
<footer >
<div style="text-align: center; margin: 10px auto; display: block; font-size: 14px; line-height: 26px;     color: black;">
<a href="politics.html" style="cursor: pointer;color:  #000;" target="_blank">Політика конфіденційності</a><br/>
            Всі права захищено © <?= date('Y') ?>
          </div>
</footer>
</section>

<!-- Sticky Bottom Bar -->
<div class="sticky-bottom-bar">
    <div class="price-info">
        <div class="main-price">799 грн</div>
        <div class="stock">Другий −250 грн</div>
    </div>
    <a href="#order6" class="btn-order">ЗАМОВИТИ</a>
</div>

<script crossorigin="anonymous" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.maskedinput.min.js"></script>
<script>
        $('input[name=phone]').mask("+38 (999) 999 99 99");
        $(document).on('submit', 'form', function () {
          let btn = $(this).find('button');
          $(btn).text('Відправка...');
          $(btn).attr('disabled');
          $(btn).css('background-color', 'gray');
          $(btn).css('color', 'white');
        })
</script>
<script>
    // Sticky bottom bar scroll logic
    window.addEventListener('scroll', function() {
        const bar = document.querySelector('.sticky-bottom-bar');
        const firstScreenHeight = window.innerHeight * 0.8;
        const scrollHeight = document.documentElement.scrollHeight;
        const scrollPosition = window.pageYOffset + window.innerHeight;
        const bottomThreshold = 700; // Distance from bottom to hide the bar
        
        if (window.pageYOffset > firstScreenHeight && (scrollHeight - scrollPosition) > bottomThreshold) {
            bar.classList.add('visible');
        } else {
            bar.classList.remove('visible');
        }
    });
</script>
<script defer="" src="js/scripts.js"></script>
<script defer="" src="js/hide.js"></script>
<script src="js/antu-spam.js"></script>
</div>
</body>
</html>