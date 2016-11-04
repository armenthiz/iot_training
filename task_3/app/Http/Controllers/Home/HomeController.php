<?php

namespace App\Http\Controllers\Home;

use Session;
use App\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    public function index()
    {
        $images = $this->image->orderBy('updated_at', 'desc')
                ->paginate(10);
        return view('home.index', ['images' => $images]);
    }

    public function showImage($id)
    {
        if (! empty($image = $this->image->find($id))) {
            $user = $this->image->find($id)->users()->first();
            return view('home.showImage', [
                'image' => $image,
                'user' => $user
            ]);
        }
        Session::flash('error', 'your requested image is not found');
        return redirect()->route('home.index');
    }
}
