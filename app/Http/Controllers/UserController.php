<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('userView', $row->id) . '" class="edit btn btn-primary">Edit</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('user.daftarPengguna');
    }

    public function create()
    {
        return view('user.registrasi');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:100'],
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => ['required', 'string', 'max:1000'],
            'birthdate' => ['required', 'date'],
            'phonenumber' => ['required', 'string', 'max:20'],
            'agama' => ['required', 'string', 'max:20'],
            'gender' => ['required']
        ]);

        $user = User::create([
            'username' => $request->username,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'birthdate' => $request->birthdate,
            'phonenumber' => $request->phonenumber,
            'agama' => $request->agama,
            'gender' => (int)$request->gender
        ]);

        event(new Registered($user));

        return redirect('/user');
    }

    public function show(User $user)
    {
        return view('user.infoPengguna', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fullname' => 'string|max:255',
            'password' => ['confirmed', Rules\Password::defaults()],
            'address' => 'string|max:1000',
            'phonenumber' => 'string|max:20'
        ]);

        User::find($id)->update([
            'fullname' => $request->fullname,
            'address' => $request->address,
            'password' =>  Hash::make($request->password),
            'phonenumber' => $request->phonenumber
        ]);
        return redirect('/user');
    }
}
