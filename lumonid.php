<?php

class Lumonid {
    
    private $pool;
    
    public function __construct() {
        $this->pool = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_.";
    }
    
    public function generate() {
        $res = "";
        $sum = 0;
        for ($i = 30; $i >= 0; $i--) {
            $random  = random_int(0, 63);
            $product = ($i % 2 === 0 ? 2 : 1) * $random;
            $sum    += floor($product / 64) + ($product % 64);
            $res     = substr($this->pool, $random, 1) . $res;
        }
        $index = (64 - ($sum % 64)) % 64;
        return $res . substr($this->pool, $index, 1);
    }
    
    public function validate($id = "") {
        if (preg_match('/^[a-zA-Z0-9_\.]{32}$/', $id) !== 1) {
        	return false;
        }
        
        $sum = 0;
        for ($i = strlen($id)-1; $i >= 0; $i--) {
            $product = ($i % 2 === 0 ? 2 : 1) * strpos($this->pool, substr($id, $i, 1));
            $sum    += floor($product / 64) + ($product % 64);
        }
        return $sum % 64 === 0;
    }
}
