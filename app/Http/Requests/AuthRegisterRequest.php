<?php

namespace App\Http\Requests;

use App\Rules\ValidUsername;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AuthRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:4',
                'max:20',
                new ValidUsername(),
            ],

            'email' => 'required|string|email:rfc,dns|max:255|unique:users,email',

            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
            ],

            'terms' => 'required|accepted',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên người dùng',
            'name.min' => 'Tên người dùng phải có ít nhất :min ký tự',
            'name.max' => 'Tên người dùng không được vượt quá :max ký tự',


            'email.required' => 'Vui lòng nhập địa chỉ email',
            'email.email' => 'Địa chỉ email không hợp lệ',
            'email.max' => 'Địa chỉ email không được vượt quá :max ký tự',
            'email.unique' => 'Địa chỉ email đã được sử dụng',

            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự',

            'terms.required' => 'Bạn phải đồng ý với điều khoản',
            'terms.accepted' => 'Bạn phải đồng ý với điều khoản'
        ];
    }
}
