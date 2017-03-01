<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase {

    public function testInvalidLoginAttempt() {
        $this->browse(function($browser) {
            $browser->visit($this->getUrl('login'))
                    ->type('email', 'jake@e3creative.co.uk')
                    ->type('password', 'testtest')
                    ->press('Login')
                    ->assertSee('These credentials do not match our records.');
        });
    }
    
    public function testAttemptLogin() {
        $this->browse(function($browser) {
            $browser->visit($this->getUrl('login'))
                    ->type('email', 'dan@e3creative.co.uk')
                    ->type('password', 'testtest')
                    ->press('Login')
                    ->assertSee('Dashboard');
        });
    }

    public function logout() {
        $this->browse(function($browser) {
            $browser->clickLink('Logout')
                    ->pause(1000)
                    ->assertSee('Laravel');
        });
    }

    

}
