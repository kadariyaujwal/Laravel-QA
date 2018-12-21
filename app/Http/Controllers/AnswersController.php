<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;
use App\Question;
class AnswersController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
        abort_unless(\Auth::user(),403,"You must login to answer the question");
        $request->validate([
            'body'=>'required'
        ]);
        $question->answers()->create([
            'body'=>$request->body,
            'user_id'=>\Auth::id(),
        ]);

        return back()->withSuccess('Your answer has been submitted successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question, Answer $answer)
    {
        //
        $this->authorize('update',$answer);
        return view('answers.edit')->withQuestion($question)->withAnswer($answer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question, Answer $answer)
    {
        //
        $this->authorize('update',$answer);
        $answer->update($request->validate([
            'body'=>'required'
        ]));
        return redirect()->route('questions.show', $question->slug)->withSuccess('Your answer has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question,Answer $answer)
    {
        //
        $this->authorize('delete',$answer);
        $answer->delete();
        return redirect()->route('questions.show', $question->slug)->withSuccess('Your answer has been deleted successfully!');
    }
}
