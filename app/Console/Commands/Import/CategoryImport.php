<?php

namespace App\Console\Commands\Import;

use App\Models\Category;
use Illuminate\Console\Command;

class CategoryImport extends Import
{
    const ENTITY_NAME = 'Category';

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
    protected $description = 'Import categories from csv file';

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

        return $this->processErrorsIfExist($errors, self::ENTITY_NAME);
    }
}
