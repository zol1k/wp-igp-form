<?php
// Local test bootstrap for the IGP form outside WordPress.
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . DIRECTORY_SEPARATOR);
}

if (!function_exists('esc_html')) {
    function esc_html($text)
    {
        return htmlspecialchars((string) $text, ENT_QUOTES, 'UTF-8');
    }
}
?><!doctype html>
<html lang="sk">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>IGP Form - Lokalny test</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="wordpress-theme/igp-form/css/form.css">
  <style>
    body { background: #f8f9fb; }
    .local-wrap { padding: 24px 0 40px; }
  </style>
</head>
<body>
  <main class="local-wrap">
    <?php include __DIR__ . '/wordpress-theme/igp-form/templates/form-template.php'; ?>
  </main>

  <script src="wordpress-theme/igp-form/js/form.js"></script>
</body>
</html>
