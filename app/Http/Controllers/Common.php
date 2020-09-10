<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class Common extends Controller
{
    public $factory;
    public function __construct()
    {
        $jsonfile = public_path('connection/'.\Session::get('appname'));
        $this->factory = (new Factory)->withServiceAccount($jsonfile.'.json');
    }

    public function index()
    {
        $database = $this->factory->createDatabase();
        $tables   =   $database->getReference()->getSnapshot()->getValue();
        $data['tables'] = array_keys($tables);
        $data['columns'] = $data['values'] = $data['onlykeys'] = array();
        $data['tblval'] = '';
        return \View::make('index', $data);
    }

    public function create(Request $request)
    {
        if(!empty($request->tblname)){
            $database = $this->factory->createDatabase();
            $tables   =   $database->getReference()->getSnapshot()->getValue();
            $keyvalues   =   $database->getReference($request->tblname)->getSnapshot()->getValue();
            //->orderByKey()->limitToFirst(3)   for using limit first must be using orderBy() method 
            if(count($keyvalues) > 0){
                ini_set('max_execution_time', 300);
                set_time_limit(0);
                $data = array();
                $data['onlykeys'] = array_keys($keyvalues);
                foreach($keyvalues as $key => $kv)
                {
                    $data['columns'] = array_keys($kv);
                }
                $i = 0;
                foreach($keyvalues as $key => $value)
                {
                    $data['values'][$i] = $value;
                    $i++;
                }
                $data['tables'] = array_keys($tables);
                $data['tblval'] = $request->tblname;
                return \View::make('index', $data);
            }else{
                return redirect()->to('/dashboard');
            }
        }else{
            return redirect()->to('/dashboard');
        }
    }

    public function store(Request $request)
    {
        $tblname = $request->tblname;
        $request->request->remove('_token');
        $request->request->remove('tblname');
        $database = $this->factory->createDatabase();
        $createPost    =   $database->getReference($tblname)
                                ->push($request->all());
        return redirect()->to('/dashboard');
    }

    public function show($tblname)
    {
        $database = $this->factory->createDatabase();
        $tables   =   $database->getReference()->getSnapshot()->getValue();
        $keyvalues   =   $database->getReference($tblname)->getSnapshot()->getValue();
        foreach($keyvalues as $key => $kv)
        {
            $columns = array_keys($kv);
        }
        return response()->json($columns);
    }

    public function edit(Request $request)
    {
        $database = $this->factory->createDatabase();
        $tblname = $request->tblname.'/'.$request->editid;
        $keyvalues   =   $database->getReference($tblname)->getSnapshot()->getValue();
        foreach($keyvalues as $key => $kv)
        {
            $data['columns'] = array_keys($keyvalues);
            $data['values'] = array_values($keyvalues);
        }
        $data['keyid'] = $request->editid;
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $tblname = $request->tblname;
        $updateid = $request->updateid;
        $request->request->remove('_token');
        $request->request->remove('updateid');
        $request->request->remove('tblname');
        $database = $this->factory->createDatabase();
        $tblname = $tblname.'/'.$updateid;
        $update = $database->getReference($tblname)
                            ->update($request->all());
        return redirect()->to('/dashboard');
    }

    public function destroy(Request $request)
    {
        $database = $this->factory->createDatabase();
        $tblname = $request->tblname.'/'.$request->delid;
        $database->getReference($tblname)->remove();
        return response()->json(true);
    }
}
