<?php

namespace App\Providers;

use App\UseCases\CallCityUseCase;
use App\UseCases\GetBeachStatusUseCase;
use App\UseCases\InterpretRecordingUseCase;
use App\Utils\Twilio\TwilioVoiceUtil;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(InterpretRecordingUseCase::class, function () {
            return new InterpretRecordingUseCase();
        });

        $this->app->bind(CallCityUseCase::class, function () {
            return new CallCityUseCase(new TwilioVoiceUtil());
        });

        $this->app->bind(GetBeachStatusUseCase::class, function () {
            return new GetBeachStatusUseCase();
        });
    }
}
