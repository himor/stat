<?php

class Tokens extends Eloquent {

    protected $table = 'tokens';

    protected $guarded = ['id'];

    /**
     * Related user
     */
    public function user()
    {
        return $this->belongsTo('User');
    }

    /**
     * Generate new token
     *
     * @param string $string
     *
     * @return mixed
     */
    public function generateToken($string = '')
    {
        return Hash::make(md5($string) . md5(microtime()));
    }

}