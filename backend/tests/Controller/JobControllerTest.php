<?php 

namespace App\Tests\Controller;

use App\DataFixtures\AppFixtures;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Test\FixturesTrait;

class JobControllerTest extends WebTestCase
{
    private $client;
    
    public function setUp(): void
    {
        $this->client = static::createClient();
    }
    
    /**
     * We test that is a failure because the JWT token is missing
     *
     * @return void
     */
    public function testIndex(): void
    {
        $this->client->request('GET', '/api/jobs');

        $this->assertNotSame(200, $this->client->getResponse()->getStatusCode());
        $this->assertResponseHeaderSame('Content-Type', 'application/json');

        $responseData = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertIsArray($responseData);
    }
}
