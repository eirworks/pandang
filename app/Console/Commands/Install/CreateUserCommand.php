<?php

namespace App\Console\Commands\Install;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a user';

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
        $email = $this->ask("User email");

        if (User::where('email', $email)->count() > 0)
        {
            $this->error("User with that email already exists!");
            return 1;
        }

        $name = $this->ask("User name");
        $password = $this->secret("User Password");

        $user = new User([
            'name' => $name,
            'password' => Hash::make($password),
            'email' => $email
        ]);
        $user->save();

        $this->info("User created!");

        return 0;
    }
}
