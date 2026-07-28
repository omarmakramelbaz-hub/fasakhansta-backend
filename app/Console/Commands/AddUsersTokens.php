<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class AddUsersTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:usersTokens';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Tokens For users tokens ';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users=User::all();
        foreach($users as $user){
            if($user->fcm_id){
            $user->tokens()->create([
                'token' => $user->fcm_id,
            ]);
            }
            if($user->device_token){
            $user->tokens()->create([
                'token' => $user->device_token,
            ]);
            }
        }
    }
}
