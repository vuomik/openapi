<?php

namespace POC\Models;

/**
 * @OA\Schema(
 *  description="This is a person's given name",
 *  title="Given Name",
 *  required={"first", "last"}
 * )
 */
class GivenName
{
    public function __construct(
        /**
         * @var string
         * 
         * @OA\Property(
         *  format="string",
         *  description="First Name",
         *  example="John",
         *  title="first"
         * )
         */
        public string $first = '',

        /**
         * @var string
         * 
         * @OA\Property(
         *  format="string",
         *  description="Last Name",
         *  example="Doe",
         *  title="last"
         * )
         */
        public string $last = '',
    ) {}
}