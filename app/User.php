<?php

namespace App;

use App\Models\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'login', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles ()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    /**
     * Проверка пользователей на привилегии
     *
     * @param $permission array || string
     * @param $require bool
     * @return bool
     */
    public function canDo ($permission, $require = false)
    {
        if (is_array($permission)) {
            foreach($permission as $permName) {

                $permName = $this->canDo($permName);
                if($permName && !$require) {
                    return TRUE;
                }
                else if(!$permName  && $require) {
                    return FALSE;
                }
            }

            return  $require;
        } else {
            foreach ($this->roles as $role) {
                foreach ($role->perms as $perm) {
                    if (Str::is(trim($permission), trim($perm->name))) {
                        return true;
                    }
                }
            }
        }
    }
}
