<?php
namespace App\Models\ViewModels;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PassengerView extends BaseModel
{
    // use HasUuids;

    protected $table        = "v_penumpang";
    protected $primaryKey   = "id";

    protected $fillable     = [];
}
