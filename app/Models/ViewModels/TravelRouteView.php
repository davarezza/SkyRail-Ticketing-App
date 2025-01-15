<?php
namespace App\Models\ViewModels;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TravelRouteView extends BaseModel
{
    // use HasUuids;

    protected $table        = "v_travel_route";
    protected $primaryKey   = "id";

    protected $fillable     = [];
}
