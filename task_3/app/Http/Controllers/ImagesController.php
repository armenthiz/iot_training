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
    /**
     * Hold Image Model Instance
     */
    private $image;

    /**
     * ImagesController Constructor
     */
    public function __construct(Image $image) {
        $this->image = $image;
    }

    /**
     * Main index page
     */
    public function index() {
        // Get current logged in user
        $currentUserId = Sentinel::getUser()['original']['id']; 

        // Get the images based on id's
        $images = $this->image->where('users_id', $currentUserId)->paginate(5);

        // return response
        return view('images.index', ['images' => $images]);
    }

    /**
     * controller to show the specific image
     */
    public function show($id) {
        // if specific image is not empty, then
        if (! empty($image = $this->image->where('id', $id)->first())) {
            $user = $this->image->find($id)->users()->first();
            return view('images.show', [
                'image' => $image,
                'user' => $user
            ]);
        }

        // Else if specific image is empty, 
        // Throw the flash message
        Session::flash('error', 'image is not found');
        return redirect()->route('images.index');
    }

    /**
     * controller to display the create image form
     */
    public function create() {
        return view('images.create');
    }

    /**
     * controller to storing new image to database, and storing submitted
     * image files (eg: jpg), into local drive (/public/uploads)
     */
    public function store(ImageCreateRequest $request) {
        // Getting File
        $file = $request->file('image');

        // Getting Original Filename
        $origFileName = explode('.', $file->getClientOriginalName());

        // Getting File Mime's
        $mime = $origFileName[count($origFileName) - 1];

        // Setup new Filename
        $name = str_random(10);

        // Setup image resizing to Larger Size
        $lgFileName = $name . '-lg.' . $mime;
        $lgFilePath = '/uploads/' . $lgFileName;

        // Keep image in watch of aspect ratio
        $image = InterventionImage::make($file)->resize(600, '', function ($constraint) {
            $constraint->aspectRatio();
        })->encode($mime); // and store it to local storage
        Storage::disk('uploads')->put($lgFileName, $image);

        // Setup image resizing to Larger Size
        $smFileName = $name . '-sm.' . $mime;
        $smFilePath = '/uploads/' . $smFileName;

        // Keep image in watch of aspect ratio
        $image = InterventionImage::make($file)->resize(200, '', function ($constraint) {
            $constraint->aspectRatio();
        })->encode($mime); // and store it to local storage
        Storage::disk('uploads')->put($smFileName, $image); 

        // Setup data to Storing to database
        $data = [
            'title' => $request->input('title'),
            'url' => $lgFilePath,
            'url_small' => $smFilePath,
            'users_id' => Sentinel::getUser()['original']['id']
        ];

        // Storing Data and throw flash message
        $this->image->create($data);
        Session::flash('notice', 'new images has been posted');
        return redirect()->route('images.index');
    }

    /**
     * controller to display the specific image that going to be edited.
     */
    public function edit($id)
    {
        // find specific image
        $image = $this->image->find($id);

        // if image is not found
        if (! $image) {
            Session::flash('error', 'The requested image was not found');
            return redirect()->route('images.index');
        }

        // throw responses
        return view('images.edit', ['image' => $image]);
    }

    public function update(ImageUpdateRequest $request, $id)
    {
        if (! $request->file('image')) {
            $image = $this->image->find($id);

            // Storing data to existed resource in database
            $image->title = $request->input('title');
            $image->save();

        } else {
            // Getting File
            $file = $request->file('image');

            // Getting Original Filename
            $origFileName = explode('.', $file->getClientOriginalName());

            // Getting File Mime's
            $mime = $origFileName[count($origFileName) - 1];

            // Setup new Filename
            $name = str_random(10);

            // Setup image resizing to Larger Size
            $lgFileName = $name . '-lg.' . $mime;
            $lgFilePath = '/uploads/' . $lgFileName;
            $image = InterventionImage::make($file)->resize(600, '', function ($constraint) {
                $constraint->aspectRatio();
            })->encode($mime);
            Storage::disk('uploads')->put($lgFileName, $image);

            // Setup image resizing to Larger Size
            $smFileName = $name . '-sm.' . $mime;
            $smFilePath = '/uploads/' . $smFileName;
            $image = InterventionImage::make($file)->resize(200, '', function ($constraint) {
                $constraint->aspectRatio();
            })->encode($mime);
            Storage::disk('uploads')->put($smFileName, $image); 

            // Setup data to Storing to database
            $data = [
                'title' => $request->input('title'),
                'url' => $lgFilePath,
                'url_small' => $smFilePath,
                'users_id' => Sentinel::getUser()['original']['id']
            ];

            $image = $this->image->find($id);
            // delete the unused image
            $url = ltrim($image->url, '/');
            File::delete($url);

            // delete the unused image
            $url = ltrim($image->url_small, '/');
            File::delete($url);

            // Storing data to existed resource in database
            $image->title = $data['title'];
            $image->url = $data['url'];
            $image->url_small = $data['url_small'];
            $image->users_id = $data['users_id'];
            $image->save($data);
        }

        // Returning responses
        Session::flash('notice', 'Image has been updated!');
        return redirect()->route('images.index');   
    }

    public function destroy ($id)
    {
        // save temporary
        $image = $this->image->where('id', $id)->first();

        // begin deleting
        // delete from database
        $this->image->find($id)->destroy($id);
        
        // delete the unused image
        $url = ltrim($image->url, '/');
        File::delete($url);

        // delete the unused image
        $url = ltrim($image->url_small, '/');
        File::delete($url);

        // returing responds
        Session::flash('notice', 'Images success deleted');
        return redirect()->route('images.index');
    }
}
