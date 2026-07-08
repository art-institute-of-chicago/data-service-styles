<?php

use App\Library\TokenFile;
use Illuminate\Support\Facades\Route;

// Token files directory iterator
$directory = new RecursiveDirectoryIterator(base_path(TokenFile::TOKENS_DIR), FilesystemIterator::SKIP_DOTS);
// Token files iterator
$files = new RecursiveIteratorIterator($directory);
// For each token file, create two routes
foreach ($files as $file) {
    $filepath = TokenFile::getFilepath($file);
    // Route to the raw JSON token file
    Route::get($filepath, function() use ($file) {
        return view('json', ['tokens' => file_get_contents($file)]);
    });

    $path = str($filepath)->beforeLast('.')->toString();
    // Route to the human-readable token list
    Route::get($path, function() use ($file) {
        $tokens = json_decode(file_get_contents($file), true);
        $category = array_key_first($tokens);
        $tokens = $tokens[$category];
        $type = array_key_first($tokens);
        $tokens = $tokens[$type];
        $items = TokenFile::collectItems($tokens);
        return view('tokens', [
            'filepath' => '/' . TokenFile::getFilepath($file),
            'category' => $category,
            'type' => $type,
            'items' => $items,
        ]);
    });
}

Route::get('/', function () use ($files) {
    $tree = array();
    foreach ($files as $file) {
        $link = (object) [
            'label' => str($file->getFilename())->beforeLast('.'),
            'href' => str(TokenFile::getFilepath($file))->beforeLast('.'),
        ];
        $node = $file->isDir() ? array($file->getFilename() => array()) : array($link);
        for ($depth = $files->getDepth() -1; $depth >= 0; $depth--) {
            $node = array($files->getSubIterator($depth)->current()->getFilename() => $node);
        }
        $tree = array_merge_recursive($tree, $node);
    }
    return view('index', ['tree' => $tree]);
});
