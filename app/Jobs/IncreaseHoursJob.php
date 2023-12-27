<?php

namespace App\Jobs;

use App\Models\PaymentModel;
use Illuminate\Bus\Queueable;
use App\Actions\IncreaseHoursAction;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Support\Facades\Log;

class IncreaseHoursJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $payment_id;

    public function __construct($payment_id)
    {
        $this->payment_id = $payment_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $payment=PaymentModel::find($this->payment_id);
        if ($payment->hours_added==false) {
            $res=IncreaseHoursAction::handle($payment->cliente->email,$payment->hours);
            if ($res->status_code==200){
                $payment->update(['hours_added'=>true]);
            }
            else {
                Log::error($res->body);
            }
        }
    }
}
