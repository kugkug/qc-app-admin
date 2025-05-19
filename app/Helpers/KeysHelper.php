<?php

declare(strict_types=1);
namespace App\Helpers;

class KeysHelper {
    private const KEYS = [
        'FirstName' => 'firstname',
        'MiddleName' => 'middlename',
        'LastName' => 'lastname',
        'SuffixName' => 'suffixname',
        'BirthDate' => 'birthdate',
        'Sex' => 'sex',
        'Contact' => 'contact',
        'Email' => 'email',
        'Occupation' => 'occupation',
        'CivilStatusId' => 'civil_status_id',
        'BarangayId' => 'barangay_id',
        'BaranggayId' => 'barangay_id',
        'Street' => 'street',
        'Address' => 'address',
        'Password' => 'password',
        'UserType' => 'user_type',
        'Nationality' => 'nationality',
        'YellowCard' => 'yellow_card',

        'UserId' => 'user_id',
        'ApplicationRefNo' => 'application_ref_no',
        'ClassificationId' => 'classification_id',
        'ApplicationTypeId' => 'application_type_id',
        'IndustryId' => 'industry_id',
        'SubIndustryId' => 'sub_industry_id',
        'BusinessLineId' => 'business_line_id',
        'CompanyName' => 'company_name',
        'CompanyAddress' => 'company_address',
        'ApplicationStatus' => 'application_status',


        'Requirement' => 'requirement',
        'Photo' => 'photo',
        'Status' => 'status',
        'Notes' => 'notes',

        'PaymentInformation' => 'payment_information',
    ];
    
    public function getKey(string $key_index): string {
        return self::KEYS[$key_index];
    }
}