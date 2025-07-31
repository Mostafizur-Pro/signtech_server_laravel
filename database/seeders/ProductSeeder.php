<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([

            "model" => "AM340AXVANC",
            "title" => "DVM S2 Outdoor Unit",
            "cooling_kw" => "95.2",
            "cooling_btu" => 324632,
            "cooling_tr" => "27.1",
            "power_input_w" => "31.73 kw",
            "air_flow_high_cfm" => null,
            "air_flow_medium_cfm" => null,
            "air_flow_low_cfm" => null,
            "refrigerant" => "R410A",
            "size_width_mm" => 1860,
            "size_height_mm" => 765,
            "size_depth_mm" => 1695,
            "panel_model" => null,
            "panel_type" => null,
            "panel_color" => null,
            "regular_price" => "8,11,023.23",
            "offer_price" => "7,79,830.02",
            "inverter_type" => "inverter",
            "category" => "outdoor",
            "image_1" => "https://images.samsung.com/is/image/samsung/p6pim/in/am340axvanc-tl/gallery/in-dvms2-427392-am340axvanc-tl-532906486?$720_576_JPG$",
            "image_2" => "https://images.samsung.com/is/image/samsung/p6pim/in/am340axvanc-tl/gallery/in-dvms2-427392-am340axvanc-tl-532906499?$720_576_JPG$",
            "image_3" => `https://images.samsung.com/is/image/samsung/p6pim/in/feature/164132074/in-feature-easy-troubleshooting-with-one-touch-532905804?1FB_TYPE_A_MO_JPG1`

        ]);
    }
}
