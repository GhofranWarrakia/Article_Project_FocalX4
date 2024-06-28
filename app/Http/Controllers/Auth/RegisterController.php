<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|unique:users|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:6|confirmed',
            'country' => 'required|string|max:255',
            'national_number' => ['required', 'string', 'unique:users', 'regex:/^0204\d{7}$/'],
          
        ],[
            'name.required' => 'يرجى ادخال اسم المستخدم',
            'name.unique' => 'المستخدم موجود مسبقا',
            'name.max' => 'لا يمكن ادخال اكثر من 255 حرف',
            'email.required' => 'يرجى ادخال الايميل',
            'email.unique' => 'الايميل موجود مسبقا',
            'email.email' => 'يرجى ادخال بريد إلكتروني صالح',
            'email.max' => 'لا يمكن ادخال اكثر من 255 حرف',
            'password.required' => 'يرجى ادخال كلمة المرور',
            'password.min' => 'يجب أن تكون كلمة المرور مكونة من 6 أحرف على الأقل',
            'password.confirmed' => 'تأكيد كلمة المرور لا يتطابق',
            'country.required' => 'يرجى ادخال الدولة',
            'country.max' => 'لا يمكن ادخال اكثر من 255 حرف',
            'national_number.required' => 'يرجى ادخال الرقم الوطني',
            'national_number.unique' => 'الرقم الوطني موجود مسبقا',
            'national_number.regex' => 'الرقم الوطني يجب أن يكون مكونا من 11 خانة ويبدأ بـ 0204',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'national_number' => $data['national_number'],
            'country' => $data['country'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        
        ]);
    }
}
