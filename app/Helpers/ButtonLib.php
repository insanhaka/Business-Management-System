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

class ButtonLib
{

    public static function addButton($role)
    {
        $prefix = str_replace('/','',\Request::route()->getPrefix());

        $uri = url()->current();
        $uri_location = Str::afterLast(url()->current(), '/');
        $button_add_uri = '/'.$prefix.'/'.$uri_location.'/add';
        $button_add_key = '/'.$uri_location.'/create';

        $get_role = Roles::where('name', $role)->first();
        $role_id = $get_role->id;

        $permission_id = DB::table('role_has_permissions')
                        ->where('role_id', $role_id)
                        ->select('permission_id')
                        ->get();

        foreach ($permission_id as $value)
        {
            $get_id = $value->permission_id;
            $data_permission[] =  Permissions::where('id', $get_id)->first();
        }

        foreach ($data_permission as $item)
        {
            $permission_name = Str::after($item->name, ':');

            if ($permission_name === $button_add_key) {
                $html_out = '<a class="btn btn-primary" href="'.$button_add_uri.'" role="button">Add Data</a>' ;

                echo $html_out;
            }
        }

    }

    public static function editButton($role, $data)
    {
        $prefix = str_replace('/','',\Request::route()->getPrefix());

        $data_id = $data->id;

        $uri = url()->current();
        $uri_location = Str::afterLast(url()->current(), '/');

        $button_edit_uri = '/'.$prefix.'/'.$uri_location.'/edit/'.$data_id;
        $button_edit_key = '/'.$uri_location.'/edit';

        $get_role = Roles::where('name', $role)->first();
        $role_id = $get_role->id;

        $permission_id = DB::table('role_has_permissions')
                        ->where('role_id', $role_id)
                        ->select('permission_id')
                        ->get();

        foreach ($permission_id as $value)
        {
            $get_id = $value->permission_id;
            $data_permission[] =  Permissions::where('id', $get_id)->first();
        }

        foreach ($data_permission as $item)
        {
            $permission_name = Str::after($item->name, ':');

            if ($permission_name === $button_edit_key) {
                $html_out = '<a style="margin-right: 20px;" href="'.$button_edit_uri.'"><i class="fa fa-edit text-primary" style="font-size: 21px;"></i></a>' ;

                echo $html_out;
            }
        }

    }

    public static function deleteButton($role, $data)
    {
        $prefix = str_replace('/','',\Request::route()->getPrefix());

        $data_id = $data->id;

        $uri = url()->current();
        $uri_location = Str::afterLast(url()->current(), '/');

        $button_delete_uri = '/'.$prefix.'/'.$uri_location.'/delete/'.$data_id;
        $button_delete_key = '/'.$uri_location.'/delete';

        $get_role = Roles::where('name', $role)->first();
        $role_id = $get_role->id;

        $permission_id = DB::table('role_has_permissions')
                        ->where('role_id', $role_id)
                        ->select('permission_id')
                        ->get();

        foreach ($permission_id as $value)
        {
            $get_id = $value->permission_id;
            $data_permission[] =  Permissions::where('id', $get_id)->first();
        }

        foreach ($data_permission as $item)
        {
            $permission_name = Str::after($item->name, ':');

            if ($permission_name === $button_delete_key) {
                $html_out = '<a style="margin-right: 10px;" href="'.$button_delete_uri.'"><i class="fa fa-trash text-primary" style="font-size: 21px;"></i></a>' ;

                echo $html_out;
            }
        }

    }

}
