<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Throwable;

class GeneralJsonException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->code = 422;
    }

    public function report()
    {
        //dump('report error');
    }

    /**
     * Render the exception as an HTTP response
     *
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return new JsonResponse([
            'errors' => [
                'message' => $this->getMessage()
            ]
        ]);
    }
}
