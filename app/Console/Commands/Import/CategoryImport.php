<?php

namespace App\Console\Commands\Import;

use App\Models\Category;
use Illuminate\Console\Command;

class CategoryImport extends Import
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:categories {--f|filename=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';



    /**
     * @param array $data
     * @return int
     */
    public function import(array $data): int
    {
        $headers = array_shift($data);
        $errors = [];
        foreach ($data as $row) {
            try {
                Category::create(
                    array_combine($headers, $row)
                );
            } catch (\Exception $exception) {
                $errors[] = $exception->getMessage();
            }
        }


        if($errors) {
            $this->output->text(__('There were errors during import:'));
            foreach ($errors as $error) {
                $this->output->error($error);
            }

            return Command::FAILURE;
        } else {
            $this->output->text(__('Import finished'));
            return Command::SUCCESS;
        }
    }
}
