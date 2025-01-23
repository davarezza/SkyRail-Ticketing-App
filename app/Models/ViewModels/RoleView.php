<?php
namespace App\Models\ViewModels;

use App\Core\BaseModel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class RoleView extends BaseModel
{
    protected $table        = "v_role";
    protected $fillable     = [];
}