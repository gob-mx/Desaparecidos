<?php

namespace App\Models\Gfsiniestros;
use Illuminate\Database\Eloquent\Model;
use LiveControl\EloquentDataTable\DataTable as DT;
use LiveControl\EloquentDataTable\ExpressionWithName;
use Helpme;
use DB;

class Wizard extends Model
{
  protected $table = 'As_wizard';
  protected $primaryKey = 'id_wizard';
  public $timestamps = false;


  static function getAll(){
    return Wizard::all();
  }
}
