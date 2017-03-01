<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTest extends DuskTestCase {

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testValidRegister() {
        $this->browse(function ($browser) {
            $browser->visit($this->getUrl('register'))
                    ->assertSee('Register')
                    ->type('first_name', 'Billy')
                    ->type('last_name', 'Mahmood')
                    ->type('email', 'billy@e3creative.co.uk')
                    ->type('password', 'testtest')
                    ->type('password_confirmation', 'testtest')
                    
                    ->type('address_line1', '23 Cool street')
                    ->type('address_line2', 'longsight')
                    ->type('city', 'Manchester')
                    ->type('postcode', 'M13 0GH')
                    
                    ->press('Register')
                    ->assertSee('Dashboard')
                    ->clickLink('Logout')
                    ->pause(1000)
            ;
        });
    }
    
    /**
     * test to check the validation for dupe email
     * 
     * @return void
     */
    public function testDupeEmailRegister() {
        $this->browse(function ($browser) {
            $browser->pause(1000);
            $browser->visit($this->getUrl('register'))
                    ->assertSee('Register')
                    ->type('first_name', 'Billy')
                    ->type('last_name', 'Mahmood')
                    ->type('email', 'billy@e3creative.co.uk')
                    ->type('password', 'testtest')
                    ->type('password_confirmation', 'testtest')
                    
                    ->type('address_line1', '23 Cool street')
                    ->type('address_line2', 'longsight')
                    ->type('city', 'Manchester')
                    ->type('postcode', 'M13 0GH')
                    ->pause(1000)
                    ->press('Register')
                    ->assertSee('The email has already been taken.')
            ;
        });
    }
    
    public function testErrorsOnRegister() {
        $this->browse(function ($browser) {
            $browser->pause(1000);
            $browser->visit($this->getUrl('register'))
                    ->assertSee('Register')
                    ->type('first_name', '')
                    ->type('last_name', 'Mahmood')
                    ->type('email', '')
                    ->type('password', 'testtest')
                    ->type('password_confirmation', 'testtest')
                    
                    ->type('address_line1', '23 Cool street')
                    ->type('address_line2', 'longsight')
                    ->type('city', 'Manchester')
                    ->type('postcode', 'M13 0GH')
                    ->pause(1000)
                    ->press('Register')
                    ->assertSee('The first name field is required.')
                    ->assertSee('The email field is required.')
            ;
        });
    }

}
