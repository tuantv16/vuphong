<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Session;
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
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //login backend
    public function getLogin() {
    	return view('auth/login');
    }

    //login backend
    public function postLogin(Request $request) {
    	// Kiểm tra dữ liệu nhập vào
    	$rules = [
    		'email' =>'required|email',
    		'password' => 'required|min:6'
    	];
    	$messages = [
    		'email.required' => 'Email là trường bắt buộc',
    		'email.email' => 'Email không đúng định dạng',
    		'password.required' => 'Mật khẩu là trường bắt buộc',
    		'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự',
    	];
    	$validator = Validator::make($request->all(), $rules, $messages);
    	
    	
    	if ($validator->fails()) {
    		// Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng nhập và thông báo lỗi
    		return redirect('login')->withErrors($validator)->withInput();
    	} else {
    		// Nếu dữ liệu hợp lệ sẽ kiểm tra trong csdl
    		$email = $request->input('email');
    		$password = $request->input('password');
     
    		if( Auth::attempt(['email' => $email, 'password' =>$password])) {
                Session::put('email', $email);
    			// Kiểm tra đúng email và mật khẩu sẽ chuyển trang
    			return redirect('admin/dashboard');
    		} else {
    			// Kiểm tra không đúng sẽ hiển thị thông báo lỗi
    			Session::flash('error', 'Email hoặc mật khẩu không đúng!');
    			return redirect('login');
    		}
    	}
    }

    //login frontend
    public function getLoginHome() {
    	return view('auth/login');
    }

    //login frontend
    public function postLoginHome(Request $request) {
    	// Kiểm tra dữ liệu nhập vào
    	$rules = [
    		'email' =>'required|email',
    		'password' => 'required|min:6'
    	];
    	$messages = [
    		'email.required' => 'Email là trường bắt buộc',
    		'email.email' => 'Email không đúng định dạng',
    		'password.required' => 'Mật khẩu là trường bắt buộc',
    		'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự',
    	];

		$data = $request->all();
		$data['flag_login'] = true;

    	$validator = Validator::make($data, $rules, $messages);
    	
    	Session::flash('flag_login', true);
    	if ($validator->fails()) {
    		// Điều kiện dữ liệu không hợp lệ sẽ chuyển về trang đăng nhập và thông báo lỗi
    		return redirect('login.html')->withErrors($validator)->withInput();
    	} else {
    		// Nếu dữ liệu hợp lệ sẽ kiểm tra trong csdl
    		$email = $request->input('email');
    		$password = $request->input('password');
     
    		if( Auth::attempt(['email' => $email, 'password' =>$password])) {
                Session::put('email', $email);
    			// Kiểm tra đúng email và mật khẩu sẽ chuyển trang
    			return redirect('/');
    		} else {    
    			// Kiểm tra không đúng sẽ hiển thị thông báo lỗi
    			Session::flash('error', 'Email hoặc mật khẩu không đúng!');
    			return redirect('login');
    		}
    	}
    }
    

}
