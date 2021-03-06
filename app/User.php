<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
    * @param string|array $roles
    */
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) || 
                abort(401, 'Request is invalid.');
        }
        return $this->hasRole($roles) || 
            abort(401, 'Request is invalid.');
    }
    /**
    * Check multiple roles
    * @param array $roles
    */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }
    /**
    * Check one role
    * @param string $role
    */
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

    public static function get_total_post($user_id){
        $result = DB::table('posts')
            ->where('user_id', $user_id)
            ->count();

        return $result;
    }
    
    public static function get_like_received($user_id){
        $result = DB::table('post_like')
            ->join('posts', function ($join) {
                $join->on('posts.id', '=', 'post_like.post_id');
            })
            ->where('posts.user_id', $user_id)
            ->count();

        return $result;
    }

    public function carousels(){
        return $this->hasMany('App\Carousel');
    }

    public function games(){
        return $this->hasMany('App\Game');
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }
}
