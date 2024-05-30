<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function index()
    {
        $teachers = (new Teacher)->orderBy('id', 'asc')->paginate(10);
        return view('administrator.index', compact('teachers'));
    }


    public function create()
    {
        return view('administrator.create');
    }


    public function store(Request $request)
    {
        $input = $request->all();

        $input['password'] = bcrypt($input['password']);
        Teacher::create($input);
        return redirect()->route('administrator.teacher')->with('flash_message', 'Teacher Addedd!');
    }

    public function show($id)
    {
        $teacher = Teacher::find($id);
        return view('teacher.show')->with('teachers', $teacher);
    }

    public function edit($id)
    {
        $teacher = Teacher::find($id);
        return view('administrator.edit')->with('teachers', $teacher);
    }

    public function update(Request $request, $id)
    {
        
        $teacher = Teacher::find($id);
        $input = $request->all();
        $input['password'] = bcrypt(($input['password']));
        $teacher->update($input);
        return redirect('administrator/teacher-list')->with('flash_message', 'teacher Updated!');
    }

    public function destroy($id)
    {
        Teacher::destroy($id);
        return redirect('administrator/teacher-list')->with('flash_message', 'Teacher deleted!');
    }



    public function view_tags()
    {
        $tags = Tag::orderBy('id', 'asc')->get();
        $tags_list = [];
        foreach($tags as $tag) {
            $tags_list [] = [
                'id' => $tag['id'],
                'name' => $tag['name'],
                'class_id' => ($tag['class_id'])
            ];
        }
        dd($tags_list);
        return view('administrator.tags', compact('tags_list'));
    }


    public function create_tag(Request $request)
    {  
        $tag = (new Tag)->create(
            [
                "name" => $request->tag_name,
                "class_id"=>$request->class_id,
            ]
        );
        if ($tag) {
            return response()->json(['success' => true, 'message' => 'Tag created successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to create tag']);
        }
    }

    public function update_tag(Request $request)
    {
        $tag = Tag::find($request->id)->update([
            'name' => $request->tag_name,
            'class_id'=>$request->class_id,
        ]);
        if (!$tag) {
            return response()->json(['success' => false, 'message' => 'Tag not found']);
        }
        return response()->json(['success' => true, 'message' => 'Tag updated successfully']);
    }

    public function delete_tag(Request $request)
    {
        $tag = Tag::find($request->id)->delete();
        if (!$tag) {
            return response()->json(['success' => false, 'message' => 'Tag not found']);
        }
        return response()->json(['success' => true, 'message' => 'Tag deleted successfully']);
    }
}
