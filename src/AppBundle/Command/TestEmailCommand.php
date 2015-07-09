<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Manager\MailManager;

/**
 * Class TestCommand
 *
 * @category Command
 * @package  AppBundle\Command
 * @author   David Romaní <david@flux.cat>
 */
class TestEmailCommand extends ContainerAwareCommand
{
    /**
     * Configure command
     */
    protected function configure()
    {
        $this
            ->setName('tuijodisseny:test:email')
            ->setDescription('Test SMTP email delivery config')
        ;
    }

    /**
     * Command process
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return null|int null or 0 if everything went fine, or an error code
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Tu&Jo Disseny Test Email Command</info>');
        /** @var MailManager $mm */
        $mm = $this->getContainer()->get('app.manager.mail');
        $mm->doTestEmailCommandDelivery();
        $output->writeln('<info>--- test finished</info>');

        return 0;
    }
}
