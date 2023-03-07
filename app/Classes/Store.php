<?php 
namespace App\Classes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

Class Store {

    public static function criarHash($caracteres = 20) {
        $chars = "0123456789abcdefghijkmlnopqrstuvwyxzabcdefghijkmlnopqrstuvwyxzABCDEFGHIJKMLNOPQRSTUVWYXZABCDEFGHIJKMLNOPQRSTUVWYXZ";
        return substr(str_shuffle($chars) ,0, $caracteres);
    }
}