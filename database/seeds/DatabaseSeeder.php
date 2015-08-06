<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('OrganizationTableSeeder');
		$this->command->info("Organization table seeded");
		$this->call('typeTableSeeder');
		$this->command->info("Business Type table seeded");
	}


}

class UsersTableSeeder extends Seeder {

	public function OrganizationTableSeeder() {

		//delete users table records
         DB::table('organizations')->delete();
         //insert records
         DB::table('organizations')->insert(array(
         	array('name' => 'Company'),
         	array('name' => 'Corporation'),
         	array('name' => 'Non profit'),
         	array('name' => 'School'),
         	array('name' => 'Office'),
         	array('name' => 'Agency'),
         	array('name' => 'Church'),
         	array('name' => 'Restaurant'),
         	array('name' => 'Firm'),
         	array('name' => 'Actual Company Name')
         	));
	}
}
