<?php

namespace App\Livewire\Forms\Dashboard;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{
    public $name;
    public $birthday;

    #[Validate]
    public $username;

    #[Validate]
    public $email;
    public $gender;

    #[Validate]
    public $phone;


    #[Validate]
    public $password;

    #[Validate]
    public $password_confirmation;
    public $address;

    protected function rules() 
    {
        return [
            'username' => 'required|unique:users,username',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'name' => 'required|max:20',
            'birthday' => 'required|date',
            'gender' => 'required',
            'phone' => 'required|unique:users,phone|min_digits:10|max_digits:14',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|confirmed:password',
        ];
    }

    protected function messages() 
    {
        return [
            'username.required' => 'Harap masukan username.',
            'username.unique' => 'Username sudah digunakan.',
            'email.required' => 'Harap masukan email.',
            'email.email' => 'Harap masukan email yang valid.',
            'email.unique' => 'Email sudah digunakan.',
            'name.required' => 'Harap masukan nama panggilan.',
            'name.max' => 'Nama panggilan maksimal 20 karakter.',
            'birthday.required' => 'Harap masukan tanggal lahir.',
            'birthday.date' => 'Tanggal lahir tidak valid.',
            'gender.required' => 'Harap pilih jenis kelamin.',
            'phone.required' => 'Harap masukan nomor whatsapp.',
            'phone.unique' => 'Nomor whatsapp sudah digunakan.',
            'phone.min_digits' => 'Nomor whatsapp tidak valid.',
            'phone.max_digits' => 'Nomor whatsapp tidak valid.',
            'phone.numeric' => 'Nomor whatsapp tidak valid.',
            'password.required' => 'Harap masukan password.',
            'password.min' => 'Password minimal 6 karakter.',
            'password_confirmation.required' => 'Harap ulangi password.',
            'password_confirmation.min' => 'Password minimal 6 karakter.',
            'password_confirmation.confirmed' => 'Password tidak sesuai.',
        ];
    }

    public function store()
    {
        $this->validate();

        $this->password = Hash::make($this->password);

        User::create(
            $this->only([
                'username',
                'email', 
                'name', 
                'birthday', 
                'gender',  
                'phone',
                'address',
                'password'
            
            ]),
        );

    }
}
