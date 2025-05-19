<?php

use App\Helpers\ApiHelper;
use App\Helpers\DropdownHelper;
use App\Helpers\GlobalHelper;
use App\Helpers\KeysHelper;
use App\Helpers\ValidatorHelper;
use App\Helpers\ViewHelper;

function dropDownHelper() {
    return new DropdownHelper;
}

function globalHelper() {
    return new GlobalHelper;
}

function apiHelper() {
    return new ApiHelper;
}

function viewHelper() {
    return new ViewHelper;
}

function keysHelper() {
    return new KeysHelper;
}

function validatorHelper() {
    return new ValidatorHelper;
}