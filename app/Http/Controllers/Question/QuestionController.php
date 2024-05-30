<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    function index()
    {
        $questions = (new Question)->where('teacher_id', auth('teacher')->user()->id)->orderBy('id', 'desc')->paginate(10);
        foreach ($questions as $question) {
            $question->question_name = html_entity_decode($question->question_name);
        }
        return view('teacher.question.list', compact('questions'));
    }

    function create(Request $request)
    {
        return view('teacher.question.create');
    }

    function edit($id = null)
    {
        $question = (new Question)::find($id);

        $question->question_name = html_entity_decode($question->question_name);

        $results = ($question->results);
        return view('teacher.question.update', compact('question', 'results'), [
            'results' => $results,
        ]);
    }

    function storeCreate(Request $request)
    {
        $teacher = (new Teacher)->find(auth('teacher')->user()->id);
        $results = json_encode($request->results);
        $question = $teacher->questions()->create([
            'question_name' => $request->quest_name,
            'results' => $results,

        ]);

        return redirect()->route('teacher.question.list');
    }


    function update($id = null, Request $request)
    {
        $results = json_encode($request->results);
        $teacher = (new Teacher)->find(auth('teacher')->user()->id);
        $question = $teacher->questions()->where('id', $id)->update([

            'results' => $results,
            'question_name' => $request->question_name,
        ]);
        return redirect()->route('teacher.question.list');
    }


    public function delete($id)
    {
        $deleted = (new Question)::find($id)->delete();

        if ($deleted) {
            return response()->json([
                'success' => true,
                'message' => 'Question deleted successfully.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete question.'
            ]);
        }
    }
}
