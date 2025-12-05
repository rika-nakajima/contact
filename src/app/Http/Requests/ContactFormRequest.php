namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'last_name'   => 'required|string|max:8',
            'first_name'  => 'required|string|max:8',
            'gender'      => 'required|in:1,2,3',
            'email'       => 'required|email',
            'tel1'        => 'required|digits_between:2,3',
            'tel2'        => 'required|digits_between:3,4',
            'tel3'        => 'required|digits:4',
            'address'     => 'required|string',
            'building'    => 'nullable|string|max:50', // ← 追加
            'category_id' => 'required|integer',
            'message'     => 'required|string|max:120',
        ];
    }

    public function messages(): array
    {
        return [
            'last_name.required' => '姓は必須です。',
            'last_name.max'      => '姓は8文字以内で入力してください。',
            'first_name.required' => '名は必須です。',
            'first_name.max'      => '名は8文字以内で入力してください。',
            'gender.required'     => '性別を選択してください。',
            'email.required'      => 'メールアドレスは必須です。',
            'email.email'         => '正しいメールアドレス形式で入力してください。',
            'tel1.required'       => '電話番号（市外局番）は必須です。',
            'tel1.digits_between' => '電話番号（市外局番）は2〜3桁で入力してください。',
            'tel2.required'       => '電話番号（市内局番）は必須です。',
            'tel2.digits_between' => '電話番号（市内局番）は3〜4桁で入力してください。',
            'tel3.required'       => '電話番号（加入者番号）は必須です。',
            'tel3.digits'         => '電話番号（加入者番号）は4桁で入力してください。',
            'address.required'    => '住所は必須です。',
            'category_id.required'=> 'お問い合わせの種類を選択してください。',
            'message.required'    => 'お問い合わせ内容は必須です。',
            'message.max'         => 'お問い合わせ内容は120文字以内で入力してください。',
        ];
    }
}