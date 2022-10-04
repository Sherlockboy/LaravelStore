<?php

namespace App\Console\Commands\Import;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;

class ProductImport extends Import
{
    const ENTITY_NAME = 'Product';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:product  {--f|filename=}';

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
    function import(array $data): int
    {
        $headers = array_shift($data);
        $errors = [];
        foreach ($data as $row) {
            $productData = array_combine($headers, $row);

            try {
                $categoryIds = $this->resolveCategoryIds($productData['categories']);
                Product::create($productData)->categories()->toggle($categoryIds);
            } catch (\Exception $exception) {
                $errors[] = $exception->getMessage();
            }
        }

        return $this->processErrorsIfExist($errors, self::ENTITY_NAME);
    }

    /**
     * @param string $categories
     * @return array
     */
    private function resolveCategoryIds(string $categories): array
    {
        $categoryNames = explode('|', $categories);
        $categories = Category::whereIn('name', $categoryNames)->get();

        return array_keys($categories->groupBy('id')->all());
    }
}
