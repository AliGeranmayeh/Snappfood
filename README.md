## Overview
This project is a simple implementation of the SnappFood, a food ordering service in which our users can have three main roles:

- Admin
- Restaurant owner
- Customer

The admin and restaurant owner panels are designed traditionally and all routes are located in the `routes/web.php` file, but for the customer, the project only has an API. It will not have a user interface like the previous two user types, and all of its routes are located in `routes/api.php`.


## User Capabilities


### Admin
1. View list of users
2. View list of restaurants
3. View, create, edit, and delete restaurant categories
4. View, create, edit, and delete food categories
5. View, create, and delete discounts
6. View, approve, and delete requested comments


### Restaurant Owner

1. Until they create their restaurant, they do not have access to any features.
2. Create, edit, and delete food for the restaurant menu
3. Search by name and food categories created by admin
4. Create and delete discounts specific to the restaurant
5. Update restaurant details
6. Receive, accept, request deletion to admin and respond to comments
7. Receive orders and change their status from checking to delivered
8. View the number of orders and total restaurant revenue
9. Filter orders by time and status


### Customer 

1. Register, update, and delete multiple addresses with different names
2. Register an active address from among multiple existing addresses to receive an order
3. Register and update user details
4. Register, update, and pay for multiple different shopping carts
5. Register comment for received order
6. View all comments given by the user
7. View all comments given on a specific food item
8. View all restaurants and select food from them


## How to Use


### Project Installation

1. `git clone <my-cool-project>`
2. `composer install`
3. `cp .env.example .env`
4. `php artisan migrate --seed`
5. `php artisan serve`
6. `npm run dev`

After running the above commands, the project is running at the local address given in the cmd, and the single admin user of the project is also running with the following details, which are also printed in the cmd:

**Email:**
**admin@admin.com**

**Password:**
**admin**

### How to Use the APIs

#### Authentication-related routes

#### `Register route`
- **URL:** `host-address/api/register`
- **Method: POST**
- **Required fields**  
`name`  
`email: ` unique  
`phone_number: ` 11 digits starting with 09, unique  
`password:` minimum 8 characters   
`role: shopper`  

#### `Login route`
- **URL:** `host-address/api/login`
- **Method: POST**
- **Required fields**  
`email`  
`password`

#### `Logout route`
- **URL:** `host-address/api/logout`
- **Method: POST**
- **Required field**  
`bearer token`

#### Restaurant-related routes

#### `Restaurants list route`
- **URL:** `host-address/api/restaurants`
- **Method: GET**
- **Optional field**  
`type: ` numeric, a valid restaurant category id  

#### `Restaurant information route`
- **URL:** `host-address/api/restaurants/{restaurant_id}`
- **Method: GET**

#### `Restaurant menu route`
- **URL:** `host-address/api/restaurants/{restaurant_id}/foods`
- **Method: GET**

#### Address-related routes
#### `Addresses list route`
- **URL:** `host-address/api/addresses`
- **Method: GET**
- **Required fields**  
`bearer token`

#### `Add new address route`
- **URL:** `host-address/api/addresses`
- **Method: POST**
- **Required fields**   
`bearer token`  
`title`  
`address`    
`latitude:` numeric  
`longitude:` numeric  
`status:` `set`or `unset`

#### `Update a address route`
- **URL:** `host-address/api/addresses{address_id}`
- **Method: PATCH**
- **Required field**  
`bearer token`
- **Optional fields**   
`title`  
`address`   
`latitude:` numeric  
`longitude:` numeric    
`status:` `set`or `unset`  

#### Profile-related routes

#### `Show user profile route`
- **URL:** `host-address/api/user_info`
- **Method: Get**
- **Required field**  
`bearer token`

#### `Update user profile route`
- **URL:** `host-address/api/user_info`
- **Method: PATCH**
- **Required field**  
`bearer token`
- **Optional fields**   
`name`  
`email:` unique   
`phone_number: ` 11 digits starting with 09, unique  

#### Cart-related routes

#### `Shopping carts list route`
- **URL:** `host-address/api/carts`
- **Method: GET**
- **Required field**  
`bearer token`

#### `Add new shopping cart route`
- **URL:** `host-address/api/cart/add`
- **Method: POST**
- **Required field**  
`bearer token`
`food_id`
`count`

#### `Update existing food in the shopping cart route`
- **URL:** `host-address/api/cart/add`
- **Method: PATCH**
- **Required field**  
`bearer token`
`food_id`
`count`

#### `Show existing shopping cart information route`
- **URL:** `host-address/api/cart/carts/{cart_id}`
- **Method: GET**
- **Required field**  
`bearer token`

#### `Update existing food in the shopping cart route`
- **URL:** `host-address/api/carts/{cart_id}/pay`
- **Method: POST**
- **Required field**  
`bearer token`

#### Comment-related routes

#### `Show user's comments list route`
- **URL:** `host-address/api/comments`
- **Method: GET**
- **Required field**  
`bearer token`

#### `Show food's comments list route`
- **URL:** `host-address/api/comments/food/{food_id}`
- **Method: GET**
- **Required field**  
`bearer token`

#### `Show restaurant's comments list route`
- **URL:** `host-address/api/restaurant/{restaurant_id}`
- **Method: GET**
- **Required field**  
`bearer token`

#### `Show restaurant's comments list route`
- **URL:** `host-address/api/{order_id}/comment`
- **Method: POST**
- **Required field**  
`bearer token`
`comment:`  minimum 2 characters
