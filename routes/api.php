<?php

use Illuminate\Http\Request;
use App\Stack;
use App\User;
use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Lcobucci\JWT\Parser;

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
Route::get('getStackByName/{user}/{name}', function($user, $name){
    try { 
        $stack = Stack::whereOwner($user)->whereName($name)->get();
        return response()->json($stack);
    } catch (\Exception $e) {
        return $e->getMessage();  
    }

});

Route::get('getStackByUser/{username}', function($username){

    try {
        $stacks = Stack::whereOwner($username)->get();
        return response()->json($stacks);
    } catch (\Exception $e){
        return $e->getMessage();
    }
});

Route::get('getStackById/{stackId}', function($stackId){
    try {
        $stack = Stack::find($stackId);
        return response()->json($stack);
    } catch (\Exception $e) {
        return $e->getMessage();
    } 
});

Route::post('deleteStack', function(Request $request){
    $user = $request->input('username');
    $id = $request->input('id');
    try {
        $stack = Stack::find($id);
        $stack->delete();
        return "record deleted";
    } catch (\Exception $e) {
        return $e->getMessage();
    } 
});
Route::post('updateStack', function(Request $request){
    try {
        $id = $request->input('id');
        $stack = Stack::find($id);
        $stack->goal = ($request->input('goal') == null ? $stack->goal : $request->input('goal'));
        $stack->balance = ($request->input('balance') == null ? $stack->balance : $request->input('balance'));
        $stack->name = ($request->input('name') == null ? $stack->name : $request->input('name'));
        $stack->save();
        return "record updated";
    } catch (\Exception $e) {
        return $e->getMessage();
    }    
});

function isAuthenticated(Request $request) {


}
Route::post('createStack', function(Request $request){
    $stack = new Stack();
    $stack->name = $request->input('name');
    $stack->owner = $request->input('owner');
    $stack->goal = $request->input('goal');
    $stack->balance = $request->input('balance');
    try {
        
        $stack->save();
        return 'record has saved';
    } catch (\Exception $e) {
        return $e->getMessage();
    }
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('db', function(){

    $stacks = Stack::all();
    return response()->json($stacks);

});

Route::post('identity', function(Request $request){
    $identity = AWS::createClient('CognitoIdentity');
    try {
        $result = $identity->getId([
            'AccountId' => '361836631277',
            'IdentityPoolId' => 'us-east-2:13e58c5b-617c-4556-8142-c714e6f3c8b4',
            'Logins' => [
                'cognito-idp.us-east-2.amazonaws.com/us-east-2_sHEbFJg3q' => $request->input('token'),
            ],
        ]);
        return $result;
    } catch (\Exception $e) { 
        return $e->getMessage();
    }
});

Route::post('getUserRole', function(Request $request){
   $cognito = AWS::createClient('CognitoIdentityProvider');

    try {
        $result = $cognito->adminInitiateAuth([
            'AuthFlow' => 'ADMIN_NO_SRP_AUTH',
            'ClientId' => '12ar5vo4epr8md7dm38h7jass7',
            'UserPoolId' => 'us-east-2_sHEbFJg3q',
            'AuthParameters' => [
                 'USERNAME' => $request->input('username'),
                 'PASSWORD' => $request->input('password'),
            ],
        ]);
    } catch (\Exception $e) {
        return $e->getMessage();
    }
    $authResult = $result->get('AuthenticationResult');
    $idToken = $authResult['IdToken'];
    $parser = new Parser();
    $token = $parser->parse((string) $idToken);
    return $token->getClaims()['cognito:preferred_role'];
 
});

Route::post('authenticate', function(Request $request){

    $cognito = AWS::createClient('CognitoIdentityProvider');
    try {
        $result = $cognito->adminInitiateAuth([
            'AuthFlow' => 'ADMIN_NO_SRP_AUTH',
            'ClientId' => '12ar5vo4epr8md7dm38h7jass7',
            'UserPoolId' => 'us-east-2_sHEbFJg3q',
            'AuthParameters' => [
                 'USERNAME' => $request->input('username'),
                 'PASSWORD' => $request->input('password'),
            ],
        ]);
    } catch (\Exception $e) {
        return $e->getMessage();
    }
    $authResult = $result->get('AuthenticationResult');  
    return $authResult;

});

Route::post('isAuthenticated', function(Request $request){
    $cognito = AWS::createClient('CognitoIdentityProvider');
    try {
        $user = $cognito->getUser([
            'AccessToken' => $request->input('accessToken')
        ]);
        $username = $user['Username'];
        $isAuth = $request->input('username') == $username;
        //return response()->json(['isAuth' => $isAuth, 'username' => $username, 'user' => $user]);
        return $user;
    } catch (\Exception $e){
        $error = $e->getMessage();
        return response()->json(['result' => 'incorrect accessToken']);
    }
});
Route::get('resend-confirm\{username}', function($username){
    $cognito = AWS::createClient('CognitoIdentityProvider');
    try {
        $result = $cognito->resendConfirmationCode([
            'ClientId' => '12ar5vo4epr8md7dm38h7jass7', // REQUIRED
            'Username' => $username, // REQUIRED
        ]);
        return $result;
    } catch (\Exception $e) {
        return $e->getMessage();
    }
});

Route::post('confirm-signup', function(Request $request){
    $cognito = AWS::createClient('CognitoIdentityProvider');
    try {
        $cognito->confirmSignUp([
            'ClientId' => '12ar5vo4epr8md7dm38h7jass7',
            'Username' => $request->input('username'),
            'ConfirmationCode' => $request->input('code'),
        ]);
    } catch (\Exception $e) {
        return $e->getMessage();
    }
    return response()->json(['status'=>'success']);
});

Route::post('signup', function(Request $request){
    $cognito = AWS::createClient('CognitoIdentityProvider');
    try {
        $result = $cognito->signUp([
            'ClientId' => '12ar5vo4epr8md7dm38h7jass7', // REQUIRED
            'Password' => $request->input('password'), // REQUIRED
            'UserAttributes' => [
                [
                    'Name' => 'email', // REQUIRED
                    'Value' => $request->input('email'),
                ], 
            ],
            'Username' => $request->input('username'), // REQUIRED
         ]);
    } catch (\Exception $e) {
        return $e->getMessage();
    }
    return response()->json(['status' => 'success', 'message' => 'please check your email to complete registration with confirmation code.']);     
});

Route::get('user', function(){

    $users = User::all();
    return response()->json($users);

});
/*
Route::get('s3', function(){
    $s3 = AWS::createClient('s3');
    // First
    $buckets = $s3->listBuckets();
    // Second
    $objs = $s3->listObjects([
        'Bucket' => 'stacker-s3-img' // REQUIRED
    ]);
    $objs = $objs['Contents'];
    // Third
    $object = $s3->getObjectUrl('stacker-s3-img','images/stackerapp.png');
  
    $cmd = $s3->getCommand('GetObject', [
        'Bucket' => 'stacker-s3-img',
        'Key'    => 'images/stackerapp.png'
    ]);

    $request = $s3->createPresignedRequest($cmd, '+20 minutes');

    $presignedUrl = (string) $request->getUri();
    return response()->json(['url' => $presignedUrl]);
});
*/

