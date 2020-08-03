<?php

use App\Fees;
use Illuminate\Database\Seeder;

class FeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         {
            Fees::create([

            		'student_id' => 1,
                    'batch_id' => 1,
                    'admission_fee' => 100.00,
                    'ppts_fee' => 120.00,
                    'reg_fee' => 5000.00,
                    'sq_deposit' => 100.00,
                    
                    'discount' => 0.00,
                    'start_date' => new DateTime,
                    'installment' => 'One Time',

        ]);


             Fees::create([

            		'student_id' => 2,
                    'batch_id' => 1,
                    'admission_fee' => 100.00,
                    'ppts_fee' => 120.00,
                    'reg_fee' => 5000.00,
                    'sq_deposit' => 100.00,
                    
                    'discount' => 0.00,
                    'start_date' => new DateTime,
                    'installment' => 'Monthly',

        ]);
    }

}

}
