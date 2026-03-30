<?php

namespace App\Console\Commands;

use App\Models\Invoice;
use Illuminate\Console\Command;

class MarkOverdueInvoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mark-overdue-invoices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change status of invoices to overdue if they currently have a status of sent or partially_paid, and if the due date is passed the current date.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Invoice::whereIn('status', ['sent', 'partially_paid'])
            ->where('due_date', '<', now())
            ->update(['status' => 'overdue']);
    }
}
