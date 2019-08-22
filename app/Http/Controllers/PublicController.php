<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;
use App\Image;

class PublicController extends Controller
{
    public function view($id)
    {
        $home = Property::where(["id" => $id]);
        $count = count($home->get());
        $home = $home->first();
        $images = Image::where('property_id', $home->id)->get();
            if ($count) {
                return view('public_view')->with(['home' => $home, 'images' => $images]);
            }
        return redirect()->route('home')->with('message', 'No valid home ID detected');

    }
}
