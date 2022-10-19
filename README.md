# This is demo store created using Laravel Framework.

## Important

I'm a PHP backend developer who is studying Laravel right now. All frontend (both CSS suing Tailwind and JS) is probably
a set of stupid workarounds and quality of frontend code is very low in general. The goal of this project was to study 
backend component of Laravel and create corresponding *backend* demo.

## Pages available for everyone (or `guest`)

### Homepage
Homepage contains list of all products with product image, name, price, product categories and `Add to cart` button.

You can navigate home page with link `Home` in header.

### Category page

Same as Homepage, but only products which are associated with that category are displayed.

You can navigate to category page using corresponding links in header or links under product name at 
Homepage or category page.

### Product page

Product page contains more detailed information about product - same as at Homepage/Category page +
product description. Authorized user (see below) will also have button `Add to wishlist` or `Remove from wishlist`.

### Cart

Cart contains products which were added to cart.

 - Left part contains table with information about each product in cart - image, name, price, quantity, subtotal. 
There are also buttons `Remove from cart` to the right of each product which allow to remove particular product 
from cart and `Clear Shopping Cart` below the table, which removes all products from cart. Item quantity can be changed 
using `+` and `-` buttons and by inserting desired amount into input.

 - Right part of cart page contains cart summary - Total price and link to Checkout page (see below).

Cart page can be accessed with link `Cart` in header.

### Checkout

Right part of checkout page contains order summary - list of all products in cart with image,
name, quantity, price and subtotal, final price and button `Place order`.

Left part of Checkout page looks different for authorized and unauthorized user. 

##### For Guest

Guest has form which allows to add delivery address information (`address form`) - Full name, Email, Country, City, Street, Zip and phone. 
This information will be saved not as `address` entity but as part of `order` entity itself.

##### For Authorized user

For authorized user this part is split into two different parts: 
 - Left part contains `address form` which allows to add new delivery address.
 - Right part contains simple selector which allows to select delivery address. When address is selected, address
details will be displayed under selector.

Ideally, I'd prefer to provide ability for customer to enter new address information without forcing 
customer to create new address entity, so there will be options - either select existent address or 
fill address information without creating address entity. But such implementation requires more advanced 
level of JS while this project is mostly a backend demo.

### Login/Register

These pages were created using OOB Laravel tools - so, nothing specific about them. The
only thing which is worth mentioning is that website has two different user types - `user` and `admin` - and
only `user` can be created using registration form. `admin` user can be created using custom CLI command (see below).

## Pages available for authorized user with type = `user`

`User` has access to all pages which are accessible by guest (except for `Login` and `Register` of course as `user` 
is already logged in) + access to user account pages:

### Account - My Account

The very left part of page has Account navigation bar with links to another user account pages (`user navigation`). 
`user navigation` is presented at all account pages.

Main part of account dashboard is split into two parts:
- Left parts contains form which allows to edit account information - username, email,
full name, password
- Right part displays `address form` with default address and allows to edit this address (if user has default address).
If there is no default address, this part will contain message about it and link to Account Addresses tab.

### Account - My orders
Right part contains table with list of all orders made by `user` sorted from newest to oldest. Each line contains some
basic information about order - date, status, price and delivery address details. Each line is clickable and leads to
order details page.

##### Account - Order details

This page contains order details:
 - Left part contains table with list of ordered products.
 - Right part contains order summary - Full price and delivery details.

### My Account - My addresses
This page contains all user addresses. Addresses are displayed in `address form` which allows to edit address right
here. It also contains empty `address form` which allows to add new Address.

### My Account - My Wishlist
If `user` added some products to his/her wishlist, this products will be displayed here, together with buttons
`Remove from wishlist` which allows to remove product from wishlist and `Add to cart` button.

If there are no products in wishlist, corresponding message will be displayed.

##  Pages available for authorized user with type = `admin`
`Admin` has access to all pages which are accessible by `user` + access to admin pages:

### Admin panel - Admin panel
The very left part of page has Admin navigation bar with links to another user Admin pages (`admin navigation`).
`admin navigation` is presented at all admin pages.

Admin panel can be accessed with link `Admin` in right part of header (this link is visible and
available only for `admin` users).

Main part of page is currently empty.

### Admin panel - Categories

Right bellow the header there is a button `Add new category` which leads to `category create` page.

This page also contains list of all categories with their id and name. Action column contains links `Edit` and `Delete`
which lead to `category edit` page or allow to delete category respectively.

Right now category doesn't have any attributes except for name. So only name is required to create new category and
only category name can be edited.

I thought about implementing category tree structure - when categories can have parent and child categories.
This is not something difficult from the backend point of view, but creating a user-friendly category navigation
is a nontrivial frontend task for me. Again, this project is mostly a backend demo.

### Admin panel - Products

Right bellow the header there is a button `Add new product` which leads to `product create` page.

This page contains list of all products with basic information  - id, image, name and categories. Action column contains
links `Edit` and `Delete` which lead to `product edit` page or allow to delete product respectively.

Product can be assigned to multiple categories at once.

### Admin panel - Orders

This page is similar to same page in user account (see *Account - My Orders*), but it contains list of ALL orders.
It also has additional information - order id, user id (replaced with 'Guest' if order was placed by `guest`) and
full name. Each line is clickable and leads to admin order details page.

##### Admin - Order details

Page looks same as account order details page (see *Account - order details*), but it also has form which allows to 
change order status (below order status). When order status is changed, corresponding email will be sent. 

Available statuses are: `pending`, `processing`, `completed` and `canceled`.

## CLI commands

### admin:create

Creates user with type = `admin`. This is the only way to create admin user right now (without direct interaction with 
database). Creation requires username, email, password and password confirmation.

### demo:install

## <span style="color: red"> Warning! </span> ## 
This command will delete ALL previously created entities - users, categories, products, carts, orders, wishlists.
Do not execute it unless you don't need such data.

Deploys sample data:
 - Two categories
 - Three products
 - Two users - one admin and one user
 - One address for each user

##### Demo admin user:

 - email: admin@test.com
 - password: test@123

##### Demo user:

 - email: test@test.com
 - password: test@123

## Notes about users

 - All routes related to user account are executed though Laravel OOB `auth` middleware and are
available only to authorized users. All user routes are located in `routes/user.php` file.
 - All admin routes are executed through custom `admin` middleware (`\App\Http\Middleware\AdminAccessCheck`) 
and are available only for user with type = `admin`. All admin routes are located in `routes/admin.php` file.
 - Admin order details and user order details are actually different views. So admin can edit order status ONLY
at `Admin - order details` page.

## Notes about cart/checkout
- User cart (as well as user wishlist) entity is created after user is created (see `\App\Models\User::boot`).
- Guest cart is created either when guest adds something to cart OR when guest opens cart page. 
Guest cart uses session id instead of user id. See `\App\Models\Cart::getCart` for more details.
- Carts are merged after login - all products from guest cart are moved to user cart (item quantity is 
appended if user cart and guest cart contain same product). Guest cart is deleted after merge. Merge is called in
`\App\Http\Controllers\Auth\AuthenticatedSessionController::store` and executed in `\App\Models\Cart::merge`.
- When user adds to cart product which is already in cart, product quantity will be increased by 1.
- When user removes product from cart, whole cart item will be deleted.

## Notes about addresses

 - User can have only one default address, so if you mark one address as default and save it, previous default address 
will be set as not-default.
 - Delivery information is saved in order, even if it was placed by authorized user. So, delivery information will
be preserved even if address is deleted.
 - In order to validate phone number format, custom validation rule was created - `\App\Rules\PhoneNumber`.

## Notes about orders

- All orders are created with status = `pending`. Status can be changed later by admin.
- 