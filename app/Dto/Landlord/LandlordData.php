<?php

namespace App\Dto\Landlord;

use Illuminate\Support\Arr;

readonly class LandlordData
{

    public string $name;
    public string $address;
    public ?string $email;
    public ?string $birthday;
    public ?string $phone;
    public ?string $account_number;

    public function __construct(public readonly array $landlordData){

        $this->name = Arr::get($landlordData, 'name');
        $this->address = Arr::get($landlordData, 'address');
        $this->email = Arr::get($landlordData, 'email');
        $this->birthday = Arr::get($landlordData, 'birthday');
        $this->phone = Arr::get($landlordData, 'phone');
        $this->account_number = Arr::get($landlordData, 'account_number');

    }

}
