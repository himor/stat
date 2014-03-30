<?php

class Tokens extends Eloquent {

    protected $table = 'tokens';

    /**
     * Related user
     */
    public function user()
    {
        return $this->belongsTo('User');
    }

}