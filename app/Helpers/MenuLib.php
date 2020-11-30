<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Roles;
use Spatie\Permission\Models\Role;
use App\Models\Permissions;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use DB;

class MenuLib
{

    public static function getRole($role)
    {
        $get_role = Roles::where('name', $role)->first();
        $role_id = $get_role->id;

        $permission_id = DB::table('role_has_permissions')
                        ->where('role_id', $role_id)
                        ->select('permission_id')
                        ->get();

        foreach ($permission_id as $value) {
            $get_id = $value->permission_id;
            $id = Permissions::where('id', $get_id)->first();
            $menu_id[] = $id->menu_id;
        }


        $user_menu = array_unique($menu_id);
        // $prefix = str_replace('/','',\Request::route()->getPrefix());
        $menus = Menu::find($user_menu);

        foreach($menus as $data_menu)
        {

            $menu_name = $data_menu->name;
            $menu_uri = '/dapur'.$data_menu->uri;
            $menu_icon = $data_menu->icon;
            $menuID = Str::after($data_menu->uri, '/');

            if ($data_menu->type === 'parent') {
                $id_parent = $data_menu->id;
                $html_out = '<p style="font-size: 13px; color: #596275; margin-top: 15px; margin-left: 25px;">-----------'.$menu_name.'-----------</p>';
                echo $html_out;
            }else {
                if ($data_menu->parent_id == $id_parent) {
                    $html_out = '<li class="nav-item">
                            <a class="nav-link" href="'.$menu_uri.'" id="'.$menuID.'">
                                <img src="/menus_icon/'.$menu_icon.'" width="15" style="margin-right: 20px;">
                                <span class="nav-link-text">'.$menu_name.'</span>
                            </a>
                        </li> ' ;

                    echo $html_out;
                }
            }
        }

    }
}
