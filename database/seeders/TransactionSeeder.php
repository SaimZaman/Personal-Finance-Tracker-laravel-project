<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::where('email', 'test@example.com')->first();
        
        if ($user) {
            $transactions = [
                [
                    'title' => 'Salary Payment',
                    'description' => 'Monthly salary from company',
                    'amount' => 3000.00,
                    'type' => 'income',
                    'category' => 'Salary',
                    'transaction_date' => now(),
                ],
                [
                    'title' => 'Grocery Shopping',
                    'description' => 'Weekly groceries at supermarket',
                    'amount' => 150.50,
                    'type' => 'expense',
                    'category' => 'Food',
                    'transaction_date' => now()->subDays(1),
                ],
                [
                    'title' => 'Gas Bill',
                    'description' => 'Monthly gas utility bill',
                    'amount' => 85.00,
                    'type' => 'expense',
                    'category' => 'Bills',
                    'transaction_date' => now()->subDays(2),
                ],
                [
                    'title' => 'Freelance Project',
                    'description' => 'Web development project payment',
                    'amount' => 500.00,
                    'type' => 'income',
                    'category' => 'Business',
                    'transaction_date' => now()->subDays(3),
                ],
                [
                    'title' => 'Movie Night',
                    'description' => 'Cinema tickets and snacks',
                    'amount' => 45.00,
                    'type' => 'expense',
                    'category' => 'Entertainment',
                    'transaction_date' => now()->subDays(4),
                ],
            ];

            foreach ($transactions as $transaction) {
                $user->transactions()->create($transaction);
            }
        }
    }
}
