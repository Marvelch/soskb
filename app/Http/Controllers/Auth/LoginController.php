<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\customerTempEdit;
use App\Models\LoginToken;
use App\Models\productTempEdit;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check the user's account type here, adjust this logic according to your database structure
            if ($user->account_type === 'ADM') {
                return redirect()->route('admin.home');
            } elseif ($user->account_type === 'USR') {

                // DELETE ALL RECORD EDIT FROM TABLE CUSTOMER TEMP EDIT AND PRODUCT TEMP EDIT
                customerTempEdit::where('user_id',Auth::user()->id)->delete();
                productTempEdit::where('user_id',Auth::user()->id)->delete();

                return redirect()->route('home');
            } else {
                return "Gagal";
            }
        }

        // If authentication fails, redirect back with errors
        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }

    /**
     * Auth with whatsapp login.
     *
     * @return void
     */
    public function loginWithWhatsapp(Request $request)
    {
        $phoneNumber = $request->phone; // Nomor telepon yang ingin diganti

        // Periksa apakah nomor telepon dimulai dengan '0'
        if (Str::startsWith($phoneNumber, '0')) {
            $phoneNumber = '62' . substr($phoneNumber, 1); // Ganti '0' dengan '62' pada karakter pertama
        }

        $data = User::where('phone',$phoneNumber)->select('id')->first();

        if($data) {
            User::where('phone',$phoneNumber)->first()->sendLoginLink();

            toast('The activation link has been successfully sent','success');

            return redirect()->back();
        }else{
            toast('The user is not registered with the system','error');

            return redirect()->back();
        }
    }

    /**
     * Verify login using WhatsApp
     *
     * @return void
     */
    public function verifyLogin(Request $request, $token)
    {
        $token = LoginToken::whereToken(hash('sha256', $token))->firstOrFail();
        abort_unless($request->hasValidSignature() && $token->isValid(), 401);
        $token->consume();
        Auth::login($token->user);
        return redirect()->route('home');
    }
}
