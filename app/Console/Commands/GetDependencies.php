<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GetDependencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getdependencies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Downloads necessary fonts, css and javascript files';

    protected function createDir(string $path)
    {
        if (!file_exists($path)) {
            mkdir($path, 0775, true);
        }
    }

    protected function getFile(string $source, string $dest)
    {
        file_put_contents($dest, file_get_contents($source));
    }

    protected function getBootstrap()
    {
        $path = 'public/vendor/bootstrap/';
        $this->createDir(rtrim($path, '/') . '/fonts');
        $this->getFile('https://cdn.jsdelivr.net/npm/bootstrap-icons@x.x.x/font/bootstrap-icons.css', $path . 'bootstrap-icons.css');
        $this->getFile('https://cdn.jsdelivr.net/npm/bootstrap-icons@x.x.x/font/bootstrap-icons.min.css', $path . 'bootstrap-icons.min.css');
        $this->getFile('https://cdn.jsdelivr.net/npm/bootstrap-icons@x.x.x/font/fonts/bootstrap-icons.woff', $path . 'fonts/bootstrap-icons.woff');
        $this->getFile('https://cdn.jsdelivr.net/npm/bootstrap-icons@x.x.x/font/fonts/bootstrap-icons.woff2', $path . 'fonts/bootstrap-icons.woff2');
        $this->getFile('https://cdn.jsdelivr.net/npm/bootstrap@x.x.x/dist/css/bootstrap.min.css', $path . 'bootstrap.min.css');
        $this->getFile('https://cdn.jsdelivr.net/npm/bootstrap@x.x.x/dist/css/bootstrap.min.css.map', $path . 'bootstrap.min.css.map');
        $this->getFile('https://cdn.jsdelivr.net/npm/bootstrap@x.x.x/dist/js/bootstrap.bundle.min.js', $path . 'bootstrap.bundle.min.js');
        $this->getFile('https://cdn.jsdelivr.net/npm/bootstrap@x.x.x/dist/js/bootstrap.bundle.min.js.map', $path . 'bootstrap.bundle.min.js.map');
    }

    protected function getAlpine()
    {
        $path = 'public/vendor/alpine/';
        $this->createDir(rtrim($path, '/'));
        $this->getFile('https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js', $path . 'alpine.js');
    }

    protected function getFlatpickr()
    {
        $path = 'public/vendor/flatpickr/';
        $this->createDir(rtrim($path, '/'));
        $this->getFile('https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css', $path . 'flatpickr.min.css');
        $this->getFile('https://cdn.jsdelivr.net/npm/flatpickr', $path . 'flatpickr.min.js');
        $this->getFile('https://npmcdn.com/flatpickr/dist/l10n/sv.js', $path . 'sv.js');
    }

    protected function getSummernote()
    {
        $path = 'public/vendor/summernote/';
        $this->createDir(rtrim($path, '/').'/font');
        $this->getFile('https://cdn.jsdelivr.net/npm/summernote@x.x.x/dist/summernote-bs5.min.css', $path . 'summernote-bs5.min.css');
        $this->getFile('https://cdn.jsdelivr.net/npm/summernote@x.x.x/dist/summernote-bs5.min.css.map', $path . 'summernote-bs5.css.map');
        $this->getFile('https://cdn.jsdelivr.net/npm/summernote@x.x.x/dist/font/summernote.woff2', $path . 'font/summernote.woff2');
        $this->getFile('https://cdn.jsdelivr.net/npm/summernote@x.x.x/dist/font/summernote.woff', $path . 'font/summernote.woff');
        $this->getFile('https://cdn.jsdelivr.net/npm/summernote@x.x.x/dist/font/summernote.ttf', $path . 'font/summernote.ttf');
        $this->getFile('https://cdn.jsdelivr.net/npm/summernote@x.x.x/dist/summernote-bs5.min.js', $path . 'summernote-bs5.min.js');
        $this->getFile('https://cdn.jsdelivr.net/npm/summernote@x.x.x/dist/summernote-bs5.min.js.map', $path . 'summernote-bs5.min.js.map');
    }

    protected function getJQuery()
    {
        $path = 'public/vendor/jquery/';
        $this->createDir(rtrim($path, '/'));
        $this->getFile('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', $path . 'jquery.min.js');
        $this->getFile('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.map', $path . 'jquery.min.js.map');
    }

    protected function getTableSort()
    {
        $path = 'public/vendor/';
        $this->createDir(rtrim($path, '/'));
        $this->getFile('https://raw.githubusercontent.com/stationer/SortTable/master/sort-table.min.js', $path . 'sort.js');
    }

    protected function getMoment()
    {
        $path = 'public/vendor/moment/';
        $this->createDir(rtrim($path, '/'));
        $this->getFile('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js', $path . 'moment-with-locales.min.js');
        $this->getFile('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js.map', $path . 'moment-with-locales.min.js.map');
    }


    /*
    protected function getTemplate()
    {
        $path = '';
        $this->createDir(rtrim($path, '/'));
        $this->getFile('', $path . '');
        $this->getFile('', $path . '');
    }
    */

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->getBootstrap();
        $this->getJQuery();
        $this->getAlpine();
        $this->getFlatpickr();
        $this->getSummernote();
        $this->getTableSort();
        $this->getMoment();
        $this->info("Dependencies downloaded.");
        return 0;
    }
}
