
## About Rental Management System

This is a rental management system made in laravel that enables all tenancy stakeholders to permorm automated lease actions.Its mainly useful for agencies who can manage rental houses/ properties on behalf of landlords. This means that we have various types of users,ranging from tenants,landlords,agency/admin and general users

### Admin/Agent
This is the main user,who has the followig capabilitites:
- Manage landlords
- Manage tenants
- Manage Properties
- Manage property units
- Create and manage leases
- Manage Invoices
- Manage calendar events
- Manage other users
- View reports
- Manage support tickets


### Tenant

Tenants can log in and :
- Raise support tickets
- View active leases
- View Invoices

### Landlord
Landlords can log in and :
- View properties he owns
- View monthly report on the amount he will recieve
- Raise support tickets

### General Users
These ones can only log in and view support tickets assigned to them.E.g assigned ticket to maintain a lawn.

## Installation Steps:

- Clone the repository with __git clone__
- Copy __.env.example__ file to __.env__ and edit database credentials there
- Run __composer update__
- Run __php artisan key:generate__
- Run __php artisan migrate__
- Run __php artisan db:seed__ (It has some seeded data for roles,permissions and default admin credentials)
- Run __php artisan storage:link__ 
- Run __php artisan serve__ to launch the main url.

- You can login to adminpanel by going go `/login` URL and login with credentials __admin@admin.com__ - __password__

## Prerequisites
-Inorder to use google maps functionality throughout the application, a valid google maps key with
__Places API__ and __Location API__ services tied to the key. You can register to get free [API here](https://developers.google.com/maps/documentation/javascript/get-api-key)

-When creating other user --e.g landlords, tenants, admins, users-- an email is sent to them with the login credentials.Make sure the `MAIL_CREDENTIALS` are updated accordingly in the __.env__ file