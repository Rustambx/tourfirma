<?php

namespace App\Http\Controllers\Admin;

use Composer\Util\AuthHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Support\Facades\Auth;

class IndexController extends AdminController
{

    public function __construct()
    {

        $this->template = 'admin.index';
    }

    public function index ()
    {
        if (Gate::denies('VIEW_ADMIN')) {
            abort(403);
        }

        $this->title = 'Панель администратора';

        return $this->renderOutput();
    }
}
