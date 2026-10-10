<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    echo json_encode([
        'status' => 'error',
        'message' => 'Método no permitido.',
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$variables = [
    'nombre' => trim((string) ($_POST['nombre'] ?? '')),
    'correo' => trim((string) ($_POST['correo'] ?? '')),
    'pais' => trim((string) ($_POST['pais'] ?? '')),
    'fav_language' => trim((string) ($_POST['fav_language'] ?? '')),
    'prueba' => array_map(
        static fn ($valor): string => trim((string) $valor),
        is_array($_POST['prueba'] ?? null) ? $_POST['prueba'] : []
    ),
];

$camposRequeridos = ['nombre', 'correo', 'pais', 'fav_language'];
$camposFaltantes = [];

foreach ($camposRequeridos as $campo) {
    if ($variables[$campo] === '') {
        $camposFaltantes[] = $campo;
    }
}

if ($camposFaltantes !== []) {
    http_response_code(422);
    echo json_encode([
        'status' => 'error',
        'message' => 'Complete los campos obligatorios: ' . implode(', ', $camposFaltantes) . '.',
        'missing_fields' => $camposFaltantes,
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

if (filter_var($variables['correo'], FILTER_VALIDATE_EMAIL) === false) {
    http_response_code(422);
    echo json_encode([
        'status' => 'error',
        'message' => 'Escriba un correo electrónico válido.',
        'missing_fields' => ['correo'],
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

echo json_encode([
    'status' => 'success',
    'message' => 'Tus datos se enviaron correctamente.',
    'variables' => $variables,
], JSON_UNESCAPED_UNICODE);
