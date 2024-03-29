
# School Electoral Blockchain

The School Electoral Blockchain project is a Laravel-based application designed to facilitate and secure the voting process for school elections using blockchain technology.

## Installation

Follow these steps to set up and run the project locally:

### Prerequisites

- PHP >= 8.1 //it only works with PHP 8.1 and higher
- Composer
- MySQL (or any other compatible database)
- Node.js (for frontend assets compilation)
- Download Ganache

1. Clone the repository:

   ```bash
   git clone https://github.com/ha165/votin_system.git
   cd voting_system
   ```

2. Install Dependencies:

   ```bash
   composer install
   npm install && npm run dev
   ```

3. Setup Environment Variables:

   ```bash
   cp .env.example .env
   ```

   Generate the application key:

   ```bash
   php artisan key:generate
   ```

4. Configure the database:

   Update the `.env` file with your database credentials.

5. Run Migrations:

   ```bash
   php artisan migrate
   ```

6. Serve the application:

   ```bash
   php artisan serve
   ```

## Usage

- Register as a voter or administrator.
- Administer the election by setting up candidates, positions, and election parameters.
- Voters cast their votes securely through the blockchain-powered voting system.
- Results can be viewed securely and transparently after the election concludes.

## Additional Configuration

- Customize authentication methods, roles, and permissions as needed.
- Integrate additional blockchain features for enhanced security and transparency.

## Contributing

Thank you for considering contributing to this project! Please follow the contribution guidelines.

## Code of Conduct

Please review and abide by the Code of Conduct to ensure a positive community experience.

## Security Vulnerabilities

If you discover a security vulnerability, please send an email to lumumbaharmony@gmail.com. All security vulnerabilities will be promptly addressed.

## License

This project is not licensed for production use. It is provided for educational and non-commercial purposes only.

## N.B 
I did not create the Dashboard.You can get the dashboard used in this project from https://www.google.com/url?sa=t&source=web&rct=j&opi=89978449&url=https://www.creative-tim.com/blog/web-design/free-dashboards-templates-laravel/&ved=2ahUKEwj60KGskJmFAxUPRfEDHR5PCvsQFnoECA0QAQ&usg=AOvVaw3oWBTvvfTYyuhKRhiC8RcA. 