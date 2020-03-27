<?php

namespace App\Console\Commands\Backup;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

/**
 * Class Database.
 */
class Database extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '自動備份資料庫。';

    /**
     * The Process component executes commands in sub-processes.
     *
     * @var Process
     */
    protected $process;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        /**
         * Process 'command line'
         *
         * > mysqldump --user='USERNAME' --password='PASSWORD' 'DATABASE' > 'OUTPUT_PATH'
         */
        if (env('BACKUP_DB_ACTIVE', false))
        {
            $mysqldump_path = env('MYSQLDUMP_PATH', 'mysqldump');
            $your_database_database = env('BACKUP_DB_DATABASE', 'homestead');
            $your_database_username = env('BACKUP_DB_USERNAME', 'homestead');
            $your_database_password = env('BACKUP_DB_PASSWORD', 'secret');
            $sql_output_path = env('BACKUP_OUTPUT_PATH', storage_path('backups\database.sql'));

            $this->process = new Process(sprintf(
                '%s --user=%s --password=%s %s > %s',
                $mysqldump_path,
                $your_database_username,
                $your_database_password,
                $your_database_database,
                $sql_output_path
            ));
        }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try
        {
            $this->process->mustRun();
            $this->info('The backup has been proceed successfully.');
        }
        catch (ProcessFailedException $exception)
        {
            $this->error('The backup process has been failed. Error Message: ' . $exception->getMessage());
        }
    }
}
