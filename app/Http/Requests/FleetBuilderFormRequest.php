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
     * This Form Request has been made redundant for the time being
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
                    'faction' => 'required|integer|exists:factions,id',
                ];
                break;
            case 'fleet-list':
                $rules = [
                    'fleetList' =>  'required|integer|exists:fleet_lists,id',
                ];
                break;
            case 'ship':
                $rules = [
                    'shipId' => 'required|integer|exists:ships,id',
                ];
                break;
            default:
        }

        return $rules;
    }

    private function validateStep($step)
    {
        if (!$step || !in_array($step, ['faction', 'fleet-list', 'ship'])) {
            abort(422, 'Invalid step provided');
        }
    }
}
