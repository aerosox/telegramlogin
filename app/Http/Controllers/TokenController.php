<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\App;
use App\Token;

class TokenController extends Controller
{
    public function generateToken($clientId)
    {
        $app = App::findByClientId($clientId);

        $token = $this->createToken($app);

        return redirect('https://telegram.me/'.env('BOT_NAME').'?start='.$token->token);
    }

    private function createToken($app) {
        //try {
            $randToken = generate_token();
            return Token::create(array(
                'app_id' => $app->id,
                'token' => $randToken
            ));
        //} catch(\Exception $e) {
        //    return $this->createToken($app);
        //}
    }
}
