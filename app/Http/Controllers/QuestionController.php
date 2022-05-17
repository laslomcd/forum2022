<?php

namespace App\Http\Controllers;

use App\Http\Requests\AskQuestionRequest;
use App\Models\Question;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

//use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
//        DB::enableQueryLog();
        $questions = Question::with('user')->latest()->paginate(10);
        return view('questions.index', compact('questions'));
//        view('questions.index', compact('questions'))->render();
//        dd(DB::getQueryLog());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AskQuestionRequest $request
     * @return RedirectResponse
     */
    public function store(AskQuestionRequest $request): RedirectResponse
    {
        $request->user()->questions()->create($request->all());
        return redirect()->route('questions.index')->with('success', 'Your question has been submitted!');
    }

    /**
     * Display the specified resource.
     *
     * @param Question $question
     * @return Application|Factory|View
     */
    public function show(Question $question): View|Factory|Application
    {
        $question->increment('views');
        return view('questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Question $question
     * @return Application|Factory|View
     */
    public function edit(Question $question): View|Factory|Application
    {
        return view('questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AskQuestionRequest $request
     * @param Question $question
     * @return RedirectResponse
     */
    public function update(AskQuestionRequest $request, Question $question): RedirectResponse
    {
        $question->update($request->only('title', 'body'));
        return redirect()->route('questions.index')->with('success', 'Your question has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Question $question
     * @return RedirectResponse
     */
    public function destroy(Question $question): RedirectResponse
    {
        $question->delete();
        return redirect()->route('questions.index')->with('success', 'Your question has been successfully deleted!');
    }
}
