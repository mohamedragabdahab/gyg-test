<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 04.03.18
 * Time: 20:27
 */
namespace App\Validator;

use App\Services\ProductService;

class ProductValidator
{
    /**
     * Arguments validation rules
     *
     * @var array
     */
    private $rules = [
        ProductService::END_POINT => 'required|url',
        ProductService::DATE_START => 'required|date_format:Y-m-d\\TH:i',
        ProductService::DATE_END => 'required|date_format:Y-m-d\\TH:i|after:start_date',
        ProductService::TRAVELERS => 'required|integer|between:1,30'
    ];

    public function validate($data)
    {
        return \Validator::make($data, $this->rules);
    }
}