<?php

namespace App\Livewire;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use LdapRecord\Connection;
use LdapRecord\Container;
use LdapRecord\Models\OpenLDAP\User as OpenLDAPUser;
use Livewire\Component;

class LoginForm extends Component
{
    public $username;
    public $password;
    public $user;

    public function render()
    {
        return view('livewire.login-form');
    }

    public function login(){
        // dd(OpenLDAPUser::where('uid', 'Jardel Regis')->get());

        try{
            $connection = Container::getConnection('default');
            $this->user = User::where('Username', $this->username)->first(); //Gets user
    
            if ($this->user){ //If user is found..
                $ADuser = $connection->query()->where('samaccountname', '=', $this->username)->first(); //Gets user from AD
                // dd($ADuser);
                if ($connection->auth()->attempt($ADuser['distinguishedname'][0], $this->password) && !$this->user->isLockedOut()){ //If password is correct and user is not locked out
                    $this->user->resetAttempts(); //Reset login attempts
                    Auth::login($this->user);
                    redirect()->route('/');
                }elseif ($this->user->isLockedOut()){ //Display message if user is locked out
                    $this->resetValidation();
                    $this->addError('error', 'User Locked Out');
                }elseif ($this->user->Attempts <= 2){
    
                    $this->password = null;
    
                    $this->user->incrementAttempts();
    
                    if ($this->user->Attempts == 3) { //Display locked out message if user has 3rd failed attempt
    
                        $this->user->lockAccount();
                        $this->resetValidation();
                        $this->addError('error', 'You have reached the maximum number of login attempts. You have been locked out');
                    } else { //Display message with attempts remaining
                        $this->resetValidation();
                        $attemptsleft = 3 - $this->user->Attempts;
                        $errormessage = 'Incorrect Password. Attempts remaining: ' . $attemptsleft;
                        $this->addError('password', $errormessage);
                    }
                }
            }
            else{ //Display error if no user is found
                $this->resetValidation();
                $this->addError('username', 'User not found');
            }
        }catch(Exception $e){
            dd('Error: Please contact IT at ext 11124', $e->getMessage());
        }
    }
}
