<?php

namespace App\Http\Controllers;

use Session;
use Sentinel;
use App\Image;
use App\Http\Requests\ImageCreateRequest;
use App\Http\Requests\ImageUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as InterventionImage;

class ImagesController extends Controller
{
    private $image;

    public function __construct(Image $image) {
        $this->image = $image;
    }

    public function index() {
        $images = $this->image->where('users_id', Sentinel::getUser()['original']['id'])->get();
        return view('images.index', ['images' => $images]);
    }

    public function show($id) {
        if (! empty($image = $this->image->where('id', $id)->first())) {
            $user = $this->image->find($id)->users()->first();
            return view('images.show', [
                'image' => $image,
                'user' => $user
            ]);
        }
        Session::flash('error', 'image is not found');
        return redirect()->route('images.index');
    }

    public function create() {
        return view('images.create');
    }

    public function store(ImageCreateRequest $request) {
        $file = $request->file('image');
        $filename = str_random(10) . '.jpg';
        $filepath = '/uploads/' . $filename;
        $image = InterventionImage::make($file)->resize(200, 400)->encode('jpg');
        Storage::disk('uploads')->put($filename, $image);
        $data = [
            'title' => $request->input('title'),
            'url' => $filepath,
            'users_id' => Sentinel::getUser()['original']['id']
        ];
        $this->image->create($data);
        Session::flash('notice', 'new images has been posted');
        return redirect()->route('images.index');

        // [tanpa intervention]
        // $filename = str_random(10) . '.jpg';
        // $filepath = '/uploads/' . $filename;
        // Storage::disk('uploads')->put($filename, File::get($file));
        // $data = [
        //     'title' => $request->input('title'),
        //     'url' => $filepath,
        //     'users_id' => Sentinel::getUser()['original']['id']
        // ];
        // $this->image->create($data);
        // Session::flash('notice', 'new images has been posted');
        // return redirect()->route('images.index');
    }

    public function edit($id)
    {
        $image = $this->image->find($id);
        return view('images.edit', ['image' => $image]);
    }

    public function update(ImageUpdateRequest $request, $id)
    {
        $file = $request->file('image');
        $filename = str_random(10) . '.jpg';
        $filepath = '/uploads/' . $filename;

        Storage::disk('uploads')->put($filename, File::get($file));

        $data = [
            'title' => $request->input('title'),
            'url' => $filepath,
            'users_id' => Sentinel::getUser()['original']['id']
        ];
        $image = $this->image->find($id);
        $image->title = $data['title'];
        $image->url = $data['url'];
        $image->users_id = $data['users_id'];
        $image->save($data);

        Session::flash('notice', 'Image has been updated!');
        return redirect()->route('images.index');
    }

    public function destroy ($id)
    {
        // save temporary
        $image = $this->image->find($id)->first();
        // // begin deleting
        $this->image->find($id)->destroy($id);
        $url = ltrim($image->url, '/');
        File::delete($url);
        Session::flash('notice', 'Images success deleted');
        return redirect()->route('images.index');
    }
}
