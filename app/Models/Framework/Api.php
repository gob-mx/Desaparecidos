<?php
namespace App\Models\Framework;
use Illuminate\Database\Eloquent\Model;
use Helpme;
use DB;

class Api extends Model
{
  protected $table = 'fa_api';
  protected $primaryKey = 'id_api';
  public $timestamps = false;


  static function getSecret($consumer_pass, $consumer_key){

        $result = Api::where('consumer_pass', '=', $consumer_pass)
              ->where('consumer_key', '=', $consumer_key)
              ->select('consumer_secret')
              ->get();

        $array = array();

        if(count($result)>=1){
          foreach ($result as $row) {
            return $row->consumer_secret;
          }
        }
  }

}
