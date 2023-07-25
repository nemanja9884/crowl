<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $users = User::paginate(50);
        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
//            'username' => 'required',
//            'email' => 'required',
            'status' => 'required',
            'password' => 'required',
        ));

        $user = new User();
        $user->create($request->all());
        Session::flash('message', 'Successfully created user');
        Session::flash('alert-class', 'success');
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', ['user' => $user]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, array(
//            'username' => 'required',
//            'email' => 'required',
            'status' => 'required',
        ));

        $user->update($request->all('status', $request->filled('password') ? 'password' : '', 'working_on_university', 'age', 'dominant_language', 'language_teacher'));
        Session::flash('message', 'Successfully updated user');
        Session::flash('alert-class', 'success');
        return redirect()->route('admin.users.index');
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();
        Session::flash('message', 'Successfully deleted user');
        Session::flash('alert-class', 'success');
        return redirect()->route('admin.users.index');
    }
}
