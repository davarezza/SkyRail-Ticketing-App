<?php
namespace App\Models\ViewModels;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class BookingView extends BaseModel
{
    // use HasUuids;

    protected $table        = "v_booking";
    protected $primaryKey   = "id";

    protected $fillable     = [];
}
