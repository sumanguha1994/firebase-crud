<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class Table extends Controller
{
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
            $factory = (new Factory)->withServiceAccount(__DIR__.'/krc-update-firebase-adminsdk-dhal2-2a79a16e75.json');
            $database = $factory->createDatabase();
            $createtbl = $database->getReference($tblname)
                                    ->push($request->all());
            return redirect()->to('/');
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

    public function destroy($id)
    {
        //
    }
}
