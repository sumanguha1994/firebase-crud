<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class Table extends Controller
{
    public $factory;
    public function __construct()
    {
        $jsonfile = public_path('connection/'.\Session::get('appname'));
        $this->factory = (new Factory)->withServiceAccount($jsonfile.'.json');
    }

    public function index()
    {
        return \View::make('table');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $tblname = $request->tablename;
        if(!empty($tblname)){
            $values = array();
            $request->request->remove('_token');
            $request->request->remove('tablename');
            $database = $this->factory->createDatabase();
            $createtbl = $database->getReference($tblname)
                                    ->push($request->all());
            return redirect()->to('/dashboard');
        }else{
            return redirect()->back();
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy()
    {
        \Session::forget('appname');
        \Session::flush();
        return redirect()->to('init');
    }
}
