<?php 
namespace Models;
 
use \Illuminate\Database\Eloquent\Model;
 
class Contacto extends Model {
     
    protected $table = 'contactos';
    protected $fillable = ['nombre','email','asunto','mensaje'];
     
}