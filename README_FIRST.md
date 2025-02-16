Laravel Contact Manager

A simple contact management system built with Laravel. This project allows users to add, edit, delete, and import contacts from an XML file.

Getting Started

1. Clone the Repository

First, clone the repository from GitHub:

git clone <repository-url>
cd <project-folder>

(Replace <repository-url> with the actual GitHub repo link.)


2. Install Dependencies

Run the following commands to install PHP and Node.js dependencies:

composer install
npm install


3. Set Up Environment

Copy the example environment file and update the database credentials in .env:

cp .env.example .env


4. Database Setup

The project comes with a sample database file. Import laravel_contactmanager.sql (located in the project root) into MySQL.

If you want to migrate a fresh database, you can also run:

php artisan migrate


5. Start the Application

Run the Laravel development server:

php artisan serve

Your app should now be running at http://127.0.0.1:8000/.
API & Routes

Here are the available routes in the application:
Contact Management

    List Contacts → GET /
    Add Contact Form → GET /contacts/create
    Save New Contact → POST /contacts
    Edit Contact → GET /contacts/{contact}/edit
    Update Contact → PUT /contacts/{contact}
    Delete Contact → DELETE /contacts/{contact}

Import Contacts

    Show Import Form → GET /contacts/import
    Upload & Import XML File → POST /contacts/import

Sample XML Files

The project includes sample XML files to test the import functionality:

    sample_contacts_100.xml → Contains 100 sample contacts
    sample_contacts_100000.xml → Contains 100,000 sample contacts

These files are located in the project root folder.
Notes

    The application supports pagination and batch processing for large data imports.
    If you're importing a large file, consider increasing memory_limit and max_execution_time in your PHP configuration (php.ini).