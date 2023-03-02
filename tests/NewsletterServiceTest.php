<?php

namespace App\Tests;

use App\Service\NewsletterService;
use http\Env;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class NewsletterServiceTest extends KernelTestCase
{
    public function testSendMail(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());

        $newsletterService = static::getContainer()->get(NewsletterService::class);
        $emailTo = static::getContainer()->getParameter('mailer_test_to');

        $newsletterService->setData([
            'email' => $emailTo
        ]);
        $newsletterService->sendNotify();
    }
}
