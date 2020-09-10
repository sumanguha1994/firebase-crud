<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class Setup extends Controller
{
    public function index()
    {
        if(\Session::has('appname')){
            return redirect()->to('dashboard');
        }else{
            return \View::make('setup');
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if(file_exists(public_path('connection/'.$request->projectname.'.json'))){
            \Session::put('appname', $request->projectname);
            return redirect()->to('dashboard');
        }else{
            if($request->hasFile('projectfile')){
                $expiresAt = new \DateTime('tomorrow');
                $firebase_storage_path = 'connectionfiles';
                $destinationPath = public_path('connection/');
                $file = $request->file('projectfile');
                $filename = $request->projectname.'.json';
                $file->move($destinationPath, $filename);
                $fullpath = 'connection/'.$filename;
                $uploadfile = fopen(public_path($fullpath), 'r');
                
                $factory = (new Factory)->withServiceAccount(__DIR__.'/fir-1543c-firebase-adminsdk-f4wgk-0b4954aa5e.json');
    
                $storage = $factory->createStorage();
                $storage->getBucket()
                            ->upload($uploadfile, ['name' => $firebase_storage_path.'/'.$filename]);
                
                $imageReference = $storage->getBucket()
                            ->object($firebase_storage_path.'/'.$filename);
                if($imageReference->exists()){
                    $image = $imageReference->signedUrl($expiresAt);
                    $database = $factory->createDatabase();
                    $connection = array(
                        'appname' => $request->projectname,
                        'appjson' => $image,
                        'create_at' => date('Y-m-d H:s:i a')
                    );
                    $createPost    =   $database->getReference('connection')
                                            ->push($connection);
                    \Session::put('appname', $request->projectname);
                    return redirect()->to('dashboard');
                }else{
                    return redirect()->back();
                }
            }else{
                return redirect()->back();
            }
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
