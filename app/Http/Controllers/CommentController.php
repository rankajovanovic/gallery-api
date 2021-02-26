<?php

namespace App\Http\Controllers;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Controller for storing comments
     */
     public function store(CommentRequest $request) {

        $data = $request->validated();



        $newCom = Comment::create($data);
        return response()->json($newCom);


        // $this->validate($request,
        // [
        //     'description' => 'required|max:1000',
        //     'user_id' => 'required', 
        //     // 'gallery_id' => 'required'
        // ]);

        // $comment = Comment::create($request->all());   

        // return Comment::with('user')->findOrFail($comment->id);







        return Comment::addComment($request);
     }
     /**
      * Controller for deleting comment
      */
     public function destroy($comment) {
         return Comment::destroy($comment);
     }
}
