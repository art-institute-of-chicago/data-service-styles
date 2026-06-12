<?php

use Illuminate\Support\Facades\Route;

const TOKENS_DIR = 'tokens/';

$directory = new RecursiveDirectoryIterator(base_path(TOKENS_DIR), FilesystemIterator::SKIP_DOTS);
$files = new RecursiveIteratorIterator($directory);

function getFilepath(SplFileInfo $file)
{
    return str($file->getPath())->after(TOKENS_DIR)->append('/' . $file->getFilename())->toString();
}

function collectItems($tokens)
{
    $items = collect();
    foreach ($tokens as $item => $value) {
        if (str($item)->startsWith('$type')) {
            continue;
        } elseif (is_array($value)) {
            $items[$item] = collectItems($value);
        } else {
            $items[$item] = $value;
        }
    }
    return $items->sortKeys()->toArray();
}

foreach ($files as $file) {
    $filepath = getFilepath($file);
    Route::get($filepath, function() use ($file) {
        return view('json', ['tokens' => file_get_contents($file)]);
    });

    $path = str($filepath)->beforeLast('.')->toString();
    Route::get($path, function() use ($file) {
        $tokens = json_decode(file_get_contents($file), true);
        $category = array_key_first($tokens);
        $tokens = $tokens[$category];
        $type = array_key_first($tokens);
        $tokens = $tokens[$type];
        $items = collectItems($tokens);
        return view('tokens', [
            'filepath' => '/' . getFilepath($file),
            'category' => $category,
            'type' => $type,
            'items' => $items,
        ]);
    });
}

Route::get('/', function () use ($directory, $files) {
    $tree = array();
    foreach ($files as $file) {
        $link = (object) [
            'label' => str($file->getFilename())->beforeLast('.'),
            'href' => str(getFilepath($file))->beforeLast('.'),
        ];
        $node = $file->isDir() ? array($file->getFilename() => array()) : array($link);
        for ($depth = $files->getDepth() -1; $depth >= 0; $depth--) {
            $node = array($files->getSubIterator($depth)->current()->getFilename() => $node);
        }
        $tree = array_merge_recursive($tree, $node);
    }
    return view('index', ['tree' => $tree]);
});
