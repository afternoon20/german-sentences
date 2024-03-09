<?php

namespace App\Http\Controllers;

use App\Services\User\FetchQuestionsService;
use Illuminate\Http\Request;

class TopController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request, FetchQuestionsService $fetchQuestionsService)
    {
        $params = $request->all();
        $this->_viewData['params'] = $params;
        $this->_viewData += $fetchQuestionsService->findList($params);

        return view('top', $this->_viewData);
    }
}
