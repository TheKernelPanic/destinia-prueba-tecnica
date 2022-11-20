<?php
declare(strict_types=1);

namespace DestiniaPruebaTecnica\util;

use function trim, mb_strtolower, str_replace, preg_replace;

class InputTextNormalizer
{
    /**
     * @param string $input
     * @return string
     */
    public static function normalize(string $input): string
    {
        $input = mb_strtolower(trim($input));
        $input = preg_replace("/[\s]+/", '-', $input);
        $input = str_replace(['á', 'é', 'í', 'ó', 'ú'], ['a', 'e', 'i', 'o', 'u'], $input);

        return preg_replace("/[^a-z0-9\-]+/", '', $input);
    }
}