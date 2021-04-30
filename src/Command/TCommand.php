<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class TCommand extends Command
{
    protected static $defaultName = 't';
    protected static $defaultDescription = 'Add a short description for your command';

    private $userRepo;

    private $em;

    public function __construct(UserRepository $userRepo, EntityManagerInterface $em)
    {
        $this->userRepo = $userRepo;
        $this->em = $em;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addArgument('arg2', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');
        $arg2 = $input->getArgument('arg2');

        if ($input->getOption('option1')) {
            // ...
        }

        $user = $this->userRepo->findOneBy(['username' => $arg1]);

        if (is_null($user)) {
            $io->error('user ' . $arg1 . ' not found!');
            return 1;
        }

        if ($arg1) {
            $io->note(sprintf('username: %s', $arg1));
        }


        if ($arg2) {
            $io->note(sprintf('role: %s', $arg2));
        }

        $role = 'ROLE_' . strtoupper($arg2);
        // will use role hierarchy instead of giving many roles to each user
        $user->setRoles([$role]);
        $this->em->persist($user);
        $this->em->flush();

        $io->success('SUCCESS!');

        return Command::SUCCESS;
    }
}
