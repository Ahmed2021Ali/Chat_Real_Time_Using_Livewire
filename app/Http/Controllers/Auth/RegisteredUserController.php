<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Jobs\SendMail;
use Illuminate\View\View;
use App\Http\traits\media;
use App\Events\RegisterEven;
use Illuminate\Http\Request;
use App\Jobs\SendMailsForUsers;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    use media;
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $photoPath = $request->image->store('user_chat', 'public');

        $user = new User;
        $user->name =$request->name;
        $user->email =$request->email;
        $user->password =Hash::make($request->password);
        $user->image =$photoPath;
        $user->save();

        event(new Registered($user));


        User::where('email',$user->email)->chunk(20,function($data){
            dispatch(new SendMail($data));
        });

/*         User::where('email' ,'!=', $user->email)->chunk(20,function($data){
            dispatch (new SendMailsForUsers($data));
        }); */



        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }
}
