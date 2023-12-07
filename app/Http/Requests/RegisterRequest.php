<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'display_name' => 'required|string|max:250',
            'username'=>[
                'required',
                'min:6',
                'unique:users',
                'regex:/^[a-zA-Z][a-zA-Z0-9._]*$/'
            ],
            'password'=>[
                'required',
                'string',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
                'confirmed'
            ],
            'email' => [
                'required',
                'string',
                'regex:/^(?![0-9])([a-zA-Z0-9_.-]+)@([a-zA-Z0-9_-]+)\.([a-zA-Z]{2,5})$/',
                'unique:users'
            ]
        ];
    }
    public function messages()
    {
        return [
            'display_name.required' => 'Vui lòng nhập tên hiển thị.',
            'display_name.max' => 'Tên hiển thị không được vượt quá 250 ký tự.',
            'username.required' => 'Vui lòng nhập tên người dùng.',
            'username.min' => 'Tên người dùng phải có ít nhất 6 ký tự.',
            'username.unique' => 'Tên người dùng đã tồn tại.',
            'username.regex' => 'Tên người dùng chỉ được chứa chữ cái, số, dấu chấm và dấu gạch dưới và phải bắt đầu bằng một chữ cái.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.regex' => 'Mật khẩu phải chứa ít nhất một chữ hoa, một chữ thường, một số và một ký tự đặc biệt.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'email.required' => 'Vui lòng nhập email.',
            'email.regex' => 'Email bắt buộc phải có @ và không bắt đầu bằng một chữ số.',
            'email.unique' => 'Email này đã được sử dụng, vui lòng chọn email khác.'
        ];
    }

}
