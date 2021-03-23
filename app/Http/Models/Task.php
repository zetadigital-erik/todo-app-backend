<?php
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
    protected $primaryKey='id';
    public $timestamps = true;
    protected $guarded=[];

    public function toDescription()
    {
        return "$this->category:$this->scope:$this->field";
    }
}
