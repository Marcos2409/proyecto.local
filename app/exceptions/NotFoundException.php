<?php
namespace proyecto\app\exceptions;
use proyecto\app\exceptions\AppException;

class NotFoundException extends AppException {
    public function __construct(string $message = "", int $code = 404)
 {
 parent::__construct($message, $code);
 }

}