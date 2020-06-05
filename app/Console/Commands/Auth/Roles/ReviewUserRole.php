<?php

namespace App\Console\Commands\Auth\Roles;

use App\Models\Auth\User;
use App\Models\Social\Review;
use Illuminate\Console\Command;

/**
 * Class ReviewUserRole.
 */
class ReviewUserRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roles:review-user-role';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '檢查使用者審核紀錄，';

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
        $reviews = Review::all()->groupBy('model_id');
        foreach ($reviews as $key => $value)
        {
            $user = User::find($key);
            if (count($value) >= 200  && !$user->isJuniorUser())
                $user->assignRole(config('access.users.junior_user_role'));
            if (count($value) >= 500  && !$user->isSeniorUser())
                $user->assignRole(config('access.users.senior_user_role'));
            if (count($value) >= 1000 && !$user->isExpertUser())
                $user->assignRole(config('access.users.expert_user_role'));
            if (count($value) >= 3000 && !$user->isLegendUser())
                $user->assignRole(config('access.users.legend_user_role'));
        }
    }
}
