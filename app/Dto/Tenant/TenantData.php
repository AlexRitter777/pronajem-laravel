<?php

namespace App\Dto\Tenant;

use Illuminate\Support\Arr;

readonly class TenantData
{

    public string $name;
    public string $address;
    public ?string $email;
    public ?string $birthday;
    public ?string $phone;
    public ?string $account_number;

    public function __construct(public readonly array $tenantData){

        $this->name = Arr::get($tenantData, 'name');
        $this->address = Arr::get($tenantData, 'address');
        $this->email = Arr::get($tenantData, 'email');
        $this->birthday = Arr::get($tenantData, 'birthday');
        $this->phone = Arr::get($tenantData, 'phone');
        $this->account_number = Arr::get($tenantData, 'account_number');

    }

}
