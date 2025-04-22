<?php




$routes = [
    ["GET", "", [TermekController::class, "list"]],
    ["GET", "login", [UserController::class, "login"]],
    ["GET", "logout", [UserController::class, "logout"]],
    ["POST", "login", [UserController::class, "check_login"]],
    ["GET", "admin-list", [TermekController::class, "list"]],
    ["GET", "termek/{id}", [TermekController::class, "updatepage"]],
    ["POST", "termek", [TermekController::class, "create"]],
    ["POST", "termek/{id}", [TermekController::class, "update"]],
    ["GET", "termekdelete/{id}", [TermekController::class, "delete"]],

];


// URI feldolgozása
$requestUri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH); // csak az útvonal
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestParts = explode("/", trim($requestUri, "/"));




foreach ($routes as [$method, $routeUri, $handler]) {
    $routeParts = explode("/", $routeUri); // pl. ["felhasznalok", "{id}"]

    // Ha metódus nem egyezik, ugrunk
    if ($method !== $requestMethod) continue;

    // Ha nem ugyanannyi elem van az URI-kban, ugrunk
    if (count($routeParts) !== count($requestParts)) continue;

    $params = [];
    $matched = true;

    foreach ($routeParts as $index => $part) {
        if (preg_match("/^{(.+)}$/", $part, $matches)) {
            // dinamikus paraméter, pl. {id}
            $params[$matches[1]] = $requestParts[$index];
        } elseif ($part !== $requestParts[$index]) {
            $matched = false;
            break;
        }
    }

    if ($matched) {
        call_user_func_array($handler, $params ? array_values($params) : []);
        exit;
    }
}

// Ha egyik route sem illeszkedik:
http_response_code(404);
echo "Nincs ilyen végpont.";