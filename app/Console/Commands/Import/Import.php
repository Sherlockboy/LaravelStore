<?php

namespace App\Console\Commands\Import;

use Illuminate\Console\Command;
use Psy\Readline\Hoa\FileDoesNotExistException;

abstract class Import extends Command
{
    /**
     * @return array
     * @throws FileDoesNotExistException
     */
    public function readCSV(): array
    {
        $filename = $this->option('filename') ?? $this->ask('Enter filaname');
        $filePath = storage_path('app/public/import/' . $filename);
        $data = [];

        if (file_exists($filePath)) {
            $file = fopen($filePath, 'r');
            while (($line = fgetcsv($file)) !== false) {
                $data[] = $line;
            }
        } else {
            throw new FileDoesNotExistException("File $filename does not exist");
        }

        return $data;

    }

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function handle(): int
    {
        try {
            $data = $this->readCSV();
        } catch (FileDoesNotExistException $exception) {
            $this->output->text($exception->getMessage());
            return Command::FAILURE;
        }

        return $this->import($data);
    }

    abstract public function import(array $data);
}