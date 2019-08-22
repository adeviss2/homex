<?php

namespace App\Http\Controllers;
use Lang;
use App\Property;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;

class HomeController extends Controller
{
    protected static $home_id;
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
    public function view($id)
    {
        $home = auth()->user()->properties()->where(["id" => $id]);
        $count = count($home->get());
        $home = $home->first();
        $images = \App\Image::where('property_id', $home->id)->get();
            if ($count) {
                return view('view')->with(['home' => $home, 'images' => $images]);
            }
        return redirect()->route('home')->with('message', 'No valid home ID detected');

    }
    public function delete($id)
    {
        $home_id = auth()->user()->properties()->where(["id" => $id])->first();
        $home_id = $home_id->home_id;
        $home = auth()->user()->properties()->where(["id" => $id])->delete();
            if($home) {
                Storage::deleteDirectory('public/' . $home_id);
                return redirect()->route('home')->with('status', 'Property successfully deleted');
            } else {
                return redirect()->route('home')->with('message', 'Property non existent or it does not blong to you');
            }


    }
    public function index()
    {
        $homes = auth()->user()->properties()->orderBy('id', 'desc')->paginate(10);
        return view('home')->with(['homes' => $homes]);

    }
    private function contains($str)
    {
        if(str_contains($str, '?')) {
            $str = explode('?', $str);
            $str = current($str);
        }

        if(str_contains($str, 'http')) {
            $str = explode('/', $str);
            $str = end($str);
        }
        self::$home_id = $str;
        return trans('general.host') . $str;
    }
    private static function saveImage($url) {
        $client = new \GuzzleHttp\Client();
        $request = $client->get($url);
        $img_data = $request->getBody();
        $img_name = basename($url);

        Storage::put('public/' . self::$home_id . '/' . $img_name, $img_data);
    }

    private static function parseResponse($html) {
        $json = explode("window.__INITIAL_STATE__ = {", $html);
        $json = explode("};", $json[1]);
        $json = "{" . trim($json[0]) . "}";
        $json = json_decode($json, true);
        $json = $json['listingReducer'];
        self::insert($json);

        foreach($json['propertyImages'] as $img) {
            self::saveImage($img['uri']);
        }
    }

    private static function insert($json) {
        $home = new Property();
        $home->home_id = self::$home_id;
        $home->home_title = $json['headline'];
        $home->home_summary = @$json['accomodationSummary'] ? $json['accomodationSummary'] : '';
        $home->home_description = $json['description'];
        $home->bedrooms = $json['bedrooms'];
        $home->bathrooms = json_encode($json['bathrooms']);
        $home->sleeps = $json['sleeps'];
        $home->price = json_encode($json['averagePrice']);
        $home->address = json_encode($json['address']);
        $home->location = json_encode($json['geoCode']);
        $home->amenities = json_encode($json['amenities']);
        $home->mapimg = str_replace('signature', 'nothing', $json['propertyMapThumbnailUrl']);
        $home->user_id = auth()->user()->id;
        $home->save();
        $newid = $home->id;
            foreach($json['propertyImages'] as $img) {
                $image = new Image();
                $image->property_id = $newid;
                $image->img = self::$home_id . '/' . basename($img['uri']);
                $image->save();
            }
    }
    public function extract(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $url = $this->contains($request->search);
        $request = $client->get($url);
        $response = $request->getBody();
        self::parseResponse($response);
        return redirect()->route('home')->with('status', 'Property successfully added!');
    }
    public function download($id) {
        $home_id = auth()->user()->properties()->where(["id" => $id])->first();
        $home_id = $home_id->home_id;

        $client = new \GuzzleHttp\Client(['verify' => false]);
        $request = $client->get(url('home/view/public/' . $id));
        $response = $request->getBody();

        Storage::deleteDirectory('public/downloads/');
        Storage::disk('local')->put('public/' . $home_id . '/home.html', $response);
        $files = glob('storage/' . $home_id . '/*');
        \Zipper::make(storage_path('app/public/downloads/' . $home_id . '.zip'))->add($files)->close();
        return response()->download(storage_path('app/public/downloads/' . $home_id . '.zip'));
    }
}
