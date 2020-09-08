<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Storage;

class Fileupload extends Controller
{
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

            $factory = (new Factory)->withServiceAccount(__DIR__.'/krc-update-firebase-adminsdk-dhal2-2a79a16e75.json');
            $storage = $factory->createStorage();
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
        $factory = (new Factory)->withServiceAccount(__DIR__.'/krc-update-firebase-adminsdk-dhal2-2a79a16e75.json');
        $storage = $factory->createStorage();
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
        $factory = (new Factory)->withServiceAccount(__DIR__.'/krc-update-firebase-adminsdk-dhal2-2a79a16e75.json');
        $storage = $factory->createStorage();
        $imageReference = $storage->getBucket()
                                    ->object($request->bucketname.'/'.$request->uploadfilename)->delete();
        return response()->json(true);
    }
}
