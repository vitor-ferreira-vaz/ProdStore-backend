<?php

namespace App\Http\Controllers;

use App\DTO\AuthDTO;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\SendEmailResetPasswordRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use function Termwind\renderUsing;


class AuthController extends Controller
{
    public function __construct(protected AuthService $authService)
    {

    }
    public function Login(AuthRequest $request)
    {
        $dto = AuthDTO::fromArray($request->all());
        $login = $this->authService->Login($dto);
        return response()->json(['message' => $login['message'], $login['status']])
            ->header('Authorization', "Bearer " . $login['token']);

    }

    public function Logout(Request $request): JsonResponse
    {/* return response()->json(['test'=> 612]);*/
        $logout = $this->authService->Logout($request);
        return response()->json(['message' => $logout['message'], 'teste' => Auth::user()->id], $logout['status']);
    }

    public function sendEmailResetPassword(): JsonResponse
    {/* return response()->json(['id'=> Auth::user()]);*/
        $send = $this->authService->sendEmailResetPassword();
        return response()->json(['message' => $send['message'], 'sent' => $send['sent'], 'email' => $send['email']], $send['status']);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
       $status = $this->authService->resetPassword($request->all());
    }
}
