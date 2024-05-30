<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{

    public function index()
    {
        return view('teacher.profile');
    }

    public function create()
    {
        return view('teacher.create');
    }

    public function view()
    {
        return view('teacher.lesson.view');
    }

    public function store(Request $request)
    {
        dd($request->all);
        // $inputLesson = $request->only('title','description');
        // $inputSub=$request->only('name','sub_des');
        // $lesson = Lesson::create($inputLesson);
        // $subject = $lesson->subject()->create($inputSub);
        // return redirect()->route('lesson.list')->with('flash_message', 'Teacher Addedd!');
    }

    public function changePassword()
    {
        return view('teacher.change_password');
    }

    public function update(Request $request){
        
        $teacher= (new Teacher)->find(auth('teacher')->user()->id)->update([
            'email'=>$request->email,
            'birthday'=>$request->birthday,
            'phone'=>$request->phone,
            'gender'=>$request->gender,
        ]);

    }

    public function change(Request $request){
        $id= auth('teacher')->user()->id;
        $teacher = (new Teacher)::find($id);
        $pass = (($request->password));
        if(Hash::check($pass,$teacher->password)){
            $newpass= bcrypt($request->newpass);
            $teacher->update(['password'=>$newpass]);
        }
        return view('teacher.change_password');
    }
    public function edit($id)
    {
       
        $teacher = Teacher::find($id);
        return view('teacher.edit')->with('teachers', $teacher);
    }

    public function lessons_list(){
        return view('teacher.lesson.list');
    }

    public function uploadimg(Request $request){
        
        $target_dir= public_path('storage/');
        $target_file = $target_dir . basename($_FILES["img_upload"]["name"]);
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        $newFile = ('storage/'.(md5(now()).'.'.$imageFileType));
        $check=move_uploaded_file($_FILES["img_upload"]["tmp_name"], $newFile);
       
        $teacher = (new Teacher)->find( auth('teacher')->user()->id)->update(['image' => $newFile]);;
        
    }
}
