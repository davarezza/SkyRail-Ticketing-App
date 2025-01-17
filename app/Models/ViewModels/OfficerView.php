<?php
namespace App\Models\ViewModels;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class OfficerView extends BaseModel
{
    // use HasUuids;

    protected $table        = "v_officer";
    protected $primaryKey   = "id";

    protected $fillable     = [];
}
