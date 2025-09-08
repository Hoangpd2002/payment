<?php

namespace hoangpd\payment\Commands;

use Illuminate\Console\Command;

class paymentCommand extends Command
{
    public $signature = 'payment';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
