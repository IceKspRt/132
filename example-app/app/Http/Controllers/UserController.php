<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Carbon;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    //
    public function index()
    {
        $user = Users::all();
        return view('users.index', compact('user'));
    }


    public function store(Request $request)
    {
        $user = new Users;
        $user->user_fname = $request->input('fname');
        $user->user_lname = $request->input('lname');
        $user->user_role = $request->input('role');
        $user->user_email = $request->input('email');
        $user->user_password = $request->input('password');
        $user->user_major = $request->input('major');

        // บันทึกผู้ใช้งานก่อน
        $user->save();

        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $extension = $file->getClientOriginalExtension();
            $filename = $user->user_id . '.' . $extension;

            // สร้างไดเรกทอรีด้วย ID ของผู้ใช้
            $directory = 'uploads/users/' . $user->user_id;

            // ถ้าไดเรกทอรียังไม่มี
            if (!file_exists($directory)) {
                // สร้างไดเรกทอรี
                mkdir($directory, 0777, true);
            }

            // บันทึกรูปในไดเรกทอรี
            $file->move($directory, $filename);

            // อัพเดทชื่อไฟล์ในฐานข้อมูลหลังจากที่ไฟล์ถูกบันทึก
            $user->user_img = $filename;
            $user->save();
        }

        // return redirect()->back()->with('status', 'user Image Added Succesfully');
        return redirect('http://localhost:8000/users');
    }

    public function changeStatus(Request $request) {
        $user = Users::find($request->user_id);

        // ตรวจสอบว่าพบผู้ใช้หรือไม่ก่อนที่จะดำเนินการ
        if($user) {
            // อัปเดตสถานะของผู้ใช้
            $user->user_permission = $request->user_permission;
            $user->save();

            return response()->json(['success' => 'Status changed successfully']);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function destroy($user_id)
    {
        $user = Users::find($user_id);
        $destination = 'uploads/users/' . $user->user_id . '/' . $user->user_id;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $user->delete();
        return redirect()->back()->with('status', 'Image Deleted Successfully');
    }
}
