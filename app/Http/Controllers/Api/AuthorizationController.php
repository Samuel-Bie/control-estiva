<?php
namespace App\Http\Controllers\Api;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response as HttpStatusCode;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthorizationController extends Controller
{
    public function token(Request $request)
    {
        $request->validate([
            'email'          => 'required|string',
            'password'        => 'required|string',
            'application'   => 'nullable|string',
        ]);

        $user = User::whereEmail($request->input('email'))
        ->first();

        if ($user && Hash::check($request->input('password'), $user?->password)) {
            return response()->json([
                'token' => $user->createToken($request->input('application', 'spa'))->plainTextToken
            ], HttpStatusCode::HTTP_OK);
        }
        throw new UnauthorizedHttpException('Invalid login credentials.', "Invalid login credentials.");
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Successfully logged out.'
        ], HttpStatusCode::HTTP_NO_CONTENT);
    }

    public function whoami(Request $request)
    {
        return response()->json([
            'user' => $request->user()
        ], HttpStatusCode::HTTP_OK);
    }
}
