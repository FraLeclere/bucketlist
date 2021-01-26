<?php

namespace App\Command;

use App\Entity\Wish;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;

class InitTableWishCommand extends Command
{
    protected static $defaultName = 'init:table-wish';

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct();
    }



    protected function configure()
    {
        $this
            ->setDescription('Put 1 value in table wish')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $em = $this->entityManager;
        $wish = new Wish();
        $date = new \DateTime();

        $wish->setTitle("Work and live in Canada");
        $wish->setDescription("Bla bla bla bla");
        $wish->setAuthor("Arko");
        $wish->setIsPublished(true);
        $wish->setDateCreated($date);

        $em->persist($wish);

        $em->flush();

        $io->success('Your wish is on the database BRO !!');

        return Command::SUCCESS;
    }
}
