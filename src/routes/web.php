<?php
/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use App\Events\ExampleEvent;
use App\UseCases\CallCityUseCase;
use App\UseCases\GetBeachStatusUseCase;
use App\UseCases\InterpretRecordingUseCase;
use App\Utils\DI;

$router->get('/', function () use ($router) {
    return view('index');
});

$router->group(['prefix' => 'api', 'middleware' => 'cors'], function () use ($router) {
    $router->get('/', function () use ($router) {
        return 'Welcome to the api!';
    });

    $router->get('/call', function () use ($router) {
        try {
            $service = DI::make(CallCityUseCase::class);
            return $service->execute();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    });

    $router->get('/transcribe', function () use ($router) {
        try {
            $service = DI::make(InterpretRecordingUseCase::class);
            return $service->execute();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    });

    $router->get('/status', function () use ($router) {
        try {
            $service = DI::make(GetBeachStatusUseCase::class);
            return json_encode(['data' => $service->execute()]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    });

    $router->get('/event', function () use ($router) {
        event(new ExampleEvent());
        return json_encode(['data' => 'sent']);
    });
});

$router->get('/sandbox', function () use ($router) {
    try {
        require __DIR__.'/sandbox.php';
        return json_encode(['data' => 'sandbox executed']);
    } catch (\Exception $e) {
        return json_encode([
            'error' => [
                'message' => $e->getMessage(),
                'trace' => $e->getTrace()
            ]
        ]);
    }
});


