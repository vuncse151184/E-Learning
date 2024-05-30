<?php


namespace App\Http\Controllers\Lesson;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\Subject;
use App\Models\ClassName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    function index()
    {
    
        $lessons = DB::table('lessons')
            ->select('lessons.*', 'subjects.subject_name as subject_name', 'classes.class_name as class_name')
            ->where('teacher_id', auth('teacher')->user()->id)
            ->orderBy('lessons.id', 'desc')
            ->leftjoin('subjects', 'lessons.subject_id', '=', 'subjects.id')
            ->leftjoin('classes', 'subjects.class_id', '=', 'classes.id')
            ->paginate(10);
       
        return view('teacher.lesson.list', compact('lessons'));
    }

    function create()
    {

        $tags = DB::table('tags')->get();
        $questions = (new Question)->where('teacher_id', auth('teacher')->user()->id)->orderBy('id', 'asc')->get();
        foreach ($questions as $question) {
            $question->question_name = html_entity_decode($question->question_name);
        }
        $subjects = DB::table('subjects')
            ->join('classes', 'subjects.class_id', '=', 'classes.id')
            ->select('subjects.*', 'classes.class_name')
            ->get();
        return view('teacher.lesson.create', compact('questions', 'subjects', 'tags'));
    }


    function edit($id)
    {
       
        $lesson = (new Lesson)::find($id);
        $qids = (json_decode($lesson->question_list));
        $category_id = explode("-", $lesson->category_id);
        $lesson_content = $lesson->content;
        $tags = DB::table('tags')->get();
        $questlist = [];
        $questions = [];
        if ($qids != null) {
            $questlist = (new Question)->whereIn('id', $qids)->orderBy('id', 'asc')->get();
        }
        $subjects = DB::table('subjects')
            ->join('classes', 'subjects.class_id', '=', 'classes.id')
            ->select('subjects.*', 'classes.class_name')
            ->get();
        $questions = (new Question)->where("teacher_id", auth('teacher')->user()->id)->orderBy('id', "asc")->get();
        foreach ($questions as $question) {
            $question->question_name = html_entity_decode($question->question_name);
        }
        return view('teacher.lesson.update', compact('lesson', 'lesson_content', 'questlist', 'questions', 'subjects', 'tags'));
    }

    function viewlesson($id)
    {
        $lesson = (new Lesson)::find($id);
        $url = $lesson->video;
        $u = explode('"', $url);
        $src = $u[1];
        return view('teacher.lesson.view', compact('src'));
    }
    function store(Request $request)
    {
        $questions = json_encode($request->questions);

        $lesson = (new Lesson)->create(
            [
                "teacher_id" => auth('teacher')->user()->id,
                "video" => $request->video,
                'lesson_name' => $request->lesson_name,
                "subject_id" => $request->subject_id,
                "question_list" => $questions,
                "lesson_url" => $request->lesson_url,
                "content" => $request->content,
                "tag_list" => $request->tag_list,
            ]
        );
    }

    function update($id, Request $request)
    {
        $questions = json_encode($request->questions);
        $lesson = (new Lesson)->find($id)->update(
            [
                "teacher_id" => auth('teacher')->user()->id,
                'lesson_name' => $request->lesson_name,
                "video" => $request->video,
                "question_list" => $questions,
                "subject_id" => $request->subject_id,
                "lesson_url" => $request->lesson_url,
                "content" => $request->content,
                "tag_list"=>$request->tag_list,
            ]
        );
    }

    function delete($id)
    {
        $lesson = Lesson::find($id)->delete();
    }

    function updatePublic(Request $request)
    {
        if ($request->public == 0) {
            $lesson = (new Lesson)::find($request->id)->update(['is_public' => "1"]);
        } elseif ($request->public == 1) {
            $lesson = (new Lesson)::find($request->id)->update(['is_public' => "0"]);
        }
    }
}
