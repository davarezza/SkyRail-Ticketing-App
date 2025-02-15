<?php
namespace App\Models\ViewModels;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class BookingPassengerView extends BaseModel
{
    // use HasUuids;

    protected $table        = "v_booking_passenger";
    protected $primaryKey   = "id";

    protected $fillable     = [];
}
