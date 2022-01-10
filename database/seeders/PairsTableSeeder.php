<?php

namespace Database\Seeders;

use App\Models\Pair;
use Illuminate\Database\Seeder;

class PairsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pairs = [
            [Pair::USER_ID => 1, Pair::USER_ID_PAIRING => 2],
            [Pair::USER_ID => 1, Pair::USER_ID_PAIRING => 3],
        ];

        foreach ($pairs as $pair) {
            Pair::create([
                Pair::USER_ID             => $pair[ Pair::USER_ID ],
                Pair::USER_ID_PAIRING     => $pair[ Pair::USER_ID_PAIRING ],
            ]);
        }
    }
}
