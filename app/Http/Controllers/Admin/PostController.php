<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Filters\PostFilter;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Nette\NotImplementedException;
use function __;
use function redirect;
use function report;
use function session;
use function view;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        session()->forget('_old_input');

        return view('admin.post.index', [
            "posts" => Post::paginate(10),
            "sortable" => Post::$sortable,
        ]);
    }

    /**
     * @param Request $request
     * @param PostFilter $postFilter
     * @return View
     */
    public function search(Request $request, PostFilter $postFilter): View
    {
        session()->flashInput($request->input());

        return view('admin.post.index', [
            "posts" => Post::filter($postFilter)->paginate(10)->appends($request->input()),
            "sortable" => Post::$sortable,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return RedirectResponse
     */
    public function store(PostRequest $request): RedirectResponse
    {
        try {
            Post::create($request->validated());
            return redirect()->route('post.index')->with('message.success', __('create.success'));
        } catch (\Exception $e) {
            report(__CLASS__ . "::store, {$e->getMessage()}");
            return redirect()->route('post.index')->with('message.error', __('create.error'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return View
     */
    public function show(Post $post): View
    {
        throw new NotImplementedException();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return View
     */
    public function edit(Post $post): View
    {
        return view("admin.post.edit", [
            "post" => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        try {
            $post->update($request->validated());
            return redirect()->route('post.index')->with('message.success', __('update.success'));
        } catch (\Exception $e) {
            report(__CLASS__ . "::update, {$e->getMessage()}");
            return redirect()->route('post.index')->with('message.error', __('update.error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return RedirectResponse
     */
    public function destroy(Post $post): RedirectResponse
    {
        try {
            $post->delete();
            return redirect()->route('post.index')->with('message.success', __('delete.success'));
        } catch (\Exception $e) {
            report(__CLASS__ . "::destroy, {$e->getMessage()}");
            return redirect()->route('post.index')->with('message.error', __('delete.error'));
        }
    }
}
