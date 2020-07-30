<?php
require __DIR__ . '/constants.php';

use App\Requests\CallBeachRequest;
use App\UseCases\CallCityUseCase;
use App\UseCases\InterpretRecordingUseCase;

$callBeachUseCase = new CallCityUseCase();
$callBeachUseCase->execute(new CallBeachRequest());

//$interpretRecordingUseCase = new InterpretRecordingUseCase();
//$interpretRecordingUseCase->execute();;
