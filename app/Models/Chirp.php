<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;          // นำเข้า HasFactory trait จาก laravel ซึ่งใช้สำหรับสร้างฟาเรียต 

class Chirp extends Model
{
    //
    protected $fillable = [          // คือการตั้งค่าคุณสมบัติ fillable ซึ่งเป็น array ของฟิลด์ที่สามารถถูกตั้งค่าโดยผู้ใช้ได้ระหว่างการสร้างหรืออัปเดตข้อมูลในโมเดลนี้
                                    //  ในตัวอย่างนี้ โมเดลสามารถรับค่าของฟิลด์ 'message' เท่านั้น
        'message',
    ];

    public function user(): BelongsTo           //คือการสร้างฟังก์ชัน user ที่บอกว่าโมเดลนี้ มีความสัมพันธ์กับโมเดล User     //เป็นความสัมพันธ์แบบ หนึ่งต่อหนึ่ง ที่ระบุว่าแต่ละ Chirp จะมี User ที่เป็นเจ้าของ
    {
        return $this->belongsTo(User::class);   //User::class หมายถึงคลาส User ที่โมเดล Chirp มีความสัมพันธ์ด้วย
                                                //โดยรวมแล้ว, คำสั่งนี้ใช้ในการเชื่อมโยง Chirp กับ User ที่เป็นเจ้าของ
    }
}
