<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceLogStoreRequest extends FormRequest
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
            'date' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'time_logs.*.start_time' => 'required|numeric|min:0|max:24',
            'time_logs.*.end_time' => 'required|numeric|min:0|max:24|gte:time_logs.*.start_time',
            'time_logs.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'date.required' => 'Vui lòng chọn ngày chấm công.',
            'date.date' => 'Định dạng ngày không hợp lệ.',
            'user_id.required' => 'Vui lòng chọn người điểm danh.',
            'user_id.exists' => 'Người điểm danh không tồn tại.',
            'time_logs.*.start_time.required' => 'Vui lòng nhập thời gian bắt đầu.',
            'time_logs.*.start_time.numeric' => 'Thời gian bắt đầu phải là số.',
            'time_logs.*.start_time.min' => 'Thời gian bắt đầu tối thiểu là 0.',
            'time_logs.*.start_time.max' => 'Thời gian bắt đầu tối đa là 24.',
            'time_logs.*.end_time.required' => 'Vui lòng nhập thời gian kết thúc.',
            'time_logs.*.end_time.numeric' => 'Thời gian kết thúc phải là số.',
            'time_logs.*.end_time.min' => 'Thời gian kết thúc tối thiểu là 0.',
            'time_logs.*.end_time.max' => 'Thời gian kết thúc tối đa là 24.',
            'time_logs.*.end_time.gte' => 'Thời gian kết thúc phải lớn hơn hoặc bằng thời gian bắt đầu.',
            'time_logs.*.image.image' => 'Tệp tải lên phải là hình ảnh.',
            'time_logs.*.image.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg hoặc gif.',
            'time_logs.*.image.max' => 'Kích thước hình ảnh tối đa là 2MB.'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'date' => $this->input('date') ?: now()->toDateString(),
        ]);
    }
}
