# This is demo store created using Laravel Framework.

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
from cart and `Clear Shopping Cart` below the table, which removes all products from cart. 

 - Right part of cart page contains cart summary - Total price and link to Checkout page(see below).

Cart page can be accessed with link `Cart` in header.

### Checkout

Right part of checkout page contains order summary - list of all products in cart with image,
name, quantity, price and subtotal, final price and button `Place order`.

Left part of Checkout page looks different for authorized and unauthorized user. 

##### For Guest

Guest has form which allows to add delivery address information (`address form`) - Full name, email, Country, City, Street, Zip and phone. 
This information will be saved not as address but as part of order itself.

##### For Authorized user

For authorized user this part is split into two different parts: 
 - Left part contains `address form` which allows to add new delivery address.
 - Right part contains simple selector which allows to select delivery address.

Ideally, I'd prefer to provide ability for customer to enter new address information without forcing 
him/her to create new address entity - i.e. just like guest - but this implementation requires more advanced 
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

User can have only one default address, so if you mark one address as default and save it, previous default address will
be set as not-default.

### My Account - My Wishlist
If `user` added some products to his/her wishlist, this products will be displayed here, together with button which 
allows to remove product from wishlist.

If there are no products in wishlist, corresponding message will be displayed.

##  Pages available for authorized user with type = `admin`
`Admin` has access to all pages which are accessible by `user` + access to admin pages:

### Admin panel - Admin panel
The very left part of page has Admin navigation bar with links to another user Admin pages (`admin navigation`).
`admin navigation` is presented at all admin pages.

Main part of page is currently empty

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

Creates user with type = `admin`. This is the only way to create admin user right now (without direct onteraction with 
database). Creation requires username, email, password and password confirmation.

### demo:install

Deploys sample data:
 - Two categories
 - Three products
 - Two users - one admin and one user
 - One address for each user

## Warning! ## 
This command will delete ALL previously created entities - users, categories, products, carts, orders, wishlists.
Do not execute it unless you don't need such data.

##### Demo admin user:

 - email: admin@test.com
 - password: test@123

##### Demo user:

 - email: test@test.com
 - password: test@123