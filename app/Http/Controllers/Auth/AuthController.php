<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Validator;


class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.registration');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            //    

            return redirect()->intended('visit')
                ->with('You have Successfully loggedin');
        }


        return redirect("login");
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'visits' => '1'
        ]);
        return redirect("visit");
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function visit(Request $request)
    {

        if (Auth::check()) {
            return view('visit');
        }

        return redirect("login");
    }
    public function visits(Request $request)
    {
        $email = Auth::user()->email;
        $visits = Auth::user()->visits;

        if ($visits <= 2) {
            $student = new User();
            $student->username = $request->user_name;
            $student->Phone_no = $request->phone;
            $student->expectations = $request->expectations;
            $student->area = $request->area;
            $student->Budget = $request->budget;
            $student->visits = $visits + 1;
            $res =  $student->save();
            if ($res) {
                $update = User::where('email', $email)->update([
                    'visits' => $visits + 1
                ]);
                return 'data inserted';
            } else {
                return 'not inserted';
            }
        } else {
            return 'Sorry  already  you attempt 2 times ';
        }
    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
