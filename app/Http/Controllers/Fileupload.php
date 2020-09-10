<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Storage;

class Fileupload extends Controller
{
    public $factory;
    public function __construct()
    {
        $jsonfile = public_path('connection/'.\Session::get('appname'));
        $this->factory = (new Factory)->withServiceAccount($jsonfile.'.json');
    }

    public function index()
    {
        return \View::make('fileupload');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $fullpath = '';
        if($request->hasFile('uploadfile')){
            $firebase_storage_path = $request->bucketname;
            $destinationPath = public_path('firebase/');
            $file = $request->file('uploadfile');
            $file->move($destinationPath, $file->getClientOriginalName());
            $fullpath = 'firebase/'.$file->getClientOriginalName();

            $uploadfile = fopen(public_path($fullpath), 'r');

            $storage = $this->factory->createStorage();
            $storage->getBucket()
                        ->upload($uploadfile, ['name' => $firebase_storage_path.'/'.$file->getClientOriginalName()]);
            unlink(public_path($fullpath));
            return redirect()->to('/dashboard');
        }else{
            return redirect()->back();
        }
    }

    public function show(Request $request)
    {
        $expiresAt = new \DateTime('tomorrow');
        $storage = $this->factory->createStorage();
        $imageReference = $storage->getBucket()
                                    ->object($request->bucketname.'/'.$request->uploadfilename);
        if($imageReference->exists()){
            $image = $imageReference->signedUrl($expiresAt);
            return response()->json(["link"=> $image]);
        }else{
            return response()->json(["link"=> "Image Not Found !!"]);
        }
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request)
    {
        $expiresAt = new \DateTime('tomorrow');
        $storage = $this->factory->createStorage();
        $imageReference = $storage->getBucket()
                                    ->object($request->bucketname.'/'.$request->uploadfilename)->delete();
        return response()->json(true);
    }
}
