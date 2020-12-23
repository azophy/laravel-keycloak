<?php

namespace App\Console\Commands;

use App\User;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class MakeUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->ask('Enter name');
        $email = $this->ask('Enter email');
        $password = $this->secret('Enter password');
        $password2 = $this->secret('Re-enter password');

        if ($password != $password2) {
            $this->error('password mismatch');
            return 1;
        }

        try {
            User::create([
              'name' => $name,
              'email' => $email,
              'password' => Hash::make($password),
            ]);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return 1;
        } finally {
            $this->info('The user creation successful!');
        }
    }
}
