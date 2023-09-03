<?php

namespace app\seeder\tables;

use diecoding\seeder\TableSeeder;
use app\models\Contact;

/**
 * Handles the creation of seeder `Contact::tableName()`.
 */
class ContactTableSeeder extends TableSeeder
{
    // public $truncateTable = false;
    // public $locale = 'en_US';

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $count = 100;
        for ($i = 0; $i < $count; $i++) {
            $this->insert(Contact::tableName(), [
                'name' => $this->faker->name(),
				'email' => $this->faker->unique()->email(),
				'phone_number' => $this->faker->e164PhoneNumber(),
                'address' => $this->faker->address(),
				'created_at' => $this->faker->dateTime()->format("Y-m-d H:i:s"),
				'updated_at' => $this->faker->dateTime()->format("Y-m-d H:i:s"),
            ]);
        }
    }
}