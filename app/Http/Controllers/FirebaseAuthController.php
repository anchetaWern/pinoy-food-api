<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Auth;
use App\Models\User;
use Illuminate\Support\Str;

class FirebaseAuthController extends Controller
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function sync(Request $request)
    {
        $token = $request->input('token');

        try {
            $verifiedIdToken = $this->auth->verifyIdToken($token);
            $firebaseUserId = $verifiedIdToken->claims()->get('sub');
            $email = $verifiedIdToken->claims()->get('email');

            $firebaseUser = $this->auth->getUser($firebaseUserId);
            $displayName = $firebaseUser->displayName;

            $password = Str::password();

            $user = User::firstOrCreate(
                ['firebase_user_id' => $firebaseUserId],
                [
                    'firebase_user_id' => $firebaseUserId,
                    'email' => $email,
                    'name' => $displayName,
                    'password' => $password
                ],
            );

            return response()->json(['message' => 'User synced successfully', 'user' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token verification failed', 'message' => $e->getMessage()], 401);
        }
    }
}
