# Perdig - A Simple Digital Library

**Perdig** is a very simple digital library, designed without any transaction features. This website was created solely for learning purposes. Some of the features available in this website include:

- Role management with different levels (admin, employee).
- Ability to add, view, edit and delete books.
- Ability to add, view, edit, and delete employee information.
- Book report or employee report printing feature.
- Ability to select book or employee files in bulk.
- Search for books or employees.
- Profile photo upload.

## Table of Contents

- [Usage](#usage)
  - [Installation](#installation)
  - [Account Information for Login](#account-information-for-login)
- [Support Me](#support-me)
- [License](#license)

## Usage

### Installation

1. Clone this repository to your computer (if you are using XAMPP, place the clone in the `htdocs` folder):

   ```bash
   git clone https://github.com/shafygunawan/perdig.git
   ```

2. Create a new database with the name `perdig`, then import the `perdig.sql` file into the database.

3. Next, you need to set up the configuration in this project. Open the `global/config.php` file and set the variables `$baseUrl`, `$hostname`, `$username`, `$password`, and `$database` according to the configuration you are using, as shown below:

   ```php
   $baseUrl = "http://localhost/perdig";
   $hostname = "localhost";
   $username = "root";
   $password = "";
   $database = "perdig";
   ```

4. To access this website, type the address you have set in the `$baseUrl` variable into a web browser. In the example above, the address is `http://localhost/perdig`.

### Account Information for Login

Here is the account information that has been registered in the database and can be used for login:

| Name          | Email              | Password | Level    |
| ------------- | ------------------ | -------- | -------- |
| Shafy Gunawan | shafy@example.com  | password | Admin    |
| Carlos Sparks | carlos@example.com | password | Employee |
| Lucal Wilson  | lucas@example.com  | password | Employee |

## Support Me

If you find this project useful and would like to support me, you can <a href="https://www.buymeacoffee.com/shafygunawan" target="_blank">Buy Me a Coffee</a>.

## License

This project is licensed under the MIT License. More details can be found in the [LICENSE](https://github.com/shafygunawan/perdig/blob/main/LICENSE) file.

Thank you for visiting my project!
