<?php

namespace App\Livewire;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginPage extends Component
{
    public $emailInput;
    public $passwordInput;

    public function loginProcess(Request $request){

        $cred = [
            'email' => $this->emailInput,
            'password' => $this->passwordInput
        ];

        if (!Auth::attempt($cred)){
            session()->flash('errorLogin');
            return $this->redirect('/login');
        }

        $request->session()->regenerate();

//        if (\auth()->user()->role == 'operator'){
//            return redirect('/dashboard');
//        }
        return redirect('/dashboard');
    }

    public function render()
    {
        return view('livewire.login-page');
    }
}
