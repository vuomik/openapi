<?php

namespace POC\Models;

/**
 * @OA\Schema(
 *  description="A person's profile in our system",
 *  title="Person",
 *  required={"name", "address", "email"}
 * )
 */
class Person
{
    public function __construct(
        /**
         * @var GivenName
         * 
         * @OA\Property(
         *  description="Name",
         *  title="firstname"
         * )
         */
        public GivenName $name = new GivenName(),

        /**
         * @var Address
         * 
         * @OA\Property(
         *  description="Address",
         *  title="address"
         * )
         */
        public Address $address = new Address(),

        /**
         * @var string
         * 
         * @OA\Property(
         *  description="Email Address",
         *  title="email",
         *  example="john.doe@example.com",
         *  format="email"
         * )
         */
        public string $email = '',
    ) {}
}