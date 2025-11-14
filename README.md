# Portfolio Builder SaaS Platform

A Laravel-based SaaS platform where users can create their own personal portfolio website by selecting a theme and customizing content from a simple dashboard.

## Features

- **User Registration & Authentication**: Users can register with username, email, and password
- **Theme Selection**: Choose from multiple portfolio themes
- **Portfolio Customization**: 
  - Profile settings (name, username, tagline, profile image)
  - About section
  - Skills management
  - Projects showcase
  - Goals section
  - Contact details and social links
- **Public Portfolio Pages**: Each user gets a unique URL: `/{user_id}/{username}`
- **Admin Panel**: 
  - Theme management
  - User management
  - Site settings

## Installation

1. **Configure Database**
   - Update `.env` file with your database credentials
   - For Laragon, typically:
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=portfolio_app
     DB_USERNAME=root
     DB_PASSWORD=
     ```

2. **Run Migrations**
   ```bash
   php artisan migrate
   ```

3. **Seed Database**
   ```bash
   php artisan db:seed
   ```
   This will create:
   - 2 default themes (Classic and Hero)
   - Admin user (email: admin@example.com, password: password)

4. **Create Storage Link**
   ```bash
   php artisan storage:link
   ```

5. **Start Development Server**
   ```bash
   php artisan serve
   ```

## Default Admin Credentials

- **Email**: admin@example.com
- **Password**: password
- **Username**: admin

## Project Structure

- **Models**: User, Theme, UserProfile, UserSkill, UserProject, UserGoal
- **Controllers**: 
  - HomeController (homepage, theme preview/selection)
  - DashboardController (user dashboard)
  - PortfolioController (public portfolio pages)
  - Admin controllers (Dashboard, Theme, User, Settings)
- **Views**:
  - `home.blade.php` - Landing page with theme selection
  - `dashboard/index.blade.php` - User dashboard
  - `themes/classic.blade.php` - Classic portfolio theme
  - `themes/hero.blade.php` - Hero banner portfolio theme
  - Admin views in `admin/` directory

## Routes

- `/` - Homepage
- `/register` - User registration
- `/login` - User login
- `/dashboard` - User dashboard (authenticated)
- `/{id}/{username}` - Public portfolio page
- `/admin/dashboard` - Admin dashboard
- `/admin/themes` - Theme management
- `/admin/users` - User management
- `/admin/settings` - Site settings

## Portfolio Themes

### Classic Theme
- Left sidebar with profile info
- Right side scrolling content
- Clean, professional design

### Hero Theme
- Full-width hero section
- Large profile image/avatar
- Modern, bold design

## Notes

- Make sure to run `php artisan storage:link` to enable file uploads
- Profile images and project images are stored in `storage/app/public/`
- Username must be unique and is used in the portfolio URL
- Users can change their active theme from the dashboard
