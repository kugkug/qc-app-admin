<?php

declare(strict_types=1);
namespace App\Helpers;

use App\Models\ApplicationTypeLookUp;
use App\Models\BaranggayLookUp;
use App\Models\BusinessLineLookUp;
use App\Models\CivilstatusLookUps;
use App\Models\ClassificationLookUp;
use App\Models\IndustryLookUp;
use App\Models\SubIndustryLookUp;
use Exception;

class DropdownHelper {

    public function getAllDropDowns() {
        return [
            'barangays' => $this->getBarangays(),
            'civil_statuses' => $this->getCivilStatuses(),
            'classifications' => $this->getClassifications(),
            'application_types' => $this->getApplicationTypes(),
            'industries' => $this->getIndustries(),
            'sub_industries' => $this->getSubIndustries(),
        ];
    }
    
    public function getBarangays() {
        try {
            return BaranggayLookUp::orderBy('baranggay')->get()->toArray();
        } catch (Exception $e) { return []; }
    }

    public function getCivilStatuses() {
        try {
            return CivilstatusLookUps::orderBy('civil_status')->get()->toArray();
        } catch (Exception $e) { return []; }
    }

    public function getClassifications() {
        try {
            return ClassificationLookUp::orderBy('classification')->get()->toArray();
        } catch (Exception $e) { return []; }
    }

    public function getApplicationTypes() {
        try {
            return ApplicationTypeLookUp::orderBy('application')->get()->toArray();
        } catch (Exception $e) { return []; }
    }

    public function getIndustries() {
        try {
            return IndustryLookUp::orderBy('industry')->get()->toArray();
        } catch (Exception $e) { return []; }
    }

    public function getSubIndustries() {
        try {
            return SubIndustryLookUp::orderBy('sub_industry')->get()->toArray();
        } catch (Exception $e) { return []; }
    }

    public function getSubIndustriesViaIndustry(int $industry_id) {
        try {
            return SubIndustryLookUp::where('industry_id', $industry_id)->orderBy('sub_industry')->get()->toArray();
        } catch (Exception $e) { return []; }
    }

    public function getBusinessLinesViaSubIndustryId(int $sub_industry_id) {
        try {
            return BusinessLineLookUp::where('sub_industry_id', $sub_industry_id)->orderBy('business_line')->get()->toArray();
        } catch (Exception $e) { return []; }
    }
}