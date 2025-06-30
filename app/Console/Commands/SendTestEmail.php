<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\AuthEmail;
use Illuminate\Support\Facades\Mail;

class SendTestEmail extends Command
{
    protected $signature = 'email:test';
    protected $description = 'Send a test email';

    public function handle()
    {
        Mail::to('recipient@example.com')->send(new AuthEmail());
        $this->info('Test email sent successfully!');
    }
}