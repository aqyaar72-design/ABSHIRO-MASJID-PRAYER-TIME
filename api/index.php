<?php
require_once __DIR__ . '/../config.php';

date_default_timezone_set('Asia/Kolkata');

$today = date('Y-m-d');

$row = [
    'prayer_date' => $today,
    'fajr' => '04:54:00',
    'dhuhr' => '12:08:00',
    'asr' => '16:29:00',
    'maghrib' => '18:09:00',
    'isha' => '19:21:00'
];

if ($pdo) {
    $s = $pdo->prepare(
        "SELECT * FROM prayer_times WHERE prayer_date=?"
    );
    $s->execute([$today]);
    $r = $s->fetch();

    if ($r) {
        $row = $r;
    }
}

function pt($t) {
    return date('h:i A', strtotime($t));
}

$prayers = [
    [
        'key' => 'fajr',
        'name' => 'Fajr',
        'ar' => 'الفجر',
        'time' => $row['fajr'],
        'icon' => '🌅'
    ],
    [
        'key' => 'dhuhr',
        'name' => 'Dhuhr',
        'ar' => 'الظهر',
        'time' => $row['dhuhr'],
        'icon' => '☀️'
    ],
    [
        'key' => 'asr',
        'name' => 'Asr',
        'ar' => 'العصر',
        'time' => $row['asr'],
        'icon' => '🌤️'
    ],
    [
        'key' => 'maghrib',
        'name' => 'Maghrib',
        'ar' => 'المغرب',
        'time' => $row['maghrib'],
        'icon' => '🌇'
    ],
    [
        'key' => 'isha',
        'name' => 'Isha',
        'ar' => 'العشاء',
        'time' => $row['isha'],
        'icon' => '🌙'
    ]
];
?>
<!doctype html>
<html lang="so">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="theme-color" content="#062d24">

<title>ABSHIRO MASJID • Prayer Time</title>

<link rel="stylesheet" href="/assets/style.css">
</head>

<body>

<div class="app">

<header class="topbar">

    <div class="brand">

        <div class="mosque">🕌</div>

        <div>
            <strong>ABSHIRO MASJID</strong>
            <small>PRAYER TIMETABLE • HYDERABAD</small>
        </div>

    </div>

    <button id="soundButton" class="sound">
        🔊 <span>Enable Adhan</span>
    </button>

</header>


<main class="container">

<section class="hero">

    <div class="ornament"></div>

    <div class="hero-content">

        <div class="arabic">
            أَوْقَاتُ الصَّلَاةِ
        </div>

        <div id="clock" class="big-clock">
            --:--:--
        </div>

        <div id="date" class="date">
            --
        </div>

        <div class="place">
            📍 Hyderabad, India
        </div>

    </div>

</section>


<section class="next-card">

    <div class="next-left">

        <span class="eyebrow">
            SALAADDA XIGTA
        </span>

        <h1 id="nextName">
            --
        </h1>

        <div id="nextAr" class="arabic-small">
            --
        </div>

        <div class="next-label">
            Waqtiga salaadda
        </div>

        <strong id="nextTime">
            --
        </strong>

    </div>


    <div class="count-box">

        <span class="eyebrow">
            INTA KA DHIMAN
        </span>

        <strong id="countdown">
            --:--:--
        </strong>

        <small>
            until next prayer
        </small>

    </div>

</section>


<section class="schedule">

    <div class="section-head">

        <div>

            <span class="eyebrow">
                MAANTA
            </span>

            <h2>
                Jadwalka 5-ta Salaadood
            </h2>

        </div>

        <span class="today-pill">
            TODAY
        </span>

    </div>


    <div class="prayers">

        <?php foreach($prayers as $p): ?>

        <div
            class="prayer-row"
            data-key="<?=htmlspecialchars($p['key'])?>"
        >

            <div class="prayer-icon">
                <?=$p['icon']?>
            </div>

            <div class="prayer-name">

                <strong>
                    <?=htmlspecialchars($p['name'])?>
                </strong>

                <small>
                    <?=htmlspecialchars($p['ar'])?>
                </small>

            </div>

            <div class="prayer-time">
                <?=pt($p['time'])?>
            </div>

            <div class="status-dot"></div>

        </div>

        <?php endforeach; ?>

    </div>

</section>


<section class="features">

    <article>

        <span>🕌</span>

        <div>

            <b>Masjid Timetable</b>

            <p>
                Jadwalka 5-ta salaadood si cad ugu muuqda
                telefoon iyo computer.
            </p>

        </div>

    </article>


    <article>

        <span>🔔</span>

        <div>

            <b>Adhan Alert</b>

            <p>
                Enable Adhan kadib browser-ku wuxuu
                diyaarinayaa digniinta waqtiga salaadda.
            </p>

        </div>

    </article>

</section>


<div class="notice">

    ⚠️

    <span>

        <b>Fiiro:</b>

        Waqtiyada ku jira database-ka waa jadwal tijaabo ah.
        Ku beddel waqtiyada rasmiga ah ee masjidka marka la xaqiijiyo.

    </span>

</div>

</main>


<footer>

    <strong>
        ABSHIRO MASJID
    </strong>

    <small>
        Prayer Time System • <?=date('Y')?>
    </small>

</footer>

</div>


<script>

window.PRAYER_DATA =
<?=json_encode($prayers, JSON_UNESCAPED_UNICODE)?>;

window.TIMEZONE = "Asia/Kolkata";

</script>


<script src="/assets/app.js"></script>

</body>

</html>
