<?php

namespace App\Console\Commands;

use App\Admin;
use App\Role;
use App\RoleAdmins;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class CreateMultipleAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:mulitpleadmins {--count=} {--verified=} {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'You can create multiple superamdin from here';

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
     * @return mixed
     */
    public function handle()
    {
        $faker = Faker::create();
        $count = $this->option('count');
        $bar = $this->output->createProgressBar($count);
        $bar->start();
        for($i=0; $i<$count; $i++) {
            $name = $faker->name;
            $email = $faker->unique()->safeEmail;
            $optional_password = '12345678';
            $password = $this->option('password') ?? $optional_password;
            $admin = Admin::create(
                [
                    "name"=>$name,
                    "email"=>$email,
                    "password"=>bcrypt($password),
                    "email_verified_at"=>$this->option('verified') ? now():null,
                ]
            );
            RoleAdmins::create(["admin_id"=>$admin->id,"role_id"=>Role::where('role','SUPERADMIN')->value('id')]);
            $bar->advance();
        }
        $bar->finish();
        $this->info($count.' superadmins are created successfully.'.$this->option('password') ? '':' Default password is 12345678');
    }
}
