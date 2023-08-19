<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Options;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
    public function index(): Response
    {
        $options = Options::find(1);
        $answers = Answer::all();
        return Inertia::render('Admin', compact('answers', 'options'));
    }


    public function createAnswer(Request $request): JsonResponse
    {
        $request->validate([
            'title' => ['string', 'max:100', 'min:1'],
            'answer' => ['string', 'max:500', 'min:1'],
        ]);

        $answer = new Answer();
        $answer->title = $request->title;
        $answer->answer = $request->answer;
        $answer->save();

        return response()->json($answer);
    }

    public function deleteAnswer(Request $request): JsonResponse
    {
        $answer = Answer::find($request->id);
        $answer->delete();

        return response()->json($answer);
    }

    public function updateAnswer(Request $request): JsonResponse
    {
        $request->validate([
            'title' => ['string', 'max:100', 'min:1'],
            'answer' => ['string', 'max:500', 'min:1'],
        ]);

        $answer = Answer::find($request->id);
        $answer->title = ($request->title == null) ? $answer->title : $request->title;
        $answer->answer = ($request->answer == null) ? $answer->answer : $request->answer;
        $answer->save();

        return response()->json($answer);
    }

    public function updateDesign(Request $request): JsonResponse
    {
        $padding = Options::find(1);
        $padding->padding_top = ($request->paddingTop == null) ? $padding->padding_top : $request->paddingTop;
        $padding->padding_bottom = ($request->paddingBottom == null) ? $padding->padding_bottom : $request->paddingBottom;
        $padding->save();

        return response()->json($padding);
    }
}
