<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Str;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Name: ');
        $email = $this->ask('Email: ');

        $api_key = Str::random(30);
       
        DB::table('users')
            ->insert([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt(Str::random(10)),
                'api_key' => $api_key,
            ]);
       

        $this->info('User created!');
        $this->info('API key: ' . $api_key);
    }
}
