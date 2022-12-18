<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $users = Admin::paginate(50);
        return view('admin.admins.index', ['users' => $users]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.admins.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'password' => 'required',
        ));

        $user = new Admin();
        $user->create($request->all());
        Session::flash('message', 'Successfully created admin');
        Session::flash('alert-class', 'success');
        return redirect()->route('admin.admins.index');
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
    public function edit(Admin $admin)
    {
        return view('admin.admins.edit', ['admin' => $admin]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Admin $admin)
    {
        $this->validate($request, array(
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required',
        ));

        $admin->update($request->all('name', 'lastname', 'email', 'status', $request->filled('password') ? 'password' : ''));
        Session::flash('message', 'Successfully updated admin');
        Session::flash('alert-class', 'success');
        return redirect()->route('admin.admins.index');
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        Session::flash('message', 'Successfully deleted user');
        Session::flash('alert-class', 'success');
        return redirect()->route('admin.admins.index');
    }
}
