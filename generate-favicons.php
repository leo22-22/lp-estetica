<?php
// Gera os favicons PNG a partir do SVG usando GD
// Execute: php generate-favicons.php

$sizes = [
    'public/favicon-16.png'      => 16,
    'public/favicon-32.png'      => 32,
    'public/apple-touch-icon.png' => 180,
];

foreach ($sizes as $path => $size) {
    $img = imagecreatetruecolor($size, $size);
    imageantialias($img, true);
    imagealphablending($img, false);
    imagesavealpha($img, true);

    // Fundo transparente
    $transparent = imagecolorallocatealpha($img, 0, 0, 0, 127);
    imagefill($img, 0, 0, $transparent);

    // Círculo rosa
    $pink = imagecolorallocate($img, 196, 116, 140);
    imagefilledellipse($img, $size/2, $size/2, $size, $size, $pink);

    // Pétalas brancas (simplificado)
    $white = imagecolorallocate($img, 255, 255, 255);
    $center = $size / 2;
    $petalLen = $size * 0.28;
    $petalW   = $size * 0.14;

    for ($i = 0; $i < 6; $i++) {
        $angle = deg2rad($i * 60);
        $px = $center + cos($angle) * $petalLen * 0.55;
        $py = $center + sin($angle) * $petalLen * 0.55;
        imagefilledellipse($img, (int)$px, (int)$py, (int)$petalW, (int)$petalLen, $white);
    }

    // Centro escuro e branco
    $dark = imagecolorallocate($img, 139, 79, 111);
    imagefilledellipse($img, $center, $center, (int)($size*0.22), (int)($size*0.22), $dark);
    imagefilledellipse($img, $center, $center, (int)($size*0.12), (int)($size*0.12), $white);

    imagepng($img, $path);
    imagedestroy($img);
    echo "Gerado: $path ($size x $size)\n";
}

echo "Favicons criados com sucesso!\n";
