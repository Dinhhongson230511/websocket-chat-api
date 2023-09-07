<?php
namespace App\Jobs;

use App\Models\Channel;
use App\Services\Admin\ChannelService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UnreadCountQueue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $channelOn;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Channel $channelOn)
    {
        $this->channelOn = $channelOn;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $channelService = app(ChannelService::class);
        $channelService->updateCountToRead($this->channelOn);
    }
}
