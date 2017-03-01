<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTest extends DuskTestCase {

    /**
     * Visit register page and make sure we see the text register
     * 
     * @return void
     */
    public function testRegisterPage() {
        return $this->browse(function ($browser) {
            $browser
                ->visit($this->getUrl('register'))
                ->assertSee('Register');
        });
    }
    
    /**
     * Run a valid register test
     *
     * @return void
     */
    public function testValidRegister() {
        $this->browse(function ($browser) {
            $browser
                ->visit($this->getUrl('register'))
                ->assertSee('Register');
            
            $this->getRegisterTest($browser)
                    ->press('Register')
                    ->assertSee('Dashboard')
                    ->clickLink('Logout')
                    ->pause(1000);
        });
    }
    
    /**
     * test to check the validation for dupe email
     * 
     * @return void
     */
    public function testDupeEmailRegister() {
        $this->browse(function ($browser) {
            $browser
                ->visit($this->getUrl('register'))
                ->assertSee('Register');
            
            $this->getRegisterTest($browser)
                    ->press('Register')
                    ->assertSee('The email has already been taken.')
            ;
        });
    }
    
    /**
     * test register for validation on missing fields
     * 
     * @return void
     */
    public function testErrorsOnRegister() {
        $this->browse(function ($browser) {
            $browser
                ->visit($this->getUrl('register'))
                ->assertSee('Register');
            
            $this->getRegisterTest($browser)
                    ->type('first_name', '')
                    ->type('email', '')
                    ->press('Register')
                    ->assertSee('The first name field is required.')
                    ->assertSee('The email field is required.')
            ;
        });
    }

    /**
     * Test the password and confirm password
     * 
     * @return void
     */
    public function testPasswordMatchingRegister() {
        $this->browse(function ($browser) {
            $browser
                ->visit($this->getUrl('register'))
                ->assertSee('Register');
            
            $this->getRegisterTest($browser)
                    ->type('password', 'test12')
                    ->type('password_confirmation', 'test123')
                    ->type('email', 'omar@e3creative.co.uk')
                    ->press('Register')
                    ->assertSee('The password confirmation does not match.')
            ;
        });
    }
    
    /**
     * Get the register page data
     * 
     * @param type $browser
     * @return type
     */
    protected function getRegisterTest($browser) {
         return $browser
                    ->type('first_name', 'Billy')
                    ->type('last_name', 'Mahmood')
                    ->type('email', 'billy@e3creative.co.uk')
                    ->type('password', 'testtest')
                    ->type('password_confirmation', 'testtest')
                    ->type('address_line1', '23 Cool street')
                    ->type('address_line2', 'longsight')
                    ->type('city', 'Manchester')
                    ->type('postcode', 'M13 0GH');
    }
}
