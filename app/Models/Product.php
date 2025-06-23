<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'price',
        'regular_price',
        'size',
        'refrigerant',
        'general',
        'capacity',
        'power',
        'model',
        'unit',
        'type',
        'image'
    ];
}


/*
Model : AM045NN4DEH
Cooling_KW: 4.5 Kw
Cooling_Btu: 15400 btu
Power_Input: 32 W
Air_flow_h: 14.5 cfm
Air_flow_m: 13.5 cfm
Air_flow_l: 12.5 cfm
Refrigerant: R410A
Size_w:840
Size_h:204
Size_d:840
panel_Model: PC4NUFMAN
Panel_Type: Wind-Free Type
panel_color: white/black
machine_type: indoor/Outdoor
indoor_type: cassete, duct, 360 cassette
Size: 1.25, 2.0 tr
regular_price: 210600
offer_price: 174000
inverter: inverter/non inverter

image_1: 
image_2: 
image_3: 
image_4: 
image_5: 

pump: cooling/ heating


HP


     


*/