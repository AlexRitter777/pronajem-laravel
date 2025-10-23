<?php

namespace App\Dto\Tenant;

use Illuminate\Support\Arr;

readonly class StoreTenantData
{

    public string $name;
    public string $address;
    public ?string $email;
    public ?string $birthday;
    public ?string $phone;
    public ?string $account;

    public function __construct(public readonly array $tenantData){

        $this->name = Arr::get($tenantData, 'name');
        $this->address = Arr::get($tenantData, 'address');
        $this->email = Arr::get($tenantData, 'email');
        $this->birthday = Arr::get($tenantData, 'birthday');
        $this->phone = Arr::get($tenantData, 'phone_number');
        $this->account = Arr::get($tenantData, 'account_number');

    }

}
