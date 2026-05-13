<?php

namespace POC\Gateways;

class FakeDatabase 
{
    function fetchPersonById(int $id): object
    {
        return (object)[
            'name' => (object)[
                'first' => 'Mike',
                'last' => 'X',
            ],
            'address' => (object)[
                'street' => '1600 Pennsylvania Avenue NW',
                'city' => 'Washington',
                'state' => 'DC',
                'zip' => '20500',
            ],
            'email' => 'mike@example.com',
        ];
    }

    function createPerson(object $data): void
    {
        echo "Inserting into database\n";
        print_r($data);
    }

    function updatePerson(int $id, object $data): void
    {
        
    }
}
