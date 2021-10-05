# laravel-api-test
Laravel task: Create api calls for a mini online store.

The following models must exist: `User, Product, Order`.
There will be the following relations: The `User` can have multiple `Products` and `Orders`, the `Order` has multiple `Products`, but one `User`.

The following api calls need to be created:
 - User login / register, 
 - Create product,
 - Create order, 
 - Get my orders

**User login / register:** Email and password will be used. In addition, there is an optional "locale" field that should be saved in the database if sent. (locale is a language, it can be “sr”, “en”, “de” ....). Return User model as Resource.

**Create product:** The product has a name and a price. Return the product model as Resource.

**Create order:** We send a series of products, and then it is necessary to calculate the price of the order and return the order model as Resource. Please note that the user cannot purchase their own product. Display an error message in this case. Return the Order model as Resource.

**Get my orders:** Restore the collection of Orders of the logged-in User as Resource.

It is necessary to handle all cases, if, for example, at the registration the user does not send an email, return the appropriate error message.
It is necessary to use middleware for user authentication (use JWT: https://github.com/firebase/php-jwt) and resources to return results to the user - https://laravel.com/docs/8.x/eloquent-resources.
