<?php

namespace App\Library;

class TokenFile
{
    const TOKENS_DIR = 'tokens/';

    public static function getFilepath(\SplFileInfo $file)
    {
        return str($file->getPath())->after(self::TOKENS_DIR)->append('/' . $file->getFilename())->toString();
    }

    public static function collectItems($tokens)
    {
        $items = collect();
        foreach ($tokens as $item => $value) {
            if (str($item)->startsWith('$type')) {
                continue;
            } elseif (is_array($value)) {
                $items[$item] = self::collectItems($value);
            } else {
                $items[$item] = $value;
            }
        }
        return $items->sortKeys()->toArray();
    }
}
