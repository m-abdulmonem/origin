<?php

namespace App\Http\Controllers\ClientEnd\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Auth\LoginRequest;
use App\Models\Admin;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     *
     * @var Request request
     */
    public Request $request;

    /**
     *
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->folder = $this->dPath.".auth.index";
    }

    /**
     * show login page
     *
     * @param Request $request
     * @return Factory|View|Application
     */
    public function showLoginForm(Request $request): Factory|View|Application
    {
        $this->isLoggedIn();
        return view($this->folder,['title' => 'Login']);
    }

    /**
     * action login page
     *
     * @param Request $request
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function login(LoginRequest $request)
    {
        $this->isLoggedIn();

        if (Auth::guard("dashboard")->attempt($this->credentials(),$this->remember())){
            $request->session()->regenerate();
            return redirect(route("dashboard"));
        }

        return $this->validateInput();
    }

    /**
     * logout the current admin session
     *
     * @return \Illuminate\Routing\Redirector|Application|\Illuminate\Http\RedirectResponse
     */
    public function logout(): \Illuminate\Routing\Redirector|Application|\Illuminate\Http\RedirectResponse
    {
        Auth::guard("dashboard")->logout();

        $this->request->session()->invalidate();

        $this->request->session()->regenerateToken();

        return redirect(route("dashboard.login"));
    }


    private function isLoggedIn()
    {
        if(Auth::guard('dashboard')->check()){
            return \redirect(\route("dashboard"));
        }
    }

    /**
     * validate input values
     *
     * @return \Illuminate\Http\RedirectResponse|void
     */
    private function validateInput()
    {
        if (!$this->admin()){
            return back()->with(['userError' => ucfirst($this->auth()) . " does not exists"]);
        }else if (Hash::check($this->request->password,$this->admin()->password)){
            return back()->with(['passError' => ucfirst($this->auth()) . " does not match!"]);
        }
    }

    /**
     * check if admin check to remember me
     *
     * @return bool
     */
    private function remember() : bool
    {
        return  $this->request->remember == "on";
    }

    /**
     * admin credentials to login
     *
     * @return array
     */
    private function credentials() : array
    {
        $auth = $this->auth();

        return[
            $auth => $this->request->auth,
            'password' => $this->request->password
        ];
    }

    /**
     * get filed form input value
     *
     * @return string
     */
    private function auth() : string
    {
        return filter_var($this->request->auth,FILTER_VALIDATE_EMAIL) ? "email" : "username";
    }

    private function admin()
    {
        return Admin::where($this->auth(),$this->request->auth)->first();
    }
}
