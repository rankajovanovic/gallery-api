<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Requests\GalleryRequest;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $galleries = Gallery::with('user', 'images', 'comments')->limit($request->header('numberPerPage'))->get();
        $galleriesQuery = Gallery::query();
        $galleriesQuery->with('user', 'images', 'comments');
        $search = $request->header('searchText');
        $galleriesQuery->where( functioN($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orwhereHas('user', function($que) use ($search) {
                    $que->where('first_name', 'like', '%' . $search . '%')
                        ->orWhere('last_name', 'like', '%' . $search . '%');
                });
        });
    
        $galleries = $galleriesQuery->take($request->header('pagination'))->get();
        $count = $galleriesQuery->count();
    
        return [$galleries, $count];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $data = $request->validated();

        $user = User::findOrFail($request['id']);
        $user_id = $user->id;
        $gallery= Gallery::create([
            "name"=>$data['name'],
            "description"=>$data['description'],
            'user_id' => $user_id
        ]);
        foreach($data['listOfUrl'] as $imageURL) {
            $gallery->addImages($source, $gallery['id']);
        }
        
        return response()->json($gallery);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gallery = Gallery::with('images', 'user', 'comments.user')->findOrFail($id);
       
        return response()->json($gallery);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        $data = $request->validated();

        $gallery = Gallery::findOrFail($id);
        $gallery->update($data);
        return response()->json($gallery);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();
        return response()->json($gallery);
    }

    public function myGalleries(Request $request)
    {
        $id = $request->input('user_id');
        $galleries = Gallery::where('user_id', $id)->with('images', 'user')->get();

        return response()->json($galleries);
    }

    public function authorGalleries($id)
    {
        $galleries = Gallery::where('user_id', $id)->with('images', 'user')->get();

        return response()->json($galleries);
    }
}
