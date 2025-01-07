<?php
namespace App\Models\ViewModels;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TransportationView extends BaseModel
{
    // use HasUuids;

    protected $table        = "v_transportasis";
    protected $primaryKey   = "id";

    protected $fillable     = [];
}
