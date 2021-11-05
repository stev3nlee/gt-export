<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Mail;

class expiredNewArrival extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expired:new';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'remove new arrival';

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
        $data =  Product::whereNotNull('new_arrival_expired_date')->where('new_arrival_expired_date','<',date('Y-m-d H:i:s'))->get();

        foreach($data as $list){
            $list->new_arrival_expired_date = null;
            $list->new_arrival_days = 0;
            $list->save();
        }

    }
}
