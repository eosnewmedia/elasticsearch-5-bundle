<?php
declare(strict_types=1);

namespace Enm\Bundle\Elasticsearch\Command;

use Enm\Elasticsearch\DocumentManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
class IndexDropCommand extends Command
{
    /**
     * @var DocumentManagerInterface
     */
    private $elasticsearch;

    /**
     * @param DocumentManagerInterface $elasticsearch
     * @throws \Exception
     */
    public function __construct(DocumentManagerInterface $elasticsearch)
    {
        parent::__construct('enm:elasticsearch:index:drop');

        $this->elasticsearch = $elasticsearch;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->elasticsearch->dropIndex();

        (new SymfonyStyle($input, $output))->success('Indices dropped.');
    }
}
