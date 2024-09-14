<?php

namespace App\Http\Requests\Product;

use App\Models\Attach;
use App\Models\Media;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class UpdateRequest extends FormRequest
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
            $product = Product::where('id', request()->id)->first();

            if ($product->media_id && $product->media) {
                Storage::disk('public')->delete('products/' . $product->media->base_name);

                $media = Storage::disk('public')->put('products/', request()->file('media'));
                $path = pathinfo($media);
                Media::where('id', $product->media_id)->update([
                    'base_name' => $path['basename'],
                    'original_name' => request()->media->getClientOriginalName(),
                    'src' => "/storage/{$path['dirname']}/{$path['basename']}",
                    'size' => request()->media->getSize(),
                    'type' => $path['extension']
                ]);
            } else {
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
        }

        Attach::where('product_id', request()->id)->delete();
        $attaches = collect(request()->category_ids)->map(function ($item) {
            return [
                'category_id' => $item,
                'product_id' => $this->id,
                'created_at' => now(),
                'updated_at' => now()
            ];
        });

        Attach::insert($attaches->toArray());

        Arr::forget($data, ['name', 'desc', 'spec', 'brand', 'category', 'media', 'category_ids']);

        $this->replace($data);
    }
}
