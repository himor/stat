<?php

/**
 * Class SecurityControllerTest
 * Testing the Security Controller functionality
 * @author Mike Gordo <mgordo@live.com>
 */
class SecurityControllerTest extends TestCase {

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        User::where('email', 'email1@mail.com')
            ->orWhere('email', 'email2@mail.com')->delete();
    }

	/**
	 * Testing the Login page
	 *
	 * @return void
	 */
	public function testLoginPage()
	{
		$crawler = $this->client->request('GET', 'login');

		$this->assertTrue($this->client->getResponse()->isOk());
        $this->assertCount(1, $crawler->filter('h3:contains("Authentication required")'));
        $this->assertCount(3, $crawler->filter('div.item'));
        $this->assertCount(0, $crawler->filter('div.alert'));
	}

    /**
     * Testing the Logout page
     *
     * @return void
     */
    public function testLogoutPage()
    {
        $crawler = $this->client->request('GET', 'logout');

        $this->assertTrue($this->client->getResponse()->isRedirect());
    }

    /**
     * Create exactly two dummy users
     */
    public function testCreateUsers()
    {
        User::create(array(
            'email'    => 'email1@mail.com',
            'password' => Hash::make('silk'),
            'name'     => 'John Smith'
        ));

        User::create(array(
            'email'    => 'email1@mail.com',
            'password' => Hash::make('worm'),
            'name'     => 'Bob Smith'
        ));

        $users = User::where('name', 'like', '%bob%')->get();
        $this->assertCount(1, $users);

        $users = User::where('email', 'email1@mail.com')->get();
        $this->assertCount(2, $users);
    }

    /**
     * Check password hashing
     */
    public function testPasswords()
    {
        $user = User::create(array(
            'email'    => 'email1@mail.com',
            'password' => Hash::make('silk'),
            'name'     => 'Alex Jones'
        ));

        $this->assertNotNull($user->id);

        $user = User::where('name', 'Alex Jones')->first();

        $this->assertTrue(Hash::check('silk', $user->password));
    }

    /**
     * Check the login / logout procedures
     */
    public function testLogin()
    {
        User::create(array(
            'email'    => 'email2@mail.com',
            'password' => Hash::make('silks'),
            'name'     => 'Sam Jones'
        ));

        $this->assertFalse(Auth::check());

        $response = $this->action('POST', 'SecurityController@loginAttempt', array(
            'email'    => 'email2@mail.com',
            'password' => 'silks'
            )
        );

        $this->assertTrue($response->isRedirect());
        $this->assertTrue(Auth::check());

        $response = $this->action('GET', 'SecurityController@logoutAction');

        $this->assertFalse(Auth::check());
    }





}