<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
{
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
                            "name" => "required",
                            "email" => "required | unique:users",
                            "password" => "required",
                            "phoneNumber" => "required",
                            "role_id" => "required"
                        ];
                        break;
                    default:
                        break;
                }
                switch ($currentAction) {
                    case 'update':
                        $rules = [
                            "name" => "required",
                            "email" => "required",
                            "password" => "required",
                            "phoneNumber" => "required",
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
            'email.required' => 'Email không được để trống',
            'email.unique' => 'Email đã được sử dụng',
            'password.required' => "Mật khẩu không được để trống",
            'phoneNumber.required' => "Điện thoại không được để trống",
            'role_id.required' => "Chọn phân quyền",

        ];
    }
}
