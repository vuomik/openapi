<?php

namespace POC\Models;

/**
 * @OA\Schema(
 *  description="Response Message",
 *  title="Response",
 *  required={"message"}
 * )
 */
class Response
{
    public function __construct(
        /**
         * @var string
         * 
         * @OA\Property(
         *  description="Response Message",
         *  example="Qapla'",
         *  title="message"
         * )
         */
        public string $message = '',
    ) {}
}