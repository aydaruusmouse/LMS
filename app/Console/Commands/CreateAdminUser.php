<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create {--email=} {--password=} {--name=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Creating Admin User...');
        $this->newLine();

        // Get email
        $email = $this->option('email');
        if (!$email) {
            $email = $this->ask('Enter admin email address');
        }

        // Validate email
        $validator = Validator::make(['email' => $email], [
            'email' => 'required|email|unique:users,email',
        ]);

        if ($validator->fails()) {
            $this->error('Validation failed:');
            foreach ($validator->errors()->all() as $error) {
                $this->error('  - ' . $error);
            }
            return Command::FAILURE;
        }

        // Get password
        $password = $this->option('password');
        if (!$password) {
            $password = $this->secret('Enter admin password (min 6 characters)');
        }

        if (strlen($password) < 6) {
            $this->error('Password must be at least 6 characters long.');
            return Command::FAILURE;
        }

        // Get name
        $name = $this->option('name');
        if (!$name) {
            $name = $this->ask('Enter admin name (first name)', 'Admin');
        }

        // Split name into first and last name
        $nameParts = explode(' ', $name, 2);
        $firstName = $nameParts[0];
        $lastName = $nameParts[1] ?? null;

        // Get phone (optional)
        $phone = $this->ask('Enter phone number (optional)', null);

        try {
            $user = User::create([
                'first_name'        => $firstName,
                'last_name'         => $lastName,
                'email'             => $email,
                'password'          => Hash::make($password),
                'phone'             => $phone,
                'user_type'         => 'admin',
                'role_id'           => 1,
                'email_verified_at' => now(),
                'status'            => 1,
            ]);

            $this->newLine();
            $this->info('✓ Admin user created successfully!');
            $this->newLine();
            $this->table(
                ['Field', 'Value'],
                [
                    ['ID', $user->id],
                    ['Name', $user->first_name . ' ' . ($user->last_name ?? '')],
                    ['Email', $user->email],
                    ['User Type', $user->user_type],
                    ['Role ID', $user->role_id],
                ]
            );
            $this->newLine();
            $this->warn('Please save these credentials securely!');
            $this->info('Email: ' . $email);
            $this->info('Password: ' . ($this->option('password') ? '***' : '[the password you entered]'));

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Failed to create admin user: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
