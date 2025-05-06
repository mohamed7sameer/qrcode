<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        // 'password',
        'avatar',
        'age'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn (string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }


    public function qrcodes()
    {
        // return $this->hasMany('qrcodes_users','user_id','id');

        // return $this->hasMany('qrcodes_users','user_id','id');
        return $this->belongsToMany(Qrcode::class,'qrcodes_users','user_id','qrcode_id');
    }


    public function getAvatarUrlAttribute()
    {

        
        
        $avatar = $this->attributes['avatar'] ?? null; // الوصول مباشرة إلى البيانات المخزنة
        if ($avatar && Str::startsWith($avatar, 'http')) {
            dd($this->attributes['avatar']);
            return $avatar;
        }


       
        if($avatar)
        {
            return asset("storage/{$avatar}");
        }else{
            return 'https://ui-avatars.com/api/?name='.urlencode($this->name).'&color=7F9CF5&background=EBF4FF';
        
        }
    }

    
}
