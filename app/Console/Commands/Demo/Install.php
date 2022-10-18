<?php

namespace App\Console\Commands\Demo;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Container\Container;
use Illuminate\Contracts\Filesystem\Factory;
use Illuminate\Http\FileHelpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Symfony\Component\Console\Command\Command as CommandAlias;

class Install extends Command
{
    use FileHelpers;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install demo data';

    /**
     * @var string[][]
     */
    protected array $categoryData = [
        ['name' => 'Digital Books'],
        ['name' => 'Paper Books']
    ];

    /**
     * @var array|array[]
     */
    protected array $productData = [
        [
            'name' => 'Digital Book',
            'description' => 'Digital Book description',
            'price' => 15.25,
            'image' => 'digital_book.jpg',
            'category' => [1]
        ],
        [
            'name' => 'Print Book',
            'description' => 'Print Book description',
            'price' => 12.75,
            'image' => 'paper_book.jpg',
            'category' => [2]
        ],
        [
            'name' => 'Book in two variants',
            'description' => 'Book in two variants description',
            'price' => 25.50,
            'image' => 'book_in_two_variants.jpg',
            'category' => [1, 2]
        ],
    ];

    /**
     * @var array|array[]
     */
    protected array $userData = [
        [
            'username' => 'admin',
            'email' => 'admin@test.com',
            'password' => 'test@123',
            'type' => User::ADMIN_TYPE,
            'full_name' => 'Store Admin'
        ]
    ];

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $confirmation = $this->ask('This command will delete all categories, products and users.
        Are you sure you wish to continue? [yes/no]');

        if (strtolower($confirmation) == 'yes') {
            $this->createCategories();
            $this->createProducts();
            $this->createUsers();
            return CommandAlias::SUCCESS;
        }

        return CommandAlias::FAILURE;
    }

    private function createCategories(): void
    {
        Category::query()->truncate();
        foreach ($this->categoryData as $categoryDatum) {
            Category::query()->create($categoryDatum);
        }
    }

    private function createProducts()
    {
        Product::query()->truncate();
        DB::table('category_product')->truncate();
        foreach ($this->productData as $productDatum) {
            $imagePath = Container::getInstance()->make(Factory::class)->disk('public')
                ->putFileAs(
                    'product_images',
                    public_path('demo/images/') . $productDatum['image'],
                    $productDatum['image']
                );

            Image::make(public_path('storage/') . $imagePath)
                ->fit(1000, 1000)
                ->save();

            $productDatum['image'] = $imagePath;

            $product = Product::create($productDatum);
            $product->categories()->toggle($productDatum['category']);
        }
    }

    private function createUsers()
    {
        User::query()->truncate();
        foreach ($this->userData as $userDatum) {
            $userDatum['password'] = Hash::make($userDatum['password']);
            User::create($userDatum);
        }
    }
}
