<?php

namespace App\Http\Requests\Product;

use App\Models\Attach;
use App\Models\Media;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class StoreRequest extends FormRequest
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
            'name_uz' => 'required',
            'name_ru' => 'required',
            'name_en' => 'required'
        ];
    }

    /**
     * Handle a passed validation attempt.
     */
    protected function passedValidation(): void
    {
        $data = $this->all();

        if (request()->file('media')) {
            $media = Storage::disk('public')->put('products/', request()->file('media'));
            $path = pathinfo($media);

            $mediaId = Media::create([
                'base_name' => $path['basename'],
                'original_name' => request()->media->getClientOriginalName(),
                'src' => "/storage/{$path['dirname']}/{$path['basename']}",
                'size' => request()->media->getSize(),
                'type' => $path['extension']
            ])->id;

            $data['media_id'] = $mediaId;
        }

        $this->replace($data);
    }
}
