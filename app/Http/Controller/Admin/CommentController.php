<?php

namespace App\Http\Controller\Admin;

use App\Comment;
use App\Http\Controller\Admin\PanelController;
use App\Http\Requests\Admin\CommentRequest;

class CommentController extends PanelController
{
    public function index()
    {
        $comments = Comment::whereNull("parent_id")->get();
        return view("admin.comment.index", compact("comments"));
    }
    public function show($id)
    {
        $comment = Comment::find($id);
        return view("admin.comment.show", compact("comment"));
    }
    public function store($postId , $id)
    {
        $request = new CommentRequest();
        $result = $request->all();
        $result["user_id"] = session("user");
        $result["post_id"] = $postId;
        $result["parent_id"] = $id;
        Comment::create($result);
        redirect("admin/comments");
    }
    public function enableDesable($id)
    {
        $comment = Comment::find($id);
        if ($comment->approved == 1) {
            $desable = ["approved" => "0"];
            Comment::update(array_merge($desable, ["id" => $id]));
        } else if ($comment->approved == 0) {
            $enable = ["approved" => 1];
            Comment::update(array_merge($enable, ["id" => $id]));
        }
        redirect("admin/comments");
    }
}
