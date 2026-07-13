<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Storage;

class Compile extends Command
{
    public const BINARY = './node_modules/.bin/style-dictionary';
    public const CONFIG = 'style-dictionary-config.js';

    protected $signature = 'compile';
    protected $description = 'Run style-dictionary to compile tokens into styles';

    public function handle()
    {
        $binary = self::BINARY;
        $config = self::CONFIG;
        $commands = ['clean', 'build'];
        foreach ($commands as $command) {
            $process = Process::run("$binary $command --config=$config --silent");
            if ($process->failed()) {
                $this->fail($process->errorOutput());
            }
        }
        return 0;
    }
}
