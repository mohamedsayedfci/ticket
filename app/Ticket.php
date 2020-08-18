<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Ticket extends Model
{

    use Notifiable;
    protected $fillable = [
        'user_id', 'ticket_by', 'date', 'deadline','ticket_price','active'
    ];

    use \Dimsav\Translatable\Translatable;

    protected $guarded = [];
    public $translatedAttributes = ['name'];
    public $table="tickets";

    public function getActive(){
        return   $this -> active == 1 ? 'مفعل'  : 'غير مفعل';
    }
    public function user1()
    {
        return $this->belongsTo('App\User','user_id','id');

    }



}//end of model
