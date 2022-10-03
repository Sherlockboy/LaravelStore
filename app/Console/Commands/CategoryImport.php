<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;

class CategoryImport extends Command
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
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filename = $this->option('filename') ?? $this->ask('Enter filaname');

        $filePath = storage_path('app/public/import/' . $filename);

        if (file_exists($filePath)) {
            $data = [];
            $file = fopen($filePath, 'r');
            while (($line = fgetcsv($file)) !== false) {
                $data[] = $line;
            }
        }

        $errors = [];

        $headers = array_shift($data);
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
        } else {
            $this->output->text(__('Import finished'));
        }

        return Command::SUCCESS;
    }
}
