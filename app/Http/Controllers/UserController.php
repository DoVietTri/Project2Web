<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\Http\Requests\UserRequest;
use DB;
use Excel;
use App\Exports\UserExports;


class UserController extends Controller
{
    public function getLogin() {
        // \Session::flash('toastr', [
        //  'type' => 'success',
        //  'message' => 'Vui lòng đăng nhập trước khi mua hàng'
        // ]);
        $product_selling = DB::table('products')->orderBy('product_pay', 'DESC')->skip(0)->take(3)->get();
		return view('client.pages.login', compact('product_selling'));
	}

	public function postLogin(Request $req) {
		$this->validate($req, [
			'txtEmail'  => 'required|email',
			'txtPassword' => 'required'
		], [
			'txtEmail.required'  => 'Vui lòng nhập tài khoản',
			'txtEmail.email'   => 'Không phải định dạng email',
			'txtPassword.required'   => 'Vui lòng nhập mật khẩu'
		]);

		$data = [
			'email' => $req->txtEmail,
			'password'  => $req->txtPassword,
            'status' => 0
		];

		if (Auth::attempt($data)) {
            \Session::flash('toastr', [
                'type' => 'success',
                'message' => 'Đăng nhập thành công !'

            ]);
			return redirect()->route('index');
		} else {
            \Session::flash('toastr', [
                'type' => 'error',
                'message' => 'Đăng nhập không thành công !'

            ]);
			return redirect()->route('client.getLogin');
		}
	}

	public function getLogout() {
		if (Auth::logout()) {
            \Session::flash('toastr', [
                'type' => 'error',
                'message' => 'Đăng xuất không thành công !'

            ]);
            return redirect()->back();
        } else {
            \Session::flash('toastr', [
                'type' => 'success',
                'message' => 'Đăng xuất thành công !'

            ]);
            return redirect()->back();
        }
		
	}

    public function getRegister() {
        $product_selling = DB::table('products')->orderBy('product_pay', 'DESC')->skip(0)->take(3)->get();
    	return view('client.pages.register', compact('product_selling'));
    }

    public function postRegister(Request $request) {
    	$this->validate($request, [
    		'txtUsername'  => 'required',
    		'txtPassword'  => 'required',
    		'txtRePassword' => 'required|same:txtPassword',
    		'txtEmail'   => 'required|email|unique:users,email'
    	], [
    		'txtUsername.required'   => 'Vui lòng nhập tên tài khoản',
    		'txtPassword.required'  => 'Vui lòng nhập mật khẩu',
    		'txtRePassword.required'  => 'Vui lòng nhập lại mật khẩu',
    		'txtRePassword.same'  => 'Mật khẩu phải trùng nhau',
    		'txtEmail.required'   => 'Vui lòng nhập email',
    		'txtEmail.email'   => 'Không đúng định dạng',
    		'txtEmail.unique'  => 'Email đã tồn tại'
    	]);

    	$user = new User;

    	$user->name = $request->txtUsername;
    	$user->email = $request->txtEmail;
    	$user->password = Hash::make($request->txtPassword);
    	$user->remember_token = $request->_token;
    	$user->save();

        if ($user) {
            \Session::flash('toastr', [
                'type' => 'success',
                'message' => 'Đăng kí thành công'
            ]);
            Auth::login($user);
            return redirect()->route('index');
        }
	
        return redirect()->back();	
    }

    public function getProfile() {
    	if (Auth::check()) {
            return view('client.pages.account');
        } else {
            \Session::flash('toastr', [
                'type' => 'success',
                'message' => 'Đăng xuât thành công !'

            ]);
            return redirect()->route('index');
        }
    }

    public function getLoginAdmin() {

        if (Auth::check() && (Auth::user()->ruler == 1 || Auth::user()->ruler == 2)) {
            return redirect()->route('admin.index');
        } else {
            return view('admin.login');
        }
    }

    public function postLoginAdmin(Request $request) {
        $this->validate($request, [
            'txtEmail'  => 'required|email',
            'txtPassword' => 'required'
        ], [
            'txtEmail.required'  => 'Vui lòng nhập email',
            'txtEmail.email'   => 'Định dạng không phải email',
            'txtPassword.required'   => 'Vui lòng nhập mật khẩu'
        ]);

        $data = [
            'email'  => $request->txtEmail,
            'password'  => $request->txtPassword,
            'status' => 0
        ];

        if (Auth::attempt($data)) {
            if (Auth::user()->ruler == 1 || Auth::user()->ruler == 2) {
                \Session::flash('toastr', [
                    'type' => 'success',
                    'message' => 'Đăng nhập thành công !'

                ]);
                return redirect()->route('admin.index');
            }
        } else {
            \Session::flash('toastr', [
                'type' => 'error',
                'message' => 'Đăng nhập không thành công !'

            ]);
            return view('admin.login');
        }
    }

    public function getLogoutAdmin() {
        if (Auth::logout()) {
            \Session::flash('toastr', [
                'type' => 'error',
                'message' => 'Đăng xuất không thành công !'

            ]);
            return redirect()->back();
        } else {
            \Session::flash('toastr', [
                'type' => 'success',
                'message' => 'Đăng xuất thành công !'

            ]);
            return redirect()->route('index');
        }
    }

    public function getList() {
        $user = User::select('id', 'name', 'email', 'ruler', 'status')->orderBy('id', 'DESC')->get();
        return view('admin.pages.user.list', compact('user'));
    }

    public function getAdd() {
        return view('admin.pages.user.add');
    }

    public function postAdd(UserRequest $request) {
        $user = new User;

        $user->name = $request->txtUsername;
        $user->email = $request->txtEmail;
        $user->password = Hash::make($request->txtPass);
        $user->ruler = $request->rdoRuler;
        $user->save();

        return redirect()->route('admin.user.getList')->with(['flash_level' => 'success', 'flash_message' => 'Thành công ! Thêm thành viên thành công']);
    }

    public function getDelete($id) {
        $user = User::find($id);
        $user_current_login = Auth::user()->id;

        if ($id == 1 || ($user_current_login != 1 && $user->ruler == 2)) {
            return redirect()->route('admin.user.getList')->with(['flash_level' => 'danger', 'flash_message' => 'Bạn không có quyền xóa thành viên này']);
        } else {
            $user->delete();
            return redirect()->route('admin.user.getList')->with(['flash_level' => 'success', 'flash_message' => 'Thành công ! Xóa thành viên thành công']);
        }
    }

    public function excel() {
        return Excel::download(new UserExports, 'users.xlsx');
    }

    public function getUnlock($id) {

        $user = User::find($id);
        $user_current = Auth::user()->id;
        if ($id == 1 || $user_current != 1 && $user->ruler == 2) {
            return redirect()->route('admin.user.getList')->with(['flash_level' => 'danger', 'flash_message' => 'Bạn không có quyền mở khóa tài khoản thành viên này']);
        } else {
            \DB::table('users')->where('id', $id)->update(['status' => 0]);
            return redirect()->route('admin.user.getList')->with(['flash_level' => 'success', 'flash_message' => 'Mở khóa tài khoản thành công !']);
        }
    }

    public function getLock($id) {

        $user = User::find($id);
        $user_current = Auth::user()->id;
        if ($id == 1 || $user_current != 1 && $user->ruler == 2) {
            return redirect()->route('admin.user.getList')->with(['flash_level' => 'danger', 'flash_message' => 'Bạn không có quyền khóa tài khoản thành viên này']);
        } else {
            \DB::table('users')->where('id', $id)->update(['status' => 1]);
            return redirect()->route('admin.user.getList')->with(['flash_level' => 'success', 'flash_message' => 'Khóa tài khoản thành công !']);
        } 
    }
}
