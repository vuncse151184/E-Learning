<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Result;
use App\Models\Question;
use App\Models\Tag;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $tags = Tag::get();

        $condition = $request->lesson_search;
        $condition == null ? "" : $condition;
        $lessons = DB::table('lessons')
            ->select('lessons.*', 'teachers.name as teacher_name', 'classes.id as class_id', 'subjects.subject_name', 'classes.class_name as class_name')
            ->where('lessons.is_public', '=', 1)
            ->orderBy('lessons.id', 'desc')
            ->join('teachers', 'lessons.teacher_id', '=', 'teachers.id')
            ->join('subjects', 'lessons.subject_id', '=', 'subjects.id')
            ->join('classes', 'subjects.class_id', '=', 'classes.id')
            ->get();
        foreach ($lessons as $lesson) {
            $lesson->tag_list = json_decode($lesson->tag_list, true);
        }
        // dd('test');
        return view('user.index', compact('lessons', 'tags'));
    }

    public function view($id)
    {
        $lesson = Lesson::find($id);
        $lesson_id = $id;
        $url = $lesson->video;
        $u = explode('"', $url);
        $src = $u[1];
        $ids = json_decode($lesson->question_list);
        $questions = [];
        if ($ids != null) {
            $questions = (new Question)::whereIn('id', $ids)->orderBy('id', 'asc')->get();
        }


        return view('user.viewlesson', compact('src', 'questions', 'lesson_id'));
    }

    public function store(Request $request)
    {
        $mark = ($request->result) / 100;

        if (Auth::guard('user')->user() != null) {
            $result = (new Result)->create([
                "user_id" => Auth::guard('user')->user()->id,
                "lesson_id" => $request->lesson_id,
                "mark" => $mark,
            ]);
        }
        return response()->json([

            'status' => 'OK',
        ]);
    }

    public function viewByGrade($i)
    {
        $tags = Tag::get();
        $lessons = DB::table('lessons')
            ->select('lessons.*', 'teachers.name as teacher_name', 'classes.id as class_id', 'subjects.subject_name', 'classes.class_name as class_name')
            ->where('lessons.is_public', '=', 1)
            ->orderBy('lessons.id', 'desc')
            ->join('teachers', 'lessons.teacher_id', '=', 'teachers.id')
            ->join('subjects', 'lessons.subject_id', '=', 'subjects.id')
            ->join('classes', 'subjects.class_id', '=', 'classes.id')
            ->get();
        foreach ($lessons as $lesson) {
            $lesson->tag_list = json_decode($lesson->tag_list, true);
            // dd($lesson);
        }
        $subjects = DB::table('subjects')
            ->where('class_id',$i)
            ->get();
        return view('user.grade', compact('i', 'tags','lessons','subjects'));
    }
}
