# Laravel Issue Tracker - Features Overview

A professional, responsive mini issue tracker application built with Laravel 12, Bootstrap 5, and modern web technologies. Perfect for team collaboration and project management.

## ✨ Core Features

### 1. **Project Management**
- Create, read, update, and delete projects
- Set start dates and deadlines for projects
- View all projects in a responsive card-based grid
- Track issue statistics per project (total, open, in progress, closed)
- Ownership-based authorization (only project owners can edit/delete)

### 2. **Issue Management**
- Full CRUD operations for issues
- Status tracking: Open, In Progress, Closed
- Priority levels: Low, Medium, High
- Due date assignment
- Issue descriptions with rich text support
- Real-time filtering by status, priority, and tags
- Search functionality with 300ms debounce
- Nested routing with Laravel resource controllers

### 3. **Tag System**
- Create and manage categorization tags
- Color coding for visual differentiation
- Many-to-many relationships with issues
- Tag assignment and removal via AJAX
- Live color preview when creating/editing tags
- Tag filtering on project issues page

### 4. **Comment System**
- Add comments to issues
- Display comment author and timestamp
- Pagination support (5 comments per page)
- Comment timestamps show relative time (e.g., "6 minutes ago")
- Delete comments functionality
- AJAX-based comment submission

### 5. **User Assignment**
- Assign users to issues
- Track who's working on what
- Display assignee avatars on issue cards
- Many-to-many relationships with proper pivot table
- Add/remove assignees via AJAX without page reload
- Show assignee count on issue cards

### 6. **Responsive Design**
- Mobile-first Bootstrap 5.3.0 framework
- Professional gradient backgrounds
- Fixed sidebar navigation
- Collapsible mobile menu
- Responsive grid layouts (col-md-6, col-lg-4, etc.)
- Touch-friendly interface
- Works perfectly on desktop, tablet, and mobile

### 7. **Authentication System**
- User registration with password hashing
- Login with remember me functionality
- Logout with session cleanup
- Protected routes with middleware
- Guest redirects to login
- Authenticated user info in navbar

### 8. **User Interface Features**
- Professional gradient color scheme (blue primary)
- Bootstrap Icons integration (45+ icons used)
- Status badges with color coding
- Priority indicators with visual styling
- Modals for tag and user selection
- Toast notifications for success/error messages
- Form validation with error display
- Empty state messaging (e.g., "No issues found")

## 🎨 Design Highlights

- **Master Layout**: Single app.blade.php serves all authenticated pages
- **Responsive Sidebar**: Fixed left navigation with icon+text
- **Hero Section**: Welcome page with feature cards
- **Card-Based UI**: Projects and issues displayed as professional cards
- **Color Coding**: Status, priority, and tags use consistent color scheme
- **Custom CSS**: Variables for consistent theming (--primary-color, --sidebar-width)
- **Bootstrap Icons**: 45+ SVG icons for visual clarity

## 📊 Database Schema

### Tables:
- **users**: User accounts with email and password
- **projects**: Project records with owner, title, description, dates
- **issues**: Issues linked to projects with status, priority, due dates
- **tags**: Categorization tags with unique names and colors
- **comments**: Issue comments with author and content
- **issue_tag**: Pivot table for many-to-many tag relationships
- **issue_user**: Pivot table for many-to-many user assignments
- **cache, jobs**: Laravel system tables

## 🚀 AJAX Features

All implemented without page reloads:
- Issue filtering by status/priority/tag
- Search with debounce
- Tag attachment/detachment
- User assignment/removal
- Comment submission and deletion
- Dynamic issue list updates

## 📋 Bonus Features Implemented

✅ Start date and deadline columns on projects  
✅ User assignment to issues  
✅ Search with debounce (300ms)  
✅ Many-to-many relationships (tags, users)  
✅ Professional Bootstrap design  
✅ Full responsiveness  
✅ Comment system with pagination  
✅ Authorization with ownership checks  

## 🔐 Security Features

- CSRF token protection on all forms
- Password hashing with bcrypt
- SQL injection prevention via Eloquent ORM
- Authorization checks on update/delete operations
- Form request validation
- Protected routes with middleware

## 📱 Technology Stack

- **Backend**: Laravel 12
- **Frontend**: Bootstrap 5.3.0, jQuery 3.6.0, Bootstrap Icons 1.11.0
- **Database**: MySQL (via Laravel migrations)
- **Authentication**: Laravel built-in auth
- **API**: RESTful JSON endpoints for AJAX
- **Templating**: Blade templates
- **Task Runner**: Vite

## 🔧 Installation & Setup

### Prerequisites:
- PHP 8.2+
- Composer
- MySQL or equivalent database
- Node.js (optional, for npm packages)

### Quick Start:

```bash
# Install PHP dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate app key
php artisan key:generate

# Run migrations
php artisan migrate

# Seed demo data
php artisan db:seed

# Start development server
php artisan serve
```

Then visit: http://127.0.0.1:8000

### Demo Credentials:
- Email: john@example.com
- Password: password

## 📁 Project Structure

```
├── app/
│   ├── Http/Controllers/    # All controllers (Project, Issue, Tag, Comment, Auth)
│   ├── Http/Requests/       # Form request validation (6 classes)
│   ├── Models/              # Eloquent models (5 models with relationships)
│   └── Policies/            # Authorization policies
├── database/
│   ├── migrations/          # 10 migration files
│   └── seeders/             # DatabaseSeeder with demo data
├── resources/views/
│   ├── layouts/             # Master app.blade.php
│   ├── projects/            # Project CRUD views
│   ├── issues/              # Issue CRUD views
│   ├── tags/                # Tag CRUD views
│   ├── auth/                # Login/Register views
│   └── welcome.blade.php    # Landing page
└── routes/
    ├── web.php              # Main routes
    └── auth.php             # Auth routes
```

## 🎯 Key Achievements

✅ Complete CRUD operations for all entities  
✅ Real-time filtering and search  
✅ AJAX interactions without page reloads  
✅ Professional responsive design  
✅ Ownership-based authorization  
✅ Comment system with pagination  
✅ User assignment system  
✅ Color-coded tags  
✅ Proper database relationships  
✅ Form validation on both client and server  
✅ Professional UI/UX with Bootstrap  
✅ Git version control  

## 📸 Screenshots

### Projects List Page:
- Responsive card grid (3 columns on desktop, 2 on tablet, 1 on mobile)
- Project title, description, dates
- Quick action buttons (View, Edit, Delete)
- "New Project" button

### Project Details Page:
- Project metadata (start date, deadline, issue statistics)
- Issue list with filtering dropdowns
- Search with real-time debounce
- Issue cards with tags, assignees, comments count
- "New Issue" and "Edit" buttons

### Issue Details Page:
- Left column: description and comments
- Right column: status, priority, due date, tags, assignees
- Comment form with author name
- Existing comments with timestamps
- Add/Remove buttons for tags and assignees

### Tags Management Page:
- Table view of all tags
- Color swatches for visual identification
- Edit and Delete buttons for each tag
- "New Tag" button

## 🔄 Development Workflow

The application follows Laravel best practices:
- Resource controllers for RESTful routing
- Form request classes for validation
- Eloquent ORM for database operations
- Blade templates for view rendering
- Middleware for route protection
- Policies for authorization
- Service providers for configuration

## 🎓 Learning Outcomes

This project demonstrates:
- Full-stack Laravel development
- RESTful API design
- AJAX and jQuery integration
- Bootstrap responsive design
- Database relationships and migrations
- Authentication and authorization
- Form validation and security
- Professional UI/UX principles

---

**Status**: ✅ Complete and fully functional  
**Last Updated**: June 22, 2026  
**Version**: 1.0.0
