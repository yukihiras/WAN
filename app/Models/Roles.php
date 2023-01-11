<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Roles extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $fillable = ['id', 'name'];
    public function loadList($params = [])
    {
        $query = DB::table($this->table)
            ->select($this->fillable);
        // ->join('roles', 'roles.id', '=', 'users.role_id')
        // ->orderBy('created_at', 'DESC');
        $list = $query->get();
        return $list;
    }
}
