<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users ()
    {
        return $this->belongsToMany(User::class, 'user_role');
    }

    public function perms ()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }

    /**
     * Проверка ролей на привилегии
     *
     * @param $name array || string
     * @param $require bool
     * @return bool
     */
    public function hasPermission($name, $require = false)
    {
        if (is_array($name)) {
            foreach ($name as $permissionName) {
                $hasPermission = $this->hasPermission($permissionName);

                if ($hasPermission && !$require) {
                    return true;
                } elseif (!$hasPermission && $require) {
                    return false;
                }
            }
            return $require;
        } else {
            foreach ($this->perms as $permission) {
                if ($permission->name == $name) {
                    return true;
                }
            }
        }

        return false;
    }

    public function savePermission ($inputPermission)
    {
        if (!empty($inputPermission)) {
            $this->perms()->sync($inputPermission);
        } else {
            $this->perms()->detach();
        }

        return true;
    }
}
