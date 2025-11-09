<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(403);
    echo '<h3>Acceso no autorizado.</h3>';
    exit;
}

// Lectura segura de inputs
$nombre     = filter_input(INPUT_POST, 'nombre_completo', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: 'No especificado';
$email      = filter_input(INPUT_POST, 'email_profesional', FILTER_SANITIZE_EMAIL) ?: 'No especificado';
$institucion= filter_input(INPUT_POST, 'institucion', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: 'No especificado';
$area       = filter_input(INPUT_POST, 'area_especializacion', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: 'No especificado';
$nivel      = filter_input(INPUT_POST, 'nivel_educativo', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: 'No especificado';
$experiencia= filter_input(INPUT_POST, 'anos_experiencia', FILTER_SANITIZE_NUMBER_INT) ?: 'No especificado';
$perfil     = filter_input(INPUT_POST, 'url_perfil', FILTER_SANITIZE_URL) ?: 'No especificado';
$resumen    = filter_input(INPUT_POST, 'resumen_experiencia', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?: 'No especificado';

// Checkboxes (si no vienen, quedan en "No")
$interes_neurohud   = isset($_POST['interes_neurohud'])   ? 'Sí' : 'No';
$interes_mindbridge = isset($_POST['interes_mindbridge']) ? 'Sí' : 'No';
$interes_synapsim   = isset($_POST['interes_synapsim'])   ? 'Sí' : 'No';

// Aceptación de términos
$acepta = isset($_POST['acepta_terminos']) ? 'Aceptado' : 'No aceptado';

// Función auxiliar para salida segura en HTML
function h($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Datos de Registro - NeuroLink</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <style>
        body {
            background: #0f1724;
            color: #e6eef8;
            font-family: Arial, sans-serif;
            margin: 40px;
            text-align: center;
        }
        table {
            width: 90%;
            max-width: 900px;
            margin: 20px auto;
            border-collapse: collapse;
            background: rgba(255,255,255,0.04);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 18px rgba(0,0,0,0.6);
        }
        th, td {
            padding: 12px 14px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: rgba(255,255,255,0.06);
            color: #06b6d4;
            width: 35%;
        }
        tr:hover {
            background: rgba(255,255,255,0.02);
        }
        h1 {
            color: #7c3aed;
            margin-bottom: 8px;
        }
        .note {
            color: #94a3b8;
            font-size: 13px;
            margin-bottom: 18px;
        }
    </style>
</head>
<body>
    <h1>Datos de Registro del Colaborador</h1>
    <p class="note">Revisa la información enviada. Guarda este registro si lo deseas.</p>

    <table role="table" aria-label="Datos de registro">
        <thead>
            <tr>
                <th>Campo</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Nombre Completo</td>
                <td><?= h($nombre) ?></td>
            </tr>
            <tr>
                <td>Email Profesional</td>
                <td><?= h($email) ?></td>
            </tr>
            <tr>
                <td>Institución / Universidad</td>
                <td><?= h($institucion) ?></td>
            </tr>
            <tr>
                <td>Área de Especialización</td>
                <td><?= h($area) ?></td>
            </tr>
            <tr>
                <td>Nivel Educativo</td>
                <td><?= h($nivel) ?></td>
            </tr>
            <tr>
                <td>Años de Experiencia</td>
                <td><?= h($experiencia) ?></td>
            </tr>
            <tr>
                <td>Interés en NeuroHUD</td>
                <td><?= h($interes_neurohud) ?></td>
            </tr>
            <tr>
                <td>Interés en MindBridge</td>
                <td><?= h($interes_mindbridge) ?></td>
            </tr>
            <tr>
                <td>Interés en SynapSim</td>
                <td><?= h($interes_synapsim) ?></td>
            </tr>
            <tr>
                <td>Perfil Académico</td>
                <td><?= h($perfil) ?></td>
            </tr>
            <tr>
                <td>Resumen de Experiencia</td>
                <td><?= nl2br(h($resumen)) ?></td>
            </tr>
            <tr>
                <td>Acepta Términos</td>
                <td><?= h($acepta) ?></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
