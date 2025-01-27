<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FleetBuilderFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
//    public function authorize(): bool
//    {
//        return false;
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $step = $this->input('step');
        $this->validateStep($step);

        $rules = [];

        switch ($step) {
            case 'faction':
                $rules = [
                    'faction' => 'required|string|max:25',
                ];
                break;
            case 'fleet-list':
                $rules = [

                ];
                break;
            case 'fleet':
                $rules = [

                ];
                break;
            default:
        }

        return $rules;
    }

    private function validateStep($step)
    {
        if (!$step || !in_array($step, ['faction', 'fleet-list', 'fleet'])) {
            abort(422, 'Invalid step provided');
        }
    }
}
