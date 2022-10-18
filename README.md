# This is demo store created using Laravel Framework.

## Pages available for everyone (or `guest`)

### Homepage
Homepage contains list of all products with product image, name, price, product categories and `Add to cart` button.

You can navigate home page with link `Home` in header.

### Category page

Same as Homepage, but only products which are associated with that category are displayed.

You can navigate to category page using corresponding links in header or links under product name at 
Homepage or category page

### Product page

Product page contains more detailed information about product - same as at Homepage/Category page +
product description. Authorized user (see below) will also have button `Add to wishlist` or `Remove from wishlist`.

### Cart

Cart contains products which were added to cart. Left part contains table with information about each 
product in cart - image, name, price, quantity, subtotal. There are also buttons `Remove from cart` to the right of each
product which allow to remove particular product form cart and `Clear Shopping Cart` below the table, which removes all
products from cart. 

Right part of cart page contains cart summary - Total price and link to Checkout page(see below).

Cart page can be accessed with link `Cart` in header.

### Checkout

Right part of checkout page contains order summary - list of all products in cart with image,
name, quantity, price and subtotal, final price and button `Place order`.

Left part of Checkout page looks different for authorized and unauthorized user. 

##### Guest

Guest has form which allows to add delivery address information (`address form`) - Full name, email, Country, City, Street, Zip and phone. 
This information will be saved not as address but as part of order itself.

##### Authorized user

For authorized user this part is splitted into two different parts: left with `address form`
to add new delivery address and right, simple selector which allows to select 
delivery address.

Ideally, I'd prefer to provide ability for customer to enter new address information without forcing 
him/her to create new address entity - i.e. just like guest - but this implementation requires more advanced 
level of JS while this project is mostly backend demo.

### Login/Register

These pages were created using OOB Laravel tools - so, nothing specific about them. The
only thing which is worth mentioning is that websites has two different user types - `user` and `admin` - and
only `user` can be created using registration form.

## Pages available for authorized user with type = `user`

`User` has access to all pages which are accessible by guest (except for `Login` and `Register` of course as `user` 
is already logged in) + access to user account pages:

### Account Dashboard

The very left part of page has Account navigation bar with links to another user account pages (`user navigation`).

Main part of account dashboard is splitted into two parts - left allow to edit account information - username, email,
full name, password, right part displays `address form` with default address and allows to edit this address
(if user has default address).

