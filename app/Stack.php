<?php


namespace App;
use Illuminate\Database\Eloquent\Model;

class Stack extends Model {

    protected $fillable = array('name', 'owner', 'goal', 'balance');


    protected $table = 'stacks';
}
