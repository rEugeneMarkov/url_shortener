<?php

namespace App\Jobs;

use App\Models\Link;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\LocationFinder\LocationFinderService;
use App\Services\TransitionsService\TransitionsService;
use App\Services\UserAgentParser\UserAgentParserService;

class CreateTransition implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private Link $link,
        private array $data
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(
        LocationFinderService $locationService,
        UserAgentParserService $userAgentParser,
        TransitionsService $transitionsService,
    ): void {
        $geoData = $locationService->getGeoDataByIp($this->data['ipAddress']);

        $userAgentData = $userAgentParser
            ->userAgent($this->data['userAgent'])
            ->getUserAgentData();

        $transitionsService = app()->make(TransitionsService::class);
        $transitionsService
            ->createTransition()
            ->transitionable($this->link)
            ->setLocationData($geoData->toArray())
            ->setUserAgentData($userAgentData->toArray())
            ->run();
    }
}
