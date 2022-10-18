<?php

namespace App\Console\Commands\Demo;

use App\Models\Address;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\WishlistItem;
use Illuminate\Console\Command;
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;
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
        ],
        [
            'username' => 'test',
            'email' => 'test@test.com',
            'password' => 'test@123',
            'type' => User::USER_TYPE,
            'full_name' => 'Store User'
        ],
    ];

    /**
     * @var array[]
     */
    protected array $addressData = [
        [
            'user_id' => 1,
            'title' => 'Default UK Address',
            'full_name' => 'Store Admin',
            'country' => 'United Kingdom',
            'city' => 'London',
            'street' => 'Conan Doyle str, 14-08',
            'zip' => 'CB25',
            'phone' => '+44 111 11 11',
            'is_default' => 1,
        ],
        [
            'user_id' => 2,
            'title' => 'Default US Address',
            'full_name' => 'Store User',
            'country' => 'USA',
            'city' => 'New York',
            'street' => 'Ray Douglas Bradbury str, 45-1',
            'zip' => '10001',
            'phone' => '+212 111 11 11',
            'is_default' => 1,
        ],
    ];

    /**
     * Truncate most of the tables and install demo data
     *
     * @return int
     * @throws BindingResolutionException
     */
    public function handle(): int
    {
        $confirmation = $this->confirm('This command will delete all data - categories, products, users, 
        addresses, etc. Are you sure you wish to continue?');

        if ($confirmation) {
            $this->truncateTables();
            $this->createCategories();
            $this->createProducts();
            $this->createUsers();
            $this->createAddresses();

            $this->output->writeln('Demo data successfully installed');
            return CommandAlias::SUCCESS;
        }

        return CommandAlias::FAILURE;
    }

    /**
     * @return void
     */
    private function createCategories(): void
    {
        Category::query()->truncate();
        foreach ($this->categoryData as $categoryDatum) {
            Category::query()->create($categoryDatum);
        }
    }

    /**
     * @return void
     * @throws BindingResolutionException
     */
    private function createProducts(): void
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

            /** @var Product $product */
            $product = Product::create($productDatum);
            $product->categories()->attach($productDatum['category']);
        }
    }

    /**
     * @return void
     */
    private function createUsers(): void
    {
        User::query()->truncate();
        foreach ($this->userData as $userDatum) {
            $userDatum['password'] = Hash::make($userDatum['password']);
            User::create($userDatum);
        }
    }

    /**
     * @return void
     */
    private function createAddresses(): void
    {
        Address::query()->truncate();
        foreach ($this->addressData as $addressDatum) {
            Address::create($addressDatum);
        }
    }

    /**
     * Delete carts, orders and wishlists
     *
     * @return void
     */
    private function truncateTables(): void
    {
        Cart::query()->truncate();
        CartItem::query()->truncate();

        Order::query()->truncate();
        OrderItem::query()->truncate();

        Wishlist::query()->truncate();
        WishlistItem::query()->truncate();
    }
}
