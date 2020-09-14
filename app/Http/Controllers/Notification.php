<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Kreait\Firebase\Messaging\Message;
use Kreait\Firebase\Messaging\Cloudmessage;
use Kreait\Firebase\Messaging\WebPushConfig;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class Notification extends Controller
{
    public $factory;
    public function __construct()
    {
        $jsonfile = public_path('connection/'.\Session::get('appname'));
        $this->factory = (new Factory)->withServiceAccount($jsonfile.'.json');
    }

    public function index()
    {
        return \View::make('webpush');
    }

    public function create()
    {
        echo "ffff";
    }

    public function store(Request $request)
    {
        $config = WebPushConfig::fromArray([
            'notification' => [
                'title' => $request->title,
                'body' => $request->body,
                'icon' => $request->icon,
            ],
            'fcm_options' => [
                'link' => $request->weblink,
            ],
        ]);
        $messaging = $this->factory->createMessaging();
        $message = CloudMessage::new();
        $message = $message->withWebPushConfig($config);
        return redirect()->back();
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
