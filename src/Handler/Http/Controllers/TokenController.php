<?php

namespace Coccoc\Handler\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Coccoc\Components\JsonProcessor\JsonProcessor;
use Coccoc\Components\JsonProcessor\JsonProcessorFactory;
use Coccoc\Validators\FileInfoValidator;
use Coccoc\Hydrators\FileInfoHydrator;
use Coccoc\Callbacks\TokenCreatorCallback;
use Coccoc\Validators\TokenValidator;
use Coccoc\Hydrators\TokenHydrator;
use Coccoc\Callbacks\TokenValidatorCallback;
use Coccoc\Callbacks\TokenRevokerCallback;
use Illuminate\Http\Response;

/**
 * Class TokenController
 * @package Coccoc\Handler\Http\Controllers
 */
class TokenController extends Controller
{
    /**
     * @var JsonProcessorFactory
     */
    private $jsonProcessorFactory;

    /**
     * @var JsonProcessor
     */
    private $jsonProcessor;

    /**
     * TokenController constructor.
     */
    public function __construct()
    {
        $this->jsonProcessorFactory = app(JsonProcessorFactory::class);
    }

    /**
     * @param Request $request
     * @param TokenCreatorCallback $callback
     * @return \Illuminate\Http\JsonResponse
     */
    public function generate(
        Request $request,
        TokenCreatorCallback $callback
    ) : JsonResponse
    {
        $this->jsonProcessor = $this->jsonProcessorFactory->create(
            app(FileInfoValidator::class),
            app(FileInfoHydrator::class),
            $callback
        );

        $result = $this->jsonProcessor->process($request->all());

        return response()->json($result->toArray(), !$result->hasError() ? Response::HTTP_OK : Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param Request $request
     * @param TokenValidatorCallback $callback
     * @return JsonResponse
     */
    public function check(
        Request $request,
        TokenValidatorCallback $callback
    ) : JsonResponse
    {
        $this->jsonProcessor = $this->jsonProcessorFactory->create(
            app(TokenValidator::class),
            app(TokenHydrator::class),
            $callback
        );

        $result = $this->jsonProcessor->process($request->all());

        return response()->json($result->toArray(), !$result->hasError() ? Response::HTTP_OK : Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @param Request $request
     * @param TokenRevokerCallback $callback
     * @return JsonResponse
     */
    public function revoke(
        Request $request,
        TokenRevokerCallback $callback
    ) : JsonResponse
    {
        $this->jsonProcessor = $this->jsonProcessorFactory->create(
            app(TokenValidator::class),
            app(TokenHydrator::class),
            $callback
        );

        $result = $this->jsonProcessor->process($request->all());

        return response()->json($result->toArray(), !$result->hasError() ? Response::HTTP_OK : Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
