<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\User\FetchListService;

class ListController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request, FetchListService $fetchListService)
    {
        
        $params = $request->all();
        $params = $request->all();
        $this->_viewData['params'] = $params;
        $this->_viewData += $fetchListService->findList($params);

        return view('list', $this->_viewData);
    }
}
