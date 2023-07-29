<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Sign Up process
    public function signup(SignupRequest $request)
    {
        // Get validated data
        $data = $request->validated();

        // Check user type
        if($data['type'] == 0){ // Fizikakan andz
            /** @var \App\Models\User $user */
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'type' => $data['type'],
                'password' => bcrypt($data['password']),
            ]);
        }else{ // Iravabanak andz
            // Check has request image or not
            if ($request->hasFile('img')) { // Has a image
                // Get image file
                $image = $request->file('img');
    
                // Make image new name
                $filename = rand(1,1000).'_'. date('YmdHis') . '_' . time() . '.' . $image->getClientOriginalExtension();

                // Get path
                $image_path = 'assets/images/users/' . $filename;

                // Save the image to a specific path
                $image->save($image_path);
            }
            
            /** @var \App\Models\User $user */
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'type' => $data['type'],
                'address' => $data['address'],
                'logo' => $filename,
                'hvhh' => $data['hvhh'],
                'password' => bcrypt($data['password']),
            ]);
        }

        // Make user access token
        $token = $user->createToken('main')->plainTextToken;
        
        // Return success response
        return response(compact('user', 'token'));
    }

    public function login(LoginRequest $request)
    {
        // Get validated data
        $credentials = $request->validated();
        
        // Checek login and password correcting
        if (!Auth::attempt($credentials)) {
            // Error response
            return response([
                'message' => 'Provided email or password is incorrect'
            ], 422);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Make user access token
        $token = $user->createToken('main')->plainTextToken;

        // Return success response
        return response(compact('user', 'token'));
    }

    // Logout process
    public function logout(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();
        
        // Destroy user access token
        $user->currentAccessToken()->delete();
        
        // Return response
        return response('', 204);
    }
}