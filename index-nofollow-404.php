<?php
header("X-Robots-Tag: noindex, nofollow", true);
header('HTTP/1.0 404 Not Found', true, 404);

echo '<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noindex, nofollow" />
	<title>404 Not found</title>
</head>
<body>
	404 Not found
</body>
</html>';

// http_response_code(404);
// header("HTTP/1.1 301 Moved Permanently");
// header("Location: https://atomjoy.github.io");
