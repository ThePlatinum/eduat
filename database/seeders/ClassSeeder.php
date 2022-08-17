<?php

namespace Database\Seeders;

use App\Models\Klass;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //
      $classes = [
        [
          'name' => 'Graduated',
          'fees' => explode(',', "0, 0, 0")
        ],
        [
          'name' => 'JSS 1',
          'next_klass' => 2,
          'fees' => explode(',', "22300, 23000, 25000")
        ],
        [
          'name' => 'JSS 2',
          'next_klass' => 3,
          'fees' => explode(',', "15300, 18000, 15000")
        ],
        [
          'name' => 'JSS 3',
          'fees' => explode(',', "22300, 18000, 15000")
        ],
        [
          'name' => 'SSS 1 A (Science)',
          'fees' => explode(',', "12300, 13000, 15000")
        ],
        [
          'name' => 'SSS 1 B (Arts)',
          'fees' => explode(',', "12300, 13000, 15000")
        ],
        [
          'name' => 'SSS 2 A (Science)',
          'fees' => explode(',', "12300, 13000, 15000")
        ],
        // [
        //   'name' => 'SSS 2 B (Arts)',
        //   'fees' => explode(',', "12300, 13000, 15000")
        // ],
        // [
        //   'name' => 'SSS 3 A (Science)',
        //   'fees' => explode(',', "12300, 13000, 15000")
        // ],
        // [
        //   'name' => 'SSS 3 B (Arts)',
        //   'fees' => explode(',', "12300, 13000, 15000")
        // ]
      ];

      foreach ($classes as $c) {
        Klass::create($c);
      }
    }
}
