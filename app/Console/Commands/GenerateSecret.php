<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class GenerateSecret extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'secret:generate {--show}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the shared secret';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $sure = $this->anticipate('Are you sure that you have not set this on the recovery server (y/n)?', ['y', 'n']);
        $secret = $this->getRandomKey($this->laravel['config']['app.cipher']);

        if ($this->option('show') && $sure = 'y') {
            return $this->line('<comment>'.$secret.'</comment>');
        }

        $path = base_path('.env');

        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                'SHARED_SECRET='.$this->laravel['config']['app.secret'], 'SHARED_SECRET='.$secret, file_get_contents($path)
            ));
        }

        $this->laravel['config']['app.secret'] = $secret;

        $this->info("Application Shared Secret [$secret] set successfully.");
    }

    /**
     * Generate a random key for the application.
     *
     * @param  string  $cipher
     * @return string
     */
    protected function getRandomKey($cipher)
    {
        if ($cipher === 'AES-128-CBC') {
            return Str::random(16);
        }

        return Str::random(32);
    }

}
