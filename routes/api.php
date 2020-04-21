<?php
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::post("/login","api\authapi@login");
Route::post("/signup","api\authapi@signup");


Route::get("/pickupline","api\pickupline@index");

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    $user =$request->user()->toArray();
    $roles=$request->user()->roles()->get();
    if($roles==null) return "false";
    $roles_t=[];
    foreach($roles as $role){
        array_push($roles_t,$role->role);
    }
    $user["roles"]=$roles_t;

    return $user;
});
Route::middleware('auth:sanctum')->get('/user/token', function (Request $request) {
    return $request->user()->tokens()->get();
});

Route::middleware('auth:sanctum')->post("/logout",function(Request $request){
     $request->user()->tokens()->delete();

     return response()->json([  "msg"=>"logout" ]);
});
/*


Route::middleware('auth:api1')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post("/signup1",function(Request $request){
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|string|email|unique:users',
        'password' => 'required|string|confirmed'
    ]);
    if(\App\FontUser::where("email",$request->email)->count()>0) return response()->json(["msg"=>"user already existed"]);
    if(\App\FontUser::where("name",$request->name)->count()>0) return response()->json(["msg"=>"user name already existed"]);
    $user = new \App\FontUser([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password)
    ]);
    $user->save();
    return response()->json([
        'message' => 'Successfully created user!'
    ], 201);
});

Route::post("/login1",function(Request $request){
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
        'remember_me' => 'boolean'
    ]);
    $credentials = request(['email', 'password']);
    $user = \App\FontUser::where('email', $request->email)->first();
   // if(!Auth::guard("api1")->attempt($credentials))
    if (! $user || ! Hash::check($request->password, $user->password))
        return response()->json([
            'message' => 'Unauthorized'
        ], 401);
    //$user = $request->user();
    $tokenResult = $user->createToken('Personal Access Token');
    $token = $tokenResult->token;
    //if ($request->remember_me)
        $token->expires_at = Carbon::now()->addWeeks(1);
    $token->save();
    return response()->json([
        'access_token' => $tokenResult->accessToken,
        'token_type' => 'Bearer',
        'expires_at' => Carbon::parse(
            $tokenResult->token->expires_at
        )->toDateTimeString()
    ]);
});

Route::post("/logout1",function(Request $request){
  
    $request->user()->token()->revoke();
    return response()->json([
        'message' => 'Successfully logged out'
    ]);
})->middleware('auth:api1');*/