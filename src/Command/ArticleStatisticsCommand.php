<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ArticleStatisticsCommand extends Command
{
    protected static $defaultName = 'app:article-statistics';
    protected static $defaultDescription = 'Article statistics';

    protected function configure(): void
    {
        $this
            ->setDescription('Show an article statistics')
            ->addArgument('slug', InputArgument::REQUIRED, 'Symbol code (slug)')
            ->addOption('format', null, InputOption::VALUE_REQUIRED, 'Output format', 'text')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $slug = $input->getArgument('slug');

        $data = [
            'slug' => $slug,
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'likes' => random_int(10, 100)
        ];

        switch ($input->getOption('format')) {
            case 'text':
                $io->title($data['slug']);
                $io->listing($data);
                break;
            case 'json':
                $io->write(json_encode($data) . "\n");
                break;
            default:
                throw new \Exception('Unknown format');
        }

        return Command::SUCCESS;
    }
}
