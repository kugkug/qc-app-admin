<?php

declare(strict_types=1);
namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidatorHelper {

    public function validate(string $type, Request $request): array {
        
        $mapped = $this->key_map($request->except([
            'ConfirmPassword'
        ]));
        $validated = Validator::make($mapped, $this->rules($type));
        
        if ($validated->fails()) {
            return [
                'status' => false,
                'response' => $validated->errors()->first(),
            ];
        }

        return [
            'status' => true,
            'validated' => $validated->validated(),
        ]; 
    }

    private function key_map($to_map): array {

        $mapped = [];
        foreach($to_map as $key => $value) {
            if($value) {
                $mapped[keysHelper()->getKey($key)] = $value;
            }
        }

        return $mapped;
    }

    
    private function rules(string $type) {
        switch($type) {

            case 'registration':
                return [
                    'firstname' => 'required|string|max:250',
                    'middlename' => 'sometimes|string|max:250',
                    'lastname' => 'required|string|max:250',
                    'suffixname' => 'sometimes|string|max:50',
                    'birthdate' => 'required|string|max:20',
                    'contact' => 'required|string|max:15',
                    'email' => 'email|string|max:250',
                    'password' => 'required|string|max:250',
                    'user_type' => 'sometimes|string|max:250',
                ];
            break;

            case 'application_save':
                return [
                    'application_ref_no' => 'required|string',
                    'user_id' => 'required|integer',
                    'application_type_id' => 'required|integer',
                    'classification_id' => 'required|integer',
                    'industry_id' => 'required|integer',
                    'sub_industry_id' => 'required|integer',
                    'business_line_id' => 'sometimes|integer',
                    'company_name' => 'sometimes|string',
                    'company_address' => 'sometimes|string',
                ];
            break;

            case 'application_update':
                return [
                    'application_type_id' => 'sometimes|integer',
                    'classification_id' => 'sometimes|integer',
                    'industry_id' => 'sometimes|integer',
                    'sub_industry_id' => 'sometimes|integer',
                    'business_line_id' => 'sometimes|integer',
                    'company_name' => 'sometimes|string',
                    'company_address' => 'sometimes|string',
                    'application_status' => 'sometimes|integer',
                ];
            break;

            case 'process_application':
                return [
                    'firstname' => 'required|string|max:250',
                    'middlename' => 'sometimes|string|max:250',
                    'lastname' => 'required|string|max:250',
                    'suffixname' => 'sometimes|string|max:50',
                    'birthdate' => 'required|string|max:20',
                    'sex' => 'required|string|max:10',
                    'contact' => 'required|string|max:15',
                    'email' => 'email|string|max:250',
                    'occupation' => 'sometimes|string|max:250',
                    'civil_status_id' => 'required|integer',
                    'barangay_id' => 'required|integer',
                    'street' => 'required|string|max:250',
                    'address' => 'sometimes|string|max:250',
                    'company_name' => 'sometimes|string',
                    'company_address' => 'sometimes|string',
                ];
            break;

            case 'upload_requirements':
                return [
                    'application_ref_no' => 'required|string',
                ];
            break;

            case 'update_requirements':
                return [
                    'requirement' => 'sometimes|integer',
                    'photo' => 'sometimes|string',
                    'status' => 'sometimes|integer',
                    'notes' => 'sometimes|string',
                ];
            break;

            case 'create_payment_order':
                return [
                    'payment_information' => 'required|string',
                ];
            break;

            case 'update_payment_order':
                return [
                    'payment_information' => 'sometimes|string',
                    'status' => 'sometimes|integer',
                ];
            break;

            case 'business_update':
                return [
                    'application_type_id' => 'sometimes|integer',
                    'industry_id' => 'sometimes|integer',
                    'sub_industry_id' => 'sometimes|integer',
                    'business_line_id' => 'sometimes|integer',
                    'company_name' => 'sometimes|string',
                    'company_address' => 'sometimes|string',
                    'application_status' => 'sometimes|integer',
                ];
            break;

            case 'update_complaint':
                return [
                    'status' => 'sometimes|string',
                    'recommendation_first' => 'sometimes|string',
                    'recommendation_second' => 'sometimes|string',
                    'recommendation_third' => 'sometimes|string',
                ];
            break;
            
        }
    }

}