<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsersRequest extends FormRequest
{
    private mixed $id;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //cấp quyền truy cập khi sử dụng formRequest
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        // đây là nơi viết validate
        $rules = [];
        $currentAction = $this->route()->getActionMethod();
        switch ($this->method()):
            case 'POST':
                switch ($currentAction) {
                    case 'add':
                        $rules = [
                            "name" => "required|max:100",
                            "email" => "required|unique:users,email",
                            "password" => "required",
                            "phoneNumber" => "required|min:10|unique:users,phoneNumber",
                            "role_id" => "required"
                        ];
                        break;
                    default:
                        break;
                }
                switch ($currentAction) {
                    case 'update':
                        $rules = [
                            "name" => "required|max:100",
                            "email" => "required|unique:users,email," .request()->id,
                            "password" => "required",
                            "phoneNumber" => "required|min:10|unique:users,phoneNumber," .request()->id,
                            "role_id" => "required"
                        ];
                        break;
                    default:
                        break;
                }
                break;
        endswitch;
        return $rules;
    }
    public function messages()
    {
        return [
            'name.required' => "Tên không được để trống",
            'name.max' => "Tên không dài quá 100 ký tự",

            'email.required' => 'Email không được để trống',
            'email.unique' => 'Email đã được sử dụng',

            'password.required' => "Mật khẩu không được để trống",

            'phoneNumber.required' => "Điện thoại không được để trống",
            'phoneNumber.min' => "Điện thoại phải có 10 số",
            'phoneNumber.unique' => "Điện thoại đã được sử dụng",

            'role_id.required' => "Chọn phân quyền",

        ];
    }
}
