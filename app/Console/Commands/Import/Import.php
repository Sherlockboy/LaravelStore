<?php

namespace App\Console\Commands\Import;

use Illuminate\Console\Command;
use Psy\Readline\Hoa\FileDoesNotExistException;
use Symfony\Component\Console\Command\Command as CommandAlias;

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
            $this->output->error($exception->getMessage());
            return CommandAlias::FAILURE;
        }

        return $this->import($data);
    }

    /**
     * @param array $errors
     * @param string $entityName
     * @return int
     */
    public function processErrorsIfExist(array $errors, string $entityName): int
    {
        if($errors) {
            $this->output->text(__("There were errors during $entityName import:"));
            foreach ($errors as $error) {
                $this->output->error($error);
            }

            return CommandAlias::FAILURE;
        } else {
            $this->output->text(__("$entityName import finished successfully"));
            return CommandAlias::SUCCESS;
        }
    }

    /**
     * @param array $data
     * @return int
     */
    abstract public function import(array $data): int;
}
