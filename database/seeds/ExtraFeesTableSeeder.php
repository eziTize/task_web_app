<?php
use App\ExtraFees;
use Illuminate\Database\Seeder;

class ExtraFeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
            ExtraFees::create([

            		'fee_type' => 'Prospectus Fee',
                    'fee_amount' => 120.00,
        ]);


             ExtraFees::create([

            		'fee_type' => 'Admission Fee',
                    'fee_amount' => 100.00,

        ]);
    }
}
