<?php


namespace Modules\Menu\Pages;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Modules\Base\Services\Core\VILT;
use Modules\Base\Services\Resource\Page;
use Modules\Base\Services\Components\Base\Render;
use Modules\Base\Services\Components\Base\Component;

class MenusPage extends Page
{
    public ?string $path = "menus";
    public ?string $group = "Settings";
    public ?string $icon = "bx bx-menu";

    public function index()
    {
        $menus = VILT::loadMenu();
        $menuPath = base_path('menu.json');
        $check = File::exists($menuPath);
        if (!$check) {
            File::put($menuPath, json_encode($menus));
        }

        $menuFile = json_decode(File::get($menuPath));
        return Render::make('Menus')->module('Menu')->data([
            "menu" => $menuFile,
            "title" => __('Menus'),
            "back" => __('Back'),
        ])->render();
    }

    public function move(Request $request)
    {
        $menu = $request->get('menu');
        $name = $request->get('name');
        $menuPath = base_path('menu.json');
        $getMenu  = json_decode(File::get($menuPath));
        foreach ($getMenu as $key => $item) {
            if ($key === $name) {
                $getMenu->{$name} = $menu;
            }
        }
        File::delete($menuPath);
        File::put($menuPath, json_encode($getMenu));

        return response()->json([
            "status" => "success",
            "message" => "Menu has been updated"
        ]);
    }
}