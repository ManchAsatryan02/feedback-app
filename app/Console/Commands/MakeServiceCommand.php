<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name} {folder?}';

    protected $files;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Created Service in Service folder';

     /**
     * Create a new command instance.
     *
     * @return void
     */
    // public function __construct()
    public function __construct(Filesystem $files)
    {
        $this->files=$files;
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $viewName=$this->argument('name');
        $folder=$this->argument('folder');
        if ($folder === '' || is_null($folder) || empty($folder)) {
            $viewName=$this->argument('name');
            $folder=$this->argument('folder');
            $file = "${viewName}.php";
            $path=app_path();
            $file=$path."/Services/$file";
            $composerDir=$path."/Services";
            $nameSpace = "";
        }else{
            $viewName=$this->argument('folder');
            $folder=$this->argument('name');
            $file = "${viewName}.php";
            $path=app_path();
            $file=$path."/Services/$folder/$file";
            $composerDir=$path."/Services/$folder";
            $nameSpace = trim(htmlspecialchars('\ ')).$folder;
        }

        if ($viewName === '' || is_null($viewName) || empty($viewName)) {
            return $this->error('Name Invalid..!');
        }

        $contents='<?php
namespace App\Services'.$nameSpace.';
                    
class '.$viewName.'
{
        
    public function handle($data)
    {
        //Bind data to view
    }
    
}';

        if($this->files->isDirectory($composerDir)){
            if($this->files->isFile($file))
                return $this->error($viewName.' File Already exists!');
            
            if(!$this->files->put($file, $contents))
                return $this->error('Something went wrong!');
            $this->info("$viewName generated!");
        }
        else{
            $this->files->makeDirectory($composerDir, 0777, true, true);

            if(!$this->files->put($file, $contents))
                return $this->error('Something went wrong!');
            $this->info("$viewName generated!");
        }

    }
}
