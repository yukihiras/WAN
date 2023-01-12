<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Users extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = [
        'users.id',
        'users.name',
        'users.email',
        'users.phoneNumber',
        'users.password',
        'users.image',
        'roles.name as roleName',
        'users.created_at'
    ];
    public function loadList()
    {
        $query = DB::table($this->table)
            ->select($this->fillable)
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->orderBy('created_at', 'DESC');
        $list = $query->paginate(5); //mỗi trang hiển thị 5 bản ghi
        return $list;
    }

    public function saveNew($params)
    {
        $data = array_merge(
            $params['cols'],
            [
                'password' => Hash::make($params['cols']['password']),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );
        $res = DB::table($this->table)->insertGetId($data);
        return $res;
    }


    //load ra chi tiết người dùng
    public function loadOne($id, $params = [])
    {
        $query = DB::table($this->table)
            ->select($this->fillable)
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->where('users.id', '=', $id);
        $obj = $query->first();
        return $obj;
    }
    public function saveUpdate($params)
    {
        if (empty($params['cols']['id'])) {
            Session::push('errors', "không xác định bản ghi cập nhật");
        }

        $dataUpdate = [];
        foreach ($params['cols'] as $colName => $val) {
            if ($colName == 'id') continue;
            $dataUpdate[$colName] = (strlen($val) == 0) ? null : $val;
        }

        $res =  DB::table($this->table)->where('id', $params['cols']['id'])->update($dataUpdate);
        return $res;
    }

}
