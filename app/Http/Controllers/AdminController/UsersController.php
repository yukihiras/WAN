<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsersRequest;
use App\Models\Roles;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    private $v;
    public function __construct()
    {
        $this->v = [];
    }

    public function loadList(Request $request)
    {
        $users = new Users;
        $this->v['title'] = "Quản trị người dùng";
        $this->v['list'] = $users->loadList();
        return view('adminView.users.index',$this->v);


    }

    public function add(UsersRequest $request)
    {
        $method_route = "listUsersRoute";
        $this->v['title'] = "Thêm mới người dùng";

        $roles = new Roles();
        $this->v['listRoles'] = $roles->loadList();

        if ($request->isMethod('post')) {
            $params = [];
            $params['cols'] = $request->post();
            unset($params['cols']['_token']);

            //upload file
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $params['cols']['image'] = $this->uploadFile($request->file('image'));
            }

            $saveNewUsers = new Users();

            $res = $saveNewUsers->saveNew($params);
            if ($res == null) {
                return redirect()->route($method_route);
            } elseif ($res > 0) {
                Session::flash('success', 'thêm mới thành công người dùng');
                return redirect()->route($method_route);
            } else {
                Session::flash('error', 'lỗi thêm mới người dùng');
            }
        }
        return view('adminView.users.add', $this->v);
    }

    public function detail($id, Request $request)
    {
        $this->v['title'] = "Chỉnh sửa người dùng";
        $loadSingleUser = new Users();
        $objItem = $loadSingleUser->loadOne($id);
        $this->v['objItem'] = $objItem;

        $roles = new Roles();
        $this->v['listRoles'] = $roles->loadList();

        return view('adminView.users.detail', $this->v);
    }

    public function update($id, UsersRequest $request)
    {
        $method_route = 'listUsersRoute';


        $params = [];
        $params['cols'] = $request->post();
        $params['cols']['id'] = $id;
        unset($params['cols']['_token']);
        //upload file
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $params['cols']['image'] = $this->uploadFile($request->file('image'));
        }

        if (!is_null($params['cols']['password'])) {
            $params['cols']['password'] = Hash::make($params['cols']['password']);
        } else {
            unset($params['cols']['password']);
        }


        $saveUpdateUsers = new Users();
        $res = $saveUpdateUsers->saveUpdate($params);
        if ($res == null) {
            Session::flash('error', 'Lỗi cập nhật bản ghi');
            return redirect()->route($method_route, ['id' => $id]);
        } elseif ($res == 1) {
            Session::flash('success', 'Cập nhật bản ghi ' . $id . " thành công");
            return redirect()->route($method_route, ['id' => $id]);
        } else {
            Session::flash('error', 'Lỗi cập nhật bản ghi', $id);
            return redirect()->route($method_route, ['id' => $id]);
        }
    }

    public function uploadFile($file)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs('uploadWebImage', $fileName, 'public');
    }

    public function delete($id)
    {
        $method_route = 'listUsersRoute';
        //dd($id);
        $delete = Users::destroy($id);
        if (!$delete) {
            return redirect()->back();
        }
        return redirect()->route($method_route)->with('success', 'Xoá thành công ');;
    }
}
