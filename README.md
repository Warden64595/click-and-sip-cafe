# Click And Sip Cafe

A coffee shop website with user registration, login, an online menu and cart, and payment selection. Built with PHP, MySQL, HTML, CSS and JavaScript.

## Features
- Customer registration and login (passwords are stored as hashes)
- Logged-in session, protected pages, and logout
- Menu with an add-to-cart basket (quantity change, remove item, live total)
- "Order Now" saves the order to the database with an invoice number
- Payment page: Cash or GCash, saved against that order
- Guests who click the cart are sent to the login page

## Database (`database/click.sql`)
| Table | Purpose | Main columns |
|---|---|---|
| `users` | Customer accounts | id, name, username, email, password (hash), create_datetime |
| `orders` | One row per item; rows with the same `invoice_number` form one order | id, title, price, quantity, subtotal_amount, date, invoice_number, user_id |
| `payment_method` | Payment chosen for an order | id, invoice_number, user_id, payment_type, amount, payment_status, date_created |

Relationships: one user has many orders; one user has many payments; an invoice has many order rows and its payment is linked by `invoice_number`.

## How to run (XAMPP, Windows)
1. Install XAMPP and open the XAMPP Control Panel. Start **Apache** and **MySQL**.
2. Copy the folder `coffee_shop_namin_fixed` into `C:\xampp\htdocs\` (you can rename it to `coffee_shop_namin`).
3. Open http://localhost/phpmyadmin, click **Import**, choose `database/click.sql`, and click **Import**. This creates the database `coffee_shop_namin` and its three tables.
4. Open http://localhost/coffee_shop_namin/ (use the folder name you chose).
5. Click **Login**, then **Register here!**, create an account, log in, add items to the cart, click **Order Now**, and pick a payment method.
6. Check the data in phpMyAdmin: tables `users`, `orders`, `payment_method`.

If the database login is not `root` with an empty password, change it in `users/db.php`.

## Folder structure
```
index.php            public home page (guests)
users/               login, registration, logged-in shop, payment
  db.php             database connection
  auth_session.php   blocks pages when not logged in
  login.php  registration.php  logout.php
  index.php          logged-in shop page
  add_to_database.php  saves the order
  payment.php  save_payment.php
assets/              css, js, images
database/click.sql   database script
```

## Test cases (fill in Pass/Fail after you test)
| # | Test | Expected | Result |
|---|---|---|---|
| 1 | Register with valid details | Account created, goes to login | |
| 2 | Register with a username that already exists | Error message shown | |
| 3 | Register with a short password | Error message shown | |
| 4 | Login with correct details | Opens the shop page | |
| 5 | Login with a wrong password | "Incorrect username or password." | |
| 6 | Open users/index.php without logging in | Redirected to login | |
| 7 | Click Order Now with an empty cart | "Your cart is empty" message | |
| 8 | Order 2 items | Rows appear in `orders` with one invoice number | |
| 9 | Choose Cash | Row in `payment_method`, status "To Pay" | |
| 10 | Choose GCash | Row in `payment_method`, status "Waiting for Payment" | |
| 11 | Logout | Session ends, back to home page | |

## Security notes
- Database queries use prepared statements, so typed input cannot change the SQL.
- Passwords use `password_hash` / `password_verify`.
- The payment amount is calculated again on the server from the saved order.

## Known limits
- Item prices come from the web page, not from a products table. A products table would be a good next step.
- The GCash number on the payment page is a placeholder (`09XXXXXXXXX`). Replace it with the real number.
- There is no admin page to view orders. Orders can be seen in phpMyAdmin.
- Google sign-in was removed because its library (`google-client`) was not included.
