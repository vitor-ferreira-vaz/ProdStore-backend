<?php

namespace App\Services;


use App\DTO\AuthDTO;
use App\DTO\ResetPasswordDTO;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthService
{
    public function __construct(protected UserRepositoryInterface $repository)
    {
    }

    public function login(AuthDTO $login): array
    {
        if (!Hash::check($login->password, $this->repository->fromEmail($login->email)->password)) {
            return ['status' => '500', 'token' => '', 'message' => 'Senha incorreta!', 'user' => ''];
        }
        $token = '';
        try {
            $user = $this->repository->fromEmail($login->email);
            $token_name = $user->name . "_" . Carbon::now()->format('Y-m-d') . "_token";
            $token = $user->createToken($token_name);
        } catch (\Exception $e) {
            return ['status' => '500', 'token' => '', 'message' => $e->getMessage(), 'user' => ''];
        }
        return ['status' => '201', 'token' => $token->plainTextToken, 'message' => 'Login efetuado!'];
    }

    public function logout(Request $request): array
    {
        try {
            $request->user()->currentAccessToken()->delete();
        } catch (\Exception $e) {
            return ['status' => 401, 'message' => 'Erro ao logar: ' . $e->getMessage()];
        }

        return ['status' => 200, 'message' => 'Logout Efetuado!'];
    }

    public function sendEmailResetPassword(): array
    {
        try {
            /* O token será enviado para o front-end para ser inserido no local storage */
            $send = Password::sendResetLink(['email' => Auth::user()->email]);
            return ['status' => 200, 'message' => 'E-mail de alteração de senha enviado!', 'sent' => $send, 'email' =>Auth::user()->email];

        } catch (\Exception $e) {
            return ['status' => 401, 'message' => 'Erro ao enviar E-mail: ' . $e->getMessage()];
        }
    }

    public function resetPassword(ResetPasswordDTO $credencials): array
    {
        $user = Auth::user();
        /*
         * Já foi validado no formRequest
         */
        try {
            $status = Password::reset(
                [
                    'email' => $user->email,
                    'password' => $credencials->password,
                    'password_confirmation' => $credencials->password,
                    'token' => $credencials->token
                ],
                function (User $user, string $password) {
                    $user->forceFill(['password' => Hash::make($password)])->setRememberToken(Str::random(60));
                    $user->save();
                    event(new PasswordReset($user));
                }
            );
            return [
                'status' => $status === Password::PasswordReset ? 200 : 500,
                'message' => $status === Password::PasswordReset ? 'Senha alterada!' : 'Erro ao alterar senha!'
            ];
        } catch (\Exception $e) {
            return ['status' => 401, 'message' => 'Erro ao mudar a senha: ' . $e->getMessage()];
        }
    }
}
