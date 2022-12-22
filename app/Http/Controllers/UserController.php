<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Address;
use App\Models\User_address;
use App\Models\Country;
use App\Models\User_role;
use App\Models\User_payment_method;
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
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Routes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

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
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|same:password'
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // insert avatar
        $formFields['avatar'] = '/assets/images/avatars/Avatar.jpg';
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
        $shipping_address_default = DB::select(
            'select unit_number as unit, street_number as street, address_line1 as address1,
                address_line2 as address2, city, region, country_name
            from addresses, user_addresses, countries
            where addresses.id = user_addresses.address_id 
                and addresses.country_id = countries.id
                and user_addresses.is_default = true
                and user_addresses.user_id = ?', [auth()->id()]);

        $billing_address_default = DB::select(
            'select value, provider, account_number as number
            from payment_types, user_payment_methods
            where payment_types.id = user_payment_methods.payment_type_id 
                and user_payment_methods.is_default = true
                and user_payment_methods.user_id = ?', [auth()->id()]);
                

        if (Auth::user() ?? null) {
            return view('users.manage', [
                'shipping' =>$shipping_address_default,
                'billing' =>$billing_address_default
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
        $request->validate(['email_address' => 'required|email|exists:users']);
        
        // tạo một token ngẫu nhiên có 10 kí tự
        $token = strtoupper(Str::random(10));
        // tìm user có địa chủ email như trên
        $user = User::where('email_address', $request->email_address)->first();
        // update remember_token cho user đó
        DB::update('update users set remember_token = ? where id= ?', [$token, $user->id]);

        Mail::send('emails.forgot-pass-send', compact('user','token'), function($email) use($user) {
            $email->subject('Zero Food - Lấy lại mật khẩu');
            $email->to($user->email_address, $user->name);
        });
        
        return redirect()->back()->with('message', 'Vui lòng check email để thay đổi mật khẩu');
    }

    //Reset Password
    public function resetPassword (User $user, $token) 
    {
        if($user->remember_token === $token)
        {
            return view('emails.forgot-pass-reset', ['user' => $user->id, 'token' => $token]);
        }
        else
        {
            return abort(404);
        }
    }

    public function postResetPassword(User $user, $token, Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|same:password'
        ]);
        
        $new_pass = bcrypt($request->password);
        DB::update('update users set password = ?, remember_token = NULL where id= ?', [$new_pass, $user->id]);

        return redirect('/login')->with('message','Đặt lại mật khẩu thành công, vui lòng đăng nhập lại!');
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
        // if this is first address of this user, it will be default
        $count_address = DB::table('user_addresses')
        ->where('user_id', auth()->id())
        ->count('*');
        
        if ($count_address == 0)
        {
            User_address::create([
                'user_id' => auth()->id(),
                'address_id' => $address->id,
                'is_default' => true
            ]);
        }
        else{
            User_address::create([
                'user_id' => auth()->id(),
                'address_id' => $address->id,
                'is_default' => false
            ]);
        }

       return redirect('/user/address')->with('message', "Thêm địa chỉ mới thành công!");
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

    public function changePasswordView()
    {
        return view('users.change-pass');
    }

    public function changePassword(Request $request)
    {
        // Kiểm tra xem người dùng có bỏ xót trường thông tin nào không
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'new_password_confirmation' => 'required|same:new_password'
        ]);
        
        // Kiểm tra mật khẩu cũ có đúng không
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("message", "Sai mật khẩu cũ!");
        }
        
        // Cập nhật mật khẩu mới cho người dùng
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("message", "Đổi mật khẩu thành công!");
    }

    public function changeInfoView()
    {
        return view('users.change_info');
    }

    public function changeInfo(Request $request)
    {
        $request->validate([
            'avatar' => 'nullable|image',
            'name' => ['required', 'min:3'],
            'email_address' => ['required', 'email'],
            'phone_number' => ['required', 'min:10', 'max:11'],
            'password' => 'required|min:6',
        ]);

        // Kiểm tra mật khẩu cũ có đúng không
        if(!Hash::check($request->password, auth()->user()->password)){
            return back()->with("message", "Sai mật khẩu!");
        }

        // nếu email không phải là email cũ
        if ($request->email_address != auth()->user()->email_address)
        {
            //Kiểm tra xem email mới đã có trong CSDL chưa
            $emails = DB::select('select email_address from users');
            foreach($emails as $email)
                if($email->email_address == $request->email_address)
                    return back()->with("message", "Email này đã được sử dụng, vui lòng nhập lại!"); 
        }

        // nếu số điện thoại nhập vào không phải là số cũ
        if ($request->phone_number != auth()->user()->phone_number)
        {
            //Kiểm tra xem SĐT mới có trong CSDL chưa
            $phones = DB::select('select phone_number from users');
            foreach($phones as $phone)
                if($phone->phone_number == $request->phone_number)
                    return back()->with("message", "Số điện thoại này đã được sử dụng, vui lòng nhập lại!"); 
        }
        
        // Cập nhật tên mới cho người dùng
        User::whereId(auth()->user()->id)->update([
            'name' => $request->name
        ]);
        
        // Cập nhật email mới cho người dùng
        User::whereId(auth()->user()->id)->update([
            'email_address' => $request->email_address
        ]);
        
        // Cập nhật số điện thoại mới cho người dùng
        User::whereId(auth()->user()->id)->update([
            'phone_number' => $request->phone_number
        ]);
        
        // Upload avatar
        if($request->hasFile('avatar')){
            // nếu trong /assets/images/avatars đã có file avatar của người dùng thì xóa nó đi
            if(file_exists(public_path().'/assets/images/avatars/'.Auth::user()->avatar) )
            {
                File::delete(public_path().'/assets/images/avatars/'.Auth::user()->avatar);
            }

            //lưu avatar mới sang assets/images/avatars
            $filename = auth()->user()->id. '_'. $request->avatar->getClientOriginalName();
            $request->avatar->move('assets/images/avatars', $filename );

            // cập nhật lại avatar của người dùng
            Auth()->user()->update(['avatar'=>$filename]);
        }

        return back()->with("message", "Cập nhật thông tin thành công!");   
    }

    public function paymentMethodView()
    {
        $payment_method = DB::table('user_payment_methods')
        ->where('users.id', auth()->id())
        ->join('users', 'users.id', '=' ,'user_payment_methods.user_id')
        ->join('payment_types', 'payment_types.id', '=', 'user_payment_methods.payment_type_id')
        ->select('user_payment_methods.id as id', 'value', 'provider', 'account_number', 'expiry_date', 'is_default')
        ->get();

        return view('users.payment_method', [
            'payments' => $payment_method
        ]);
    }

    public function savePaymentMethod(Request $request)
    {
        //những payment được check thì sẽ bị xóa, nếu không payment nào bị xóa thì bỏ qua
        if($request->delete)
        {
            foreach($request->delete as $delete_id)
            {
                DB::delete('delete from user_payment_methods where id = ?', [$delete_id]);
            }
        }

        //payment được check mặc định thì sẽ được cập nhật là is_default=true
        //các payment khác sẽ là is_default=false

        if ($request->defaultPayment)
        {
            DB::update('update user_payment_methods set is_default=false where id != ?', [$request->defaultPayment]);
            DB::update('update user_payment_methods set is_default=true where id = ?', [$request->defaultPayment]);
        }

        return UserController::paymentMethodView();
    }

    public function addPaymentMethodView()
    {
        return view('users.add-new-payment-method');
    }

    public function addPaymentMethod(Request $request)
    {
        $formFields = $request->validate([
            'user_id' => ['required'],
            'payment_type_id' => ['required'],
            'provider' => ['required'],
            'account_number' => ['required'],
            // 'expiry_date' => ['nullable'],
        ]);
        
        // nếu đây là phương thức thanh toán đầu tiên thì nó sẽ là mặc định
        $count_payment = DB::table('user_payment_methods')
        ->where('user_id', $request->user_id)
        ->count('*');

        if ($count_payment == 0)
        {
            User_payment_method::create([
                'user_id' => $request->user_id,
                'payment_type_id' => $request->payment_type_id,
                'provider' => $request->provider,
                'account_number' => $request->account_number,
                'is_default' => true
            ]);
        }
        else
        {
            User_payment_method::create($formFields);
        }

       return redirect('/user/PaymentMethod')->with('message', "Thêm phương thức thanh toán mới thành công!");
    }

    public function reviewView()
    {
        $reviews = DB::table('user_reviews')
        ->where('user_reviews.user_id', auth()->id())
        ->join('users', 'users.id', '=' ,'user_reviews.user_id')
        ->join('order_lines', 'order_lines.id', '=', 'user_reviews.ordered_product_id')
        ->join('product_items', 'product_items.id', '=', 'order_lines.product_item_id')
        ->join('products', 'products.id', '=', 'product_items.product_id')
        ->join('product_configurations', 'product_items.id', '=', 'product_configurations.product_item_id')
        ->join('variation_options', 'variation_options.id', '=', 'product_configurations.variation_option_id')
        ->join('variations', 'variation_options.variation_id', '=', 'variations.id')
        ->select(
            'user_reviews.id as review_id',
            'ordered_product_id',
            'user_reviews.rating_value as rate',
            'user_reviews.comment as comment',
            'order_lines.product_item_id as id', 
            'products.id as product_id',
            'products.name as product_name', 
            'products.product_image', 
            'product_items.price', 
            'variation_options.value as variation_value'
            )
        ->get();

        return view('users.review',[
            'reviews' =>$reviews,
        ]);
    }
}
