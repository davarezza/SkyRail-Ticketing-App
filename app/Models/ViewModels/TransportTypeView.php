<?php
namespace App\Models\ViewModels;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class TransportTypeView extends BaseModel
{
    // use HasUuids;

    protected $table        = "v_type_transport";
    protected $primaryKey   = "id";

    protected $fillable     = [];
}
