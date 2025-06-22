<?php

namespace App\Traits;

use Throwable;

trait ResponseJson
{
    public function jsonResponse(int $status, string $message, mixed $data = null)
    {
        echo json_encode([
            "status" => $status,
            "message" => $message,
            "data" => $data
        ]);
    }

    public function internalErrorResponse(string $message, Throwable $th)
    {
        logger()->error($message, [
            'exception_message' => $th->getMessage(),
            'file' => $th->getFile(),
            'line' => $th->getLine(),
            'trace' => $th->getTraceAsString(),
        ]);

        echo json_encode([
            "status" => 500,
            "message" => 'Falha ao processar solicitação. Tente novamente mais tarde',
        ]);
    }
}
