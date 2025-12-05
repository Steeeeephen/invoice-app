<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;

    public function definition(): array
    {
        return [
            'description' => $this->faker->sentence(),
            'amount_due' => $this->faker->randomFloat(2, 100, 2000),
            'due_date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['draft', 'sent', 'paid', 'cancelled']),
            // Setting the customer_id is self-explanatory, but we're taking the entire Customer table, randomizing it, then selecting the first row and using the id.
            'customer_id' => Customer::inRandomOrder()->first()->id,
            'project_id' => Project::inRandomOrder()->first()->id,
        ];
    }
}
