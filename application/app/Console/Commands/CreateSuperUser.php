<?php

namespace App\Console\Commands;

use App\Admin;
use App\Role;
use App\RoleAdmins;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateSuperUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:superuser {--verified} {--name=} {--email=} {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new active super user';

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
        $name = $this->option('name');
        $email = $this->option('email');
        $optional_password = '12345678';
        $password = $this->option('password') ?? $optional_password;
        $bar = $this->output->createProgressBar();
        $admin = Admin::create(
            [
                "name"=>$name,
                "email"=>$email,
                "password"=>bcrypt($password),
                "email_verified_at"=>$this->option('verified') ? now():null,
            ]
        );
        RoleAdmins::create(["admin_id"=>$admin->id,"role_id"=>Role::where('role','SUPERADMIN')->value('id')]);
        $this->info('Superadmin '.$name.' is created successfully with username: '.$email.'.');

    }
}
