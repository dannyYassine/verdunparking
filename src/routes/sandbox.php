<?php

use App\UseCases\CallCityUseCase;
use App\Utils\DI;
use App\Utils\Twilio\TwilioVoiceUtil;

(new CallCityUseCase(new TwilioVoiceUtil()))->execute(new \App\Requests\CallBeachRequest());
