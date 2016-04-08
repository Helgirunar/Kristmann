<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Forsida;
use App\User;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	 public function run()
     {
         $this->call('adminSeeder');

         $this->command->info('Forsida table seeded!');
     }

}
class adminSeeder extends Seeder {

    public function run()
    {
        //DB::table('forsidas')->delete();

      Forsida::create(['frettdagsins' => 'ekkert i dag']);
			User::create(['username' => 'administrator',
											'password' => bcrypt('root123'),
											'email'	=> 'admin@admin.com',
											'profilephoto' => '/images/Administrator.jpg',
											'firstname' => 'Alfa'
			]);
			User::create(['username' => 'administrator2',
										'password' => bcrypt('root1234'),
										'email'	=> 'admin2@admin2.com',
										'profilephoto' => '/images/Administrator.jpg',
										'firstname' => 'Alfa'
		]);
    }

}
