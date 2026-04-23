<?php
// playlists.php
// PHP 7+
// -------------------------------------------------------------
// Hier kannst du deine SoundCloud-Playlists eintragen.
// Jede Playlist besteht aus einem Array mit 'title' und 'url'.
// Beispiel-Eintrag:
// ['title' => 'Meine Playlist', 'url' => 'https://soundcloud.com/artist/sets/playlist-slug']
//
// Ich habe deine übermittelte Playlist-URL hinzugefügt.
// Platzhalter/Kommentare zeigen, wo du weitere Links einfügst.
// -------------------------------------------------------------

$playlists = [
    // Dein eingefügter Playlist-Link:
    ['title' => '21-03-2026 (Safeplace_161 Verden)', 'url' => 'https://soundcloud.com/safeplace_161_verden/sets/21-03-2026o/s-SuOetBDmx6K?si=c65a5aa8b69e46898918acb35aab7c69&utm_source=clipboard&utm_medium=text&utm_campaign=social_sharing'],

    // PLATZHALTER: Weitere Playlists hier hinzufügen:
    // ['title' => 'Titel deiner Playlist', 'url' => 'https://soundcloud.com/artist/sets/dein-playlist-slug'],
    // ['title' => 'Noch eine Playlist', 'url' => 'https://soundcloud.com/...'],
];

// Option: visual=true für das große visuelle Widget, visual=false für den schmalen Player
$visual = true;

?>
<!doctype html>
<html lang="de">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>SoundCloud Playlists</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 16px; background:#f8f8f8; color:#222; }
    .playlist { background:#fff; border-radius:8px; padding:12px; margin-bottom:16px; box-shadow:0 1px 4px rgba(0,0,0,0.06); }
    .playlist h3 { margin:0 0 8px 0; font-size:1.05rem; }
    .links { margin-bottom:10px; }
    .links a { color:#ff5500; text-decoration:none; margin-right:10px; }
    /* responsive embed */
    .player { position:relative; width:100%; height:0; overflow:hidden; border-radius:6px; }
    /* Visual player is taller */
    .player.visual { padding-bottom:166.66%; } /* ~ 5:3 ratio */
    /* Classic compact player */
    .player.compact { padding-bottom:120px; } /* fixed-ish height fallback */
    .player iframe { position:absolute; top:0; left:0; width:100%; height:100%; border:0; }
    .note { font-size:0.9rem; color:#666; margin-top:6px; }
    code { background:#f4f4f4; padding:2px 6px; border-radius:4px; }
  </style>
</head>
<body>
  <h1>Meine SoundCloud Playlists</h1>

  <?php if (empty($playlists)): ?>
    <p>Keine Playlists eingetragen. Trage URLs im Array oben ein.</p>
  <?php endif; ?>

  <?php foreach ($playlists as $p):
      // Sicherstellen, dass eine URL vorhanden ist
      $url = trim($p['url'] ?? '');
      if ($url === '') continue;
      $title = htmlspecialchars($p['title'] ?? $url, ENT_QUOTES, 'UTF-8');

      // ------------------------------------------------------------------
      // Player-Parameter:
      // Du kannst hier Standard-Parameter anpassen (z.B. color, auto_play).
      // Wenn du fertige Player-URLs einfügen möchtest, siehe Kommentar weiter unten.
      // ------------------------------------------------------------------
      $params = [
        'url' => $url,
        'color' => '#ff5500',
        'auto_play' => 'false',
        'hide_related' => 'false',
        'show_comments' => 'true',
        'show_user' => 'true',
        'show_reposts' => 'false',
        'visual' => $visual ? 'true' : 'false'
      ];
      $src = 'https://w.soundcloud.com/player/?' . http_build_query($params);
  ?>
    <div class="playlist">
      <h3><?php echo $title; ?></h3>
      <div class="links">
        <a href="<?php echo htmlspecialchars($url, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer">Öffne Playlist auf SoundCloud</a>
        <a href="<?php echo htmlspecialchars($src, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer">Player-URL (Embed)</a>
      </div>

      <div class="player <?php echo $visual ? 'visual' : 'compact'; ?>">
        <iframe
          scrolling="no"
          allow="autoplay"
          src="<?php echo htmlspecialchars($src, ENT_QUOTES, 'UTF-8'); ?>">
        </iframe>
      </div>

      <div class="note">
        Tipp: Du kannst das Aussehen ändern, indem du <code>$visual = false</code> setzt (kleiner Player).
      </div>
    </div>
  <?php endforeach; ?>

  <!--
    PLATZHALTER FÜR FERTIGE EMBED-PLAYER-URL (OPTIONAL)

    Falls du bereits eine fertige Embed-Player-URL von SoundCloud hast (z.B.
    "https://w.soundcloud.com/player/?url=https%3A//soundcloud.com/artist/sets/...&color=%23ff5500"),
    kannst du solche URLs ebenfalls einbinden. Beispiel:

    <?php
    // Beispiel: Füge zusätzlich fertige Embed-Player-URLs (als Strings) in das Array $embedPlayers
    // und entkommentiere folgenden Block, um sie direkt einzubetten.
    /*
    $embedPlayers = [
        // 'https://w.soundcloud.com/player/?url=...&color=%23ff5500',
        // 'https://w.soundcloud.com/player/?url=...&visual=true'
    ];
    foreach ($embedPlayers as $embedUrl) {
        // echo a player block for each embedUrl
    }
    */
    ?>

    // PLATZHALTER-HINWEIS:
    // - Zum Hinzufügen neuer Playlists: füge Einträge im $playlists-Array oben hinzu.
    // - Zum Einfügen fertiger Embed-URLs: benutze das kommentierte $embedPlayers-Beispiel.
  -->

</body>
</html>
