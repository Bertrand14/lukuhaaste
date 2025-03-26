<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AccountInfo extends Component
{

    public $username, $firstName, $lastName, $address, $email;
    /**
     * Create a new component instance.
     */
    public function __construct($username, $firstName, $lastName, $address, $email)
    {
        $this->username = $username;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->address = $address;
        $this->email = $email;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.account-info');
    }
}
