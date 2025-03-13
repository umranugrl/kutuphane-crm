<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin/index';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->has('remember'); // "Beni Hatırla" seçili mi?

        if (Auth::attempt($credentials, $remember)) { // Remember parametresini ekledik
            $request->session()->regenerate();
            return redirect()->intended('admin/index');
        }

        return back()->withErrors([
            'email' => 'Girdiğiniz bilgiler kayıtlarla uyuşmuyor.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Kullanıcıyı çıkış yaptır

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
