<?php

require "KapcsolatController.php";
require "KezdolapController.php";

$method = $_SERVER["REQUEST_METHOD"];
$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$path = trim($path, "/");


function matchRoute(string $uri, string $routePattern): array|false {
    $uriParts = explode("/", trim($uri, "/"));
    $routeParts = explode("/", trim($routePattern, "/"));

    if (count($uriParts) !== count($routeParts)) {
        return false;
    }

    $params = [];

    foreach ($routeParts as $i => $part) {
        if (str_starts_with($part, "{") && str_ends_with($part, "}")) {
            $paramName = trim($part, "{}");
            $params[$paramName] = $uriParts[$i];
        } elseif ($part !== $uriParts[$i]) {
            return false;
        }
    }

    return $params;
}


$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

$routes = [
    ["POST", "kapcsolat", [KapcsolatController::class, "UzenetKuldes"]],
    ["GET", "kapcsolat", [KapcsolatController::class, "FormMutatas"]],
    ["GET", "kezdolap", [KezdolapController::class, "KezdolapMutatas"]],
    ["GET", "akarmi/{x}/{y}", [KezdolapController::class, "KezdolapMutatas"]]
];


foreach ($routes as [$method, $pattern, $handler]) {
    if ($_SERVER["REQUEST_METHOD"] !== $method) continue;

    $params = matchRoute($uri, $pattern);

    if ($params !== false) {
        call_user_func_array($handler, array_values($params));
        exit;
    }
}

http_response_code(404);
echo "404 - Az oldal nem található.";


/*
$a = 3;
$b = 2; 


if ($a == 3 && $b == 4 ) {
        echo "Juuhuu";
}
*/


/*
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if ($request_parts[1] == "kezdolap") {
        include "start.html";
    }

    if ($request_parts[1] == "kapcsolat") {
        include "kapcsolat.html";
    }
}
*/

/*

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($request_parts[1] == "kapcsolat") {
        $controller = new KapcsolatController();
        $message = $controller->UzenetKuldes();
        include("elkuldve.html");
    }
}



if ($_SERVER["REQUEST_METHOD"] == "GET" && $request_parts[1] == "kapcsolat" ) {
    KapcsolatController::FormMutatas();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && $request_parts[1] == "kezdolap" ) {
    include "start.html";
}

*/