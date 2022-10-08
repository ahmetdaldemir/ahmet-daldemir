<?php namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = ['error'];

    public static function create($data)
    {
        \Illuminate\Support\Facades\Log::info($data);
    }
}
