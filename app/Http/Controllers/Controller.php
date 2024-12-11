<?php



use Illuminate\Http\Response;         //เป็นการนำเข้า Response class จาก laravel
                                     //ใช้สร้างหรือจัดการการตอบกลับ HTTP ในแอปพลิเคชั่น 
 
class ChirpController extends Controller
{
    public function index()
    public function index(): Response     //เป็นการประกาศ method ที่ชื่อ index 
    {                                     //public จะกำหนดว่าจะคืนค่าผลลัพธ์เป็น Response (HTTP response) เสมอ
                                          //โดยใช้ Laravel สำหรับจัดการคำร้องขอ HTTP
        
        return response('Hello, World!');   //เป็นการส่งกลับ HTTP ที่มีข้อความความ Hello ,World! ไปยังผู้ใช้ 
    }                                       //โดยมีฟังก์ชันช่วย  response ของ Laravel เพื่อสร้างการตอบกลับ
}

namespace App\Http\Controllers;

abstract class Controller


{
    //
}
