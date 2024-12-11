<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;         //นำเข้า HasMany จาก Laravel Eloquent เพื่อสร้างความสัมพันธ์ระหว่างโมเดล HasMany แปลว่าตารางหนึ่งสามารถเชื่อมโยงไปยังอีกตารางหนึ่งได้หลายรายการ
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
        'email',
        'password',
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
    public function chirps(): HasMany           //กำหนดฟังก์ชัน chirps คืนค่าความสัมพันธ์ HasMany ที่บ่งบอกถึงโมเดลนี้
    {
        return $this->hasMany(Chirp::class);
    }
}

