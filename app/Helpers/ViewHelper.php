<?php

declare(strict_types=1);
namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\Log;

class ViewHelper {
    public function updateDropDownValues(
        string $elem_key,
        array $values, 
        string $identifier,
        string $display_value
    ) {
        $options = "";
        try {
            if ($values) {
                $options .= "<option value='' selected='selected'>- Select Sub Industry -</option>";   
                foreach($values as $value) {
                    $options .= "<option value='".$value[$identifier]."'>".$value[$display_value]."</option>";
                }
                
                return trim("
                    $('[data-key=".$elem_key."]').html(\"".preg_replace('/\s+/', ' ', $options)."\");
                    $('[data-key=".$elem_key."]').attr('disabled', false);
                ");
                
            }

            return trim("
                    $('[data-key=".$elem_key."]').html(\"".preg_replace('/\s+/', ' ', $options)."\");
                    $('[data-key=".$elem_key."]').attr('disabled', true);
                ");

        } catch (Exception $e) {
            Log::channel('info')->info(json_encode($e->getTrace()));
            return trim("
                    $('[data-key=".$elem_key."]').html(\"".preg_replace('/\s+/', ' ', $options)."\");
                    $('[data-key=".$elem_key."]').attr('disabled', true);
                ");
        }
    }
}