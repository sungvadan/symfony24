<?php

namespace Yoda\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/register');
        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Register', $response->getContent());
        $usernameVal = $crawler->filter('#register_form_username')->attr('value');
        $this->assertEquals($usernameVal, 'Leia');

        $form = $crawler->selectButton('Submit')->form();
        $crawler = $client->submit($form);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertRegExp(
            '/This value should not be blank./',
            $client->getResponse()->getContent()
        );

        $form = $crawler->selectButton('Submit')->form();
        $form['register_form[username]'] = 'cp30';
        $form['register_form[email]'] = 'cp30@deathstars.com';
        $form['register_form[plainPassword][first]'] = 'Cp30';
        $form['register_form[plainPassword][second]'] = 'Cp30';

        $crawler = $client->submit($form);
        $this->assertTrue($client->getResponse()->isRedirect());
        $client->followRedirect();
        $this->assertContains('Welcome to the death star. Have a nice day',  $client->getResponse()->getContent());
    }
}
