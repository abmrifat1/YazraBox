<?php

namespace App\Http\Controllers;

use App\User;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home',compact($this->getUsers()));
    }
    public function getUsers(){
        return DataTables::of(User::query())
            ->setRowId(function ($user) {
                return $user->id;
            })
            ->setRowData([

                'data-name' => 'row-{{$name}}',
            ])
            ->setRowClass(function ($user) {
                return $user->id % 2 == 0 ? 'alert-danger' : 'alert-primary';
            })
            ->setRowAttr([
                'align' => "center",


            ])
            ->addColumn('intro', 'Hi {{$name}}!')

            ->editColumn('updated_at', 'column')
            ->rawColumns(['updated_at'])
            ->toJson();
    }
}
