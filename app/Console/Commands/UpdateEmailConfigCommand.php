<?php

namespace App\Console\Commands;

use App\Models\Admin\EmailConfig;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UpdateEmailConfigCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:config:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update email configuration in .env file';

    /**
     * Execute the console command.
     */

    public function handle()
    {
        $emailConfig = EmailConfig::first();

        File::put('.env', [
            'MAIL_MAILER=' . $emailConfig->driver,
            'MAIL_HOST=' . $emailConfig->host,
            'MAIL_PORT=' . $emailConfig->port,
            'MAIL_USERNAME=' . $emailConfig->email_username,
            'MAIL_PASSWORD=' . $emailConfig->email_password,
            'MAIL_ENCRYPTION=' . $emailConfig->encryption,
            'MAIL_FROM_ADDRESS=' . $emailConfig->sender_mail,
        ]);
    }
}
