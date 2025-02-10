<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class CanceledOrderException extends Exception
{
    public function __construct(
        ?string $message = 'O Pedido excedeu o prazo de 7 dias para cancelamento.',
        int $code = Response::HTTP_BAD_REQUEST,
        ?Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
