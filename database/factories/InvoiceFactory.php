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
        $invoiceAmount = $this->faker->randomFloat(2, 100, 5000);

        // Pick a scenario at random to get a good spread of statuses
        $scenario = $this->faker->randomElement(['paid', 'partial', 'unpaid', 'cancelled']);

        $amountDue = match($scenario) {
            'paid'      => 0,
            'partial'   => $this->faker->randomFloat(2, 1, $invoiceAmount - 0.01),
            'unpaid'    => $invoiceAmount,
            'cancelled' => 0,
        };

        $status = match($scenario) {
            'paid'      => 'paid',
            'partial'   => 'partially_paid',
            'unpaid'    => $this->faker->randomElement(['draft', 'sent', 'overdue']),
            'cancelled' => 'cancelled',
        };

        return [
            'description'    => $this->faker->sentence(),
            'invoice_amount' => $invoiceAmount,
            'amount_due'     => $amountDue,
            'due_date'       => $this->faker->date(),
            'paid_at'        => $status === 'paid' ? $this->faker->date() : null,
            'status'         => $status,
            'customer_id'    => Customer::inRandomOrder()->first()->id,
            'project_id'     => Project::inRandomOrder()->first()->id,
        ];
    }
}
