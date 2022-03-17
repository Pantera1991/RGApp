<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Filters\UserFilter;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Nette\NotImplementedException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        session()->forget('_old_input');

        return view('admin.user.index', [
            "users" => User::paginate(10),
            "sortable" => User::$sortable,
        ]);
    }

    /**
     * @param Request $request
     * @param UserFilter $userFilter
     * @return View
     */
    public function search(Request $request, UserFilter $userFilter): View
    {
        session()->flashInput($request->input());

        return view('admin.user.index', [
            "users" => User::filter($userFilter)->paginate(10)->appends($request->input()),
            "sortable" => User::$sortable,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return RedirectResponse
     */
    public function store(UserRequest $request): RedirectResponse
    {
        try {
            $dataUser = $request->validated();
            $dataUser['password'] = Hash::make($dataUser['password']);
            User::create($dataUser);
            return redirect()->route('users.index')->with('message.success', __('create.success'));
        } catch (\Exception $e) {
            report(__CLASS__ . "::store, {$e->getMessage()}");
            return redirect()->route('users.index')->with('message.error', __('create.error'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        throw new NotImplementedException();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
        return view("admin.user.edit", [
            "user" => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $comment
     * @return RedirectResponse
     */
    public function update(UserRequest $request, User $comment): RedirectResponse
    {
        try {
            $dataUser = $request->validated();
            $dataUser['password'] = Hash::make($dataUser['password']);
            $comment->update($dataUser);
            return redirect()->route('users.index')->with('message.success', __('update.success'));
        } catch (\Exception $e) {
            report(__CLASS__ . "::update, {$e->getMessage()}");
            return redirect()->route('users.index')->with('message.error', __('update.error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        try {
            $user->delete();
            return redirect()->route('users.index')->with('message.success', __('delete.success'));
        } catch (\Exception $e) {
            report(__CLASS__ . "::destroy, {$e->getMessage()}");
            return redirect()->route('users.index')->with('message.error', __('delete.error'));
        }
    }
}
