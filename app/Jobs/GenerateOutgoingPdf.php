<?php

namespace App\Jobs;

use App\Models\Outgoing;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateOutgoingPdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $outgoingId;

    public function __construct(int $outgoingId)
    {
        $this->outgoingId = $outgoingId;
    }

    public function handle(): void
    {
        $outgoing = Outgoing::find($this->outgoingId);
        if ($outgoing) {
            $outgoing->generatePdf();
        }
    }
}
