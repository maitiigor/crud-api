<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AssetAssignment extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'asset_id',
        'assignment_date',
        'status',
        'is_due',
        'due_date',
        'assigned_user_id',
        'assigned_by'
    ];


   public function user(){
       return $this->belongsTo(User::class,'assigned_by','id');
   }
   public function vendor(){
       return $this->belongsTo(Vendor::class,'assigned_user_id','id');
   }
   public function asset(){
       return $this->belongsTo(Asset::class);
   }
}
