<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin {name} {email} {password}';

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
        $name = $this->argument('name');
        $email = $this->argument('email');
        $pass = $this->argument('password');

        $password = bcrypt($pass);

        $user = User::firstOrCreate([
            'name' => $name, 
            'email' => $email,
            'is_admin' => 1,
            'password' => $password
            ]);
        $action = 'updated';
        if($user->wasRecentlyCreated)
        {
            $this->info('sending a welcome email....');
            $action = 'created';
        }

        $this->info('User '.$user->email. ' successfuly '.$action);
    }
}
