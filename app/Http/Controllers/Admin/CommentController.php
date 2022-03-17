<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Filters\CommentFilter;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Nette\NotImplementedException;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        session()->forget('_old_input');

        return view('admin.comment.index', [
            "comments" => Comment::paginate(10),
            "sortable" => Comment::$sortable,
        ]);
    }

    /**
     * @param Request $request
     * @param CommentFilter $commentFilter
     * @return View
     */
    public function search(Request $request, CommentFilter $commentFilter): View
    {
        session()->flashInput($request->input());

        return view('admin.comment.index', [
            "comments" => Comment::filter($commentFilter)->paginate(10)->appends($request->input()),
            "sortable" => Comment::$sortable,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $posts = Post::all();
        return view('admin.comment.create', [
            "posts" => $posts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CommentRequest $request
     * @return RedirectResponse
     */
    public function store(CommentRequest $request): RedirectResponse
    {
        try {
            Comment::create($request->validated());
            return redirect()->route('comments.index')->with('message.success', __('create.success'));
        } catch (\Exception $e) {
            report(__CLASS__ . "::store, {$e->getMessage()}");
            return redirect()->route('post.index')->with('message.error', __('create.error'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Comment $comment
     * @return View
     */
    public function show(Comment $comment): View
    {
        throw new NotImplementedException();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Comment $comment
     * @return View
     */
    public function edit(Comment $comment): View
    {
        $posts = Post::all();
        return view("admin.comment.edit", [
            "comment" => $comment,
            "posts" => $posts,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CommentRequest $request
     * @param Comment $comment
     * @return RedirectResponse
     */
    public function update(CommentRequest $request, Comment $comment): RedirectResponse
    {
        try {
            $comment->update($request->validated());
            return redirect()->route('comments.index')->with('message.success', __('update.success'));
        } catch (\Exception $e) {
            report(__CLASS__ . "::update, {$e->getMessage()}");
            return redirect()->route('comments.index')->with('message.error', __('update.error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return RedirectResponse
     */
    public function destroy(Comment $comment): RedirectResponse
    {
        try {
            $comment->delete();
            return redirect()->route('comments.index')->with('message.success', __('delete.success'));
        } catch (\Exception $e) {
            report(__CLASS__ . "::destroy, {$e->getMessage()}");
            return redirect()->route('comments.index')->with('message.error', __('delete.error'));
        }
    }
}
