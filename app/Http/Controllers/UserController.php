<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Address;
use App\Models\User_address;
use App\Models\Country;
use App\Models\User_role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Product_category;
use Illuminate\Support\Facades\Auth;
use App\Models\Shopping_cart;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // Show Register Form
    public function create()
    {
        return view('users.register');
    }

    // Create new user
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email_address' => ['required', 'email', Rule::unique('users', 'email_address')],
            'phone_number' => ['required', 'min:10', 'max:11', Rule::unique('users', 'phone_number')],
            'password' => 'required|confirmed|min:6'
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create new user
        $user = User::create($formFields);


        // Add role "user" for user
        User_role::create([
            'user_id' => $user->id,
            'role_id' => 2
        ]);
        // Add cart for user
        Shopping_cart::create([
            'user_id' => $user->id
        ]);

        //Login 
        auth()->login($user);

        return redirect('/')->with('message', "Đăng ký tài khoản mới thành công");
    }

    public function login()
    {
        return view('users.login');
    }

    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email_address' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'Bạn đã đăng nhập thành công !!');
        }

        return back()->with('message', 'Sai tài khoản hoặc mật khẩu!');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Bạn đã đăng xuất!');
    }

    // Show edit user view
    public function edit()
    {
        $shipping_address = DB::select(
            'select unit_number as unit, street_number as street, address_line1 as address1,
                address_line2 as address2, city, region, country_name, is_default 
            from addresses, user_addresses, countries
            where addresses.id = user_addresses.address_id 
                and addresses.country_id = countries.id
                and user_addresses.user_id = ?', [auth()->id()]);

        if (Auth::user() ?? null) {
            return view('users.manage', [
                'shipping' =>$shipping_address
            ]);
        }
        return redirect('users.login');
    }

    // Fogot Password
    public function fogotPassword()
    {
        return view('users.forgot-password');
    }

    public function postFogotPassword(Request $request) 
    {
        $request->validate(['email_address' => 'required|email']);
        
        $status = Password::sendResetLink(
            $request->only('email_address')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email_address' => __($status)]);
    }

    //Reset Password
    public function resetPassword ($token) 
    {
        return view('users.reset-pass', ['token' => $token]);
    }

    public function postResetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email_address' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
     
        $status = Password::reset(
            $request->only('email_address', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email_address' => [__($status)]]);
    }

    //Edit Address
    public function editAddress()
    {
        $addresses = DB::table('addresses')
            ->where('users.id', auth()->id())
            ->join('user_addresses','user_addresses.address_id','=','addresses.id')
            ->join('users','user_addresses.user_id','=','users.id')
            ->join('countries','countries.id', '=','addresses.country_id')
            ->select('addresses.id as id', 'unit_number', 
                    'street_number', 'address_line1', 'address_line2', 
                    'city', 'region','is_default', 'country_name' )
            ->get();
        return view('users.manage-address',[
            'addresses' => $addresses
        ]);
    }

    public function addAddressPage()
    {
        return view('users.add-new-address');
    }

    public function addAddress(Request $request)
    {
        $formFields = $request->validate([
            'unit_number' => ['required'],
            'street_number' => ['required'],
            'address_line1' => ['required'],
            'address_line2' => ['required'],
            'city' => ['required'],
            'region' => ['required'],
            'postal_code'=> ['nullable'],
            'country_id' => ['required'],
        ]);

        //create a row that contain infomations in $formFields into Address table
        $address = Address::create($formFields);

        //add infomations into user_address table
        User_address::create([
            'user_id' => auth()->id(),
            'address_id' => $address->id,
            'is_default' => false
        ]);

       return redirect('/user/address')->with('message', "Thêm địa chỉ mới thành công");
    }

    public function updateAddress(Request $request)
    {
        //những địa chỉ được check thì sẽ bị xóa, nếu không địa chỉ nào bị xóa thì bỏ qua
        if($request->delete)
        {
            foreach($request->delete as $delete_id)
            {
                DB::delete('delete from addresses where addresses.id = ?', [$delete_id]);
                DB::delete('delete from user_addresses where user_addresses.address_id = ?', [$delete_id]);
            }
        }

        //địa chỉ được check mặc định thì sẽ được cập nhật là is_default=true
        //các địa chỉ khác sẽ là is_default=false

        if ($request->defaultAddress)
        {
            DB::update('update user_addresses set is_default=false where address_id != ?', [$request->defaultAddress]);
            DB::update('update user_addresses set is_default=true where address_id = ?', [$request->defaultAddress]);
        }
        
        return UserController::editAddress();
    }
}
