<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\User\FetchLessonService;
use App\Services\User\FetchQuestionsService;

class QuestionController extends Controller
{
    public function index(Request $request, FetchQuestionsService $fetchQuestionsService)
    {
        $params = $request->all();
        $data = $fetchQuestionsService->findList($params);

        return view('question', $data);
    }
}
