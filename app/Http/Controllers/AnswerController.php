<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param Question $question
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Question $question, Request $request)
    {

        $question->answers()->create($request->validate([
            'body' => 'required'
        ]) +  ['user_id' => Auth::id()]);

        return back()->with('success', 'Your answer has been submitted successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Answer $answer
     * @return Application|Factory|View
     */
    public function edit(Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);

        return view('answers._edit', compact('question', 'answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Answer $answer
     * @return JsonResponse
     */
    public function update(Request $request, Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);

        $answer->update($request->validate([
            'body' => 'required'
        ]));

        if($request->expectsJson()) {
            return response()->json([
                'message' => 'Your answer has been updated!',
                'bodyHtml' => $answer->bodyHtml
            ]);
        }

//        return redirect()->route('questions.show', $question->slug)->with('success', 'Your answer has been updated!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Answer $answer
     * @return RedirectResponse
     */
    public function destroy(Question $question, Answer $answer)
    {
        $this->authorize('delete', $answer);

        $answer->delete();

        if(request()->expectsJson()) {
            return response()->json([
                'message' => 'Your answer has been deleted!'
            ]);
        }

        return back()->with('success', 'Your answer has been deleted!');
    }
}
