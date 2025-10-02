<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
     * @return array
     */
    protected function prepareForValidation(): void
    {
        // 3つのパーツを結合して、'tel'という新しいキーを作成
        // ハイフン区切りで結合し、リクエストデータにマージ（追加）する
        $tel = $this->phone_part1 . '-' . $this->phone_part2 . '-' . $this->phone_part3;
        $this->merge([
            'tel' => $tel,
        ]);
    }


    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required',
            'email' => 'required|email|max:255',
            'phone_part1' => 'required|numeric',
            'phone_part2' => 'required|numeric',
            'phone_part3' => 'required|numeric',
            'address' => 'required|string|max:255',
            'building' => 'nullable|string|max:255',
            'category_id' => 'required',
            'detail' => 'required|string|max:120',
        ];

    }

    public function messages()
    {
        return [
            'first_name.required' => '姓を入力してください',
            'last_name.required' => '名を入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'phone_part1.required' => '電話番号を入力してください',
            'phone_part2.required' => '電話番号を入力してください',
            'phone_part3.required' => '電話番号を入力してください',
            'address.required' => '住所を入力してください',
            'category_id.required' => 'お問い合わせ種類を選択してください',
            'detail.required' => '内容を入力してください',
            'detail.max' => '内容は120文字以内で入力してください',
        ];
    }
}
