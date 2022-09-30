<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Hash;

class AdminUserCreate extends Command
{
    use ValidatesRequests;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new admin user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $username = $this->ask('Admin Username');
        $email = $this->ask('Admin user email');
        $password = $this->secret('Admin password');
        $confirmedPassword = $this->secret('Confirm admin password');

        if ($password === $confirmedPassword) {
            $admin = Admin::create(
                [
                    'username' => $username,
                    'email' => $email,
                    'password' => Hash::make($password)
                ]
            );
        }



            return Command::SUCCESS;
    }
}
