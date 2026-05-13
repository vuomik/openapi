<?php

namespace POC\Models;

/**
 * @OA\Schema(
 *  description="A properly-typed address",
 *  title="Address",
 *  required={"street", "city", "state", "zip"}
 * )
 */
class Address
{
    public function __construct(
        /**
         * @var string
         * 
         * @OA\Property(
         *  format="string",
         *  description="Building/House number and street",
         *  example="10 Exchange Place",
         *  title="street"
         * )
         */
        public string $street = '',

        /**
         * @var string
         * 
         * @OA\Property(
         *  format="string",
         *  description="City or locality",
         *  example="Jersey City",
         *  title="city"
         * )
         */
        public string $city = '',

        /**
         * @var string
         * 
         * @OA\Property(
         *  format="us-state",
         *  description="US State",
         *  example="NJ",
         *  title="street"
         * )
         */
        public string $state = '',

        /**
         * @var string
         * 
         * @OA\Property(
         *  format="us-zip",
         *  description="US 5-digit zip code",
         *  example="07302",
         *  title="street"
         * )
         */
        public string $zip = '',
    ) {}
}