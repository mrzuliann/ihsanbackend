<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\User;
use App\Models\School;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nip' => 'required|numeric|min:2',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $user = User::create([
            'nip' => $request->nip,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
         ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['data' => $user,'access_token' => $token, 'token_type' => 'Bearer', ]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::with('school.presensihourday')
            ->where('email', $request['email'])
            ->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;
        $user->token = $token;
        $user->token_type = 'Bearer';

        $presensihourdayValue = null;
    if ($user->school && $user->school->presensihourday) {
        $presensihourdayValue = $user->school->presensihourday->map(function ($presensihourday) {
            return [
                'phd_id' => $presensihourday->phd_id,
                'ph_id' => $presensihourday->ph_id,
                'school_id' => $presensihourday->school_id,
                'shift_id' => $presensihourday->shift_id,
                'ph_day' => $presensihourday->ph_day,
                'ph_time_start' => $presensihourday->ph_time_start,
                'ph_time_end' => $presensihourday->ph_time_end,
                'shift_name' => $presensihourday->shift->shift_name,
                'presensihour_name' => $presensihourday->presensihour->ph_name,
            ];
        })->toArray();
    }

        $responseData = $user->toArray();
        $responseData['presensihourday'] = $presensihourdayValue;

        return response()->json([
            'success' => true,
            'message' => 'Hi '.$user->name.', selamat datang di sistem presensi',
            'data' => $responseData
        ]);
    }



    // method for user logout and delete token
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }
}
