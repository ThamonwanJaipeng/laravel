<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\RedirectResponse;               //นำเข้า RedirectResponse class จาก Laravel เพื่อใช้จัดการการตอบกลับแบบ redirect (การเปลี่ยนเส้นทาง)
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;               //นำเข้า Gate facade จาก Laravel ซึ่งใช้ในการจัดการการตรวจสอบสิทธิ์ (authorization) ในแอปพลิเคชัน
use Inertia\Inertia;                               //ช่วยในการเรียกใช้  Method ของ Inertia
use Inertia\Response;                              //ใช้กำหนดประเภทข้อมูลที่ส่งกลับ response สำหรับ Inertia 

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Chirps/Index', [    // โค้ดนี้ใช้ Inertia.js ใน Laravel เพื่อส่งกลับหน้าเว็บ Chirps/Index // Inertia::render() ใช้ render หน้าเว็บ Vue.js หรือ React ให้สอดคล้องกับชื่อ Chirps/Index. // Array ใช้ส่งข้อมูลเพิ่มเติมไปยังหน้าเว็บนั้น 
            
            'chirps' => Chirp::with('user:id,name')->latest()->get(),     //คือการโหลดความสัมพันธ์ของ user พร้อมกับการดึงข้อมูล โดยระบุเฉพาะ id และ name ของ user ที่สัมพันธ์.
                                                                          //latest() ใช้เพื่อเรียกข้อมูล chirps ที่มีการอัปเดตล่าสุดก่อน.
                                                                          //get() คือการเรียกข้อมูลทั้งหมดตามเงื่อนไขที่ระบุ.
                                                                          //โดยรวมแล้ว, คำสั่งนี้จะดึงรายการ chirps ที่มีข้อมูลเกี่ยวกับ user ที่มี id และ name ล่าสุด.                                               
        ]);                                                                  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)

    public function store(Request $request): RedirectResponse  //เป็นการประกาศ method ที่รับ Request จากผู้ใช้และคืนค่าด้วย RedirectResponse
    {
        $validated = $request->validate([                   //ทำการตรวจสอบและยืนยันข้อมูลที่ผู้ใช้ส่งมาตามกฎที่กำหนด และถูกต้องหรือไม่
            'message' => 'required|string|max:255',        // ต้องมีข้อความ, เป็นข้อความสตริง, และมีความยาวไม่เกิน 255 ตัวอักษร
        ]);
 
        $request->user()->chirps()->create($validated);     //สร้างข้อมูลใหม่ในตาราง chirps ที่สัมพันธ์กับผู้ใช้ user โดยใช้ข้อมูลที่ได้รับการยืนยันแล้ว
 
        return redirect(route('chirps.index'));             //เปลี่ยนเส้นทางผู้ใช้ไปยังหน้า chirps.index หลังจากดำเนินการเสร็จ
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    public function update(Request $request, Chirp $chirp): RedirectResponse     //เป็นการประกาศ method update ใน Controller สำหรับจัดการการอัปเดตข้อมูล
    {
        Gate::authorize('update', $chirp);                             //เพื่อตรวจสอบว่าผู้ใช้มีสิทธิ์ในการอัปเดต Chirp นี้หรือไม่
 
        $validated = $request->validate([                             //เพื่อตรวจสอบข้อมูลจากผู้ใช้ให้เป็นไปตามกฎที่กำหนด 
            'message' => 'required|string|max:255',
        ]);
 
        $chirp->update($validated);                                  //อัปเดตข้อมูลของ Chirp ด้วยข้อมูลที่ผ่านการตรวจสอบแล้ว
 
        return redirect(route('chirps.index'));                      //เปลี่ยนเส้นทางไปยังหน้า chirps.index หลังจากการอัปเดตเสร็จสิ้น
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        //
    }
}
