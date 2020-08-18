<?php

use Illuminate\Database\Seeder;

class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $tickets = ['cat one', 'cat two', 'cat three'];

        foreach ($tickets as $ticket) {

            \App\Ticket::create([
                'ar' => ['name' => $ticket],
                'en' => ['name' => $ticket],
            ]);

        }//end of foreach

    }//end of run

}//end of seeder
