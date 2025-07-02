<?php

namespace App\Http\Controllers;

use App\Mail\MailTest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use function Symfony\Component\String\s;


class UserController extends Controller
{
    public function Login(Request $request)
    {
        try {
            $user = User::where('email', 'vitorvaz001@gmail.com')->first();
            $user_validatidion = Auth::attempt(['email' => 'vitorvaz001@gmail.com', 'password' => '123456']);
            if ($user_validatidion) {
                $token = $user->createToken('token_random_name');
                $test = bcrypt('123456');
                return response()->json(
                    ['report_type' => 'success', 'success' => true, 'message' => "Login concluído! $test"], 200)
                    ->header('Authorization', "Bearer $token->plainTextToken");
            }
        }catch (\Exception $e){
            return response()->json(['report_type' => 'failure', 'success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function Logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['report_type' => 'success', 'success' => true, 'message' => "Logout realizado com sucesso!"]);
    }


    public function CheckUser(Request $request)
    {
        return response()->json(['report_type' => 'success', 'success' => true, 'message' => $request->all()], 200);
    }

    public function SendEmailResetPassword()
    {
        $status = Password::sendResetLink(['email' => 'vitorvaz001@gmail.com']);
        $user = User::where('email', 'vitorvaz001@gmail.com')->first();
        dd(phpinfo());
    }


    public function ResetPassword($token, Request $request)
    {
        $status = Password::reset(
            ['email' => 'vitorvaz001@gmail.com',
                'password' => '12345678', 'password_confirmation' => '12345678',
                'token'=> $token],

            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );
        dd($status,  Password::PasswordReset, $status === Password::PasswordReset);

        return response()->json(['report_type' => 'success', 'success' => true, 'message' => $status], 200);
    }
}
