<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function login(Request $request) {

        try {

            $auth_data = $request->validate([
                'email' => 'required|string',
                'password' => 'required',
            ]);

            if (! Auth::attempt($auth_data)) {
                return [
                    'status' => false,
                    'response' => 'Invalid Username or Password',
                ];    
            }
            
            $user = AdminUser::where('email', $auth_data['email'])->first();
            $token = JWTAuth::fromUser($user);
            
            return response()->json([
                'status' => true,
                'user' => $user,
                'token' => $user->createToken('api_token')->plainTextToken,
                // 'auhorization' => [
                //     'token' => $user->createToken('api_token')->plainTextToken,
                //     'type' => 'Bearer'
                // ]
            ]);

        } catch (Exception $e) {

            Log::channel('info')->info(json_encode($e->getMessage()));
            DB::rollBack();
            
            return ['status' => false];
            
        }
    }
    public function logout() {
        try {
            JWTAuth::getToken();
            JWTAuth::invalidate( true );
            return response()->json(['status' => true]);
        } catch (JWTException $e) {
            Log::channel('info')->info(json_encode($e->getMessage()));
            return response()->json(['error' => 'Failed to logout, please try again'], 500);
        }

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function register(Request $request) {
        DB::beginTransaction();
        
        try {
            
            if($request->Password !== $request->ConfirmPassword) {
                return [
                    'status' => false,
                    'response' => 'Passwords did not match!'
                ];
            }

            $validated = validatorHelper()->validate('registration', $request);

            if (! $validated['status']) {
                return $validated['validated'];
            }
            
            $user = AdminUser::create($validated['validated']);
            
            DB::commit();

            return response()->json($user);
            // return $validated['validated'];          
            return [
                'status' => true,
                'response' => $user,
            ];
            
        } catch(QueryException $qe) {
            Log::channel('info')->info("Exception : ".$qe->getMessage());
            $errorCode = $qe->errorInfo[1];
            if($errorCode == 1062){
                return [
                    'status' => false,
                    'response' => 'Email already in use!',
                ];
            }
            
            // throw new GlobalException();
            
        } catch (Exception $e) {

            Log::channel('info')->info(json_encode($e->getMessage()));
            DB::rollBack();
            
            return ['status' => false];
            
        }
    }
}