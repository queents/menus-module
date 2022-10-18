<?php

namespace Modules\Menu\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Modules\Base\Services\Core\VILT;
use Illuminate\Support\Facades\Artisan;

class InstallMenu extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'menu:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install menu permissions to main admin role';

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
     * @return mixed
     */
    public function handle()
    {
        $this->info('Install Permissions');
        Artisan::call('roles:generate menus');
        $this->info('Your Menu is ready now');
        $menus = VILT::loadMenu();
        $menuPath = base_path('menu.json');
        $check = File::exists($menuPath);
        if (!$check) {
            File::put($menuPath, json_encode($menus));
        }

        return Command::SUCCESS;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }
}