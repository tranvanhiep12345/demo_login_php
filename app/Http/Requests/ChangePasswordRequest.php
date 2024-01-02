<?php

namespace App\Http\Requests;

use App\Repository\Eloquent\BlacklistPasswordRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'old_password'=>[
                'required',
                'string',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'
            ],
            'password'=>[
                'required',
                'string',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
                'confirmed',
                'unique:blacklist_passwords,blacklist_password'
            ]
        ];
    }
    public function messages()
    {
        return [
            'old_password.required' => 'Vui lòng nhập mật khẩu cũ.',
            'old_password.regex' => 'Mật khẩu phải chứa ít nhất một chữ hoa, một chữ thường, một số và một ký tự đặc biệt.',
            'password.required' => 'Vui lòng nhập mật khẩu  mới.',
            'password.regex' => 'Mật khẩu mới phải chứa ít nhất một chữ hoa, một chữ thường, một số và một ký tự đặc biệt.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'password.unique' => 'Mật khẩu mới bạn nhập vào chứa thông tin nhạy cảm và không được chấp nhận. Vui lòng chọn một mật khẩu khác.'
        ];
    }
}
