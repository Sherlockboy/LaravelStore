<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AdminUserCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create {--u|username= : Admin user username}
    {--e|email= : Admin user email}';

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
        $data = [];

        $data['username'] = $this->option('username') ?? $this->ask('Enter admin username');
        $data['email'] = $this->option('email') ?? $this->ask('Enter admin email');
        $data['password'] = $this->secret('Enter password');
        $data['password_confirmation'] = $this->secret('Confirm password');

        try {
            $data = Validator::validate($data, [
                'username' => ['string', 'max:255', 'unique:users'],
                'email' => ['string', 'email', 'unique:users'],
                'password' => ['string', 'confirmed', Password::defaults()]
            ]);

            $data['password'] = Hash::make($data['password']);
            $data['type'] = User::USER_ADMIN_TYPE;

            User::create($data);
        } catch (\Exception $e) {
            $this->output->error($e->getMessage());
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
