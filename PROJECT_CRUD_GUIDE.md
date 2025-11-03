# Project CRUD System - Documentation

## Overview
A complete Project Management CRUD system has been implemented in the admin panel for managing luxury villa projects.

## Features Implemented

### ✅ Database Structure
**Table**: `projects`

**Fields**:
- `id` - Primary key
- `title` - Project title (required)
- `description` - Project description (required)
- `images` - JSON array of image paths (multiple images support)
- `brochure` - PDF file path
- `location` - Project location
- **Status Fields**:
  - `is_featured` - Featured project checkbox
  - `is_completed` - Completed status checkbox
  - `is_ongoing` - Ongoing status checkbox
- **Features & Amenities**:
  - `features_amenities` - JSON array of selected amenities
- **Property Overview**:
  - `bedrooms` - Number of bedrooms
  - `bathrooms` - Number of bathrooms
  - `sqft` - Square feet
  - `year_built` - Year the property was built
  - `property_type` - Type (Villa, Apartment, Penthouse, etc.)
- `created_at` / `updated_at` - Timestamps

### ✅ File Storage Locations
Files are stored directly in the public folder:
- **Images**: `public/projects/images/`
- **Brochures (PDF)**: `public/projects/brochures/`

Files are automatically organized and the directories are created if they don't exist.

### ✅ CRUD Operations

#### 1. **Create Project** (`/admin/projects/create`)
- Form with all fields
- Multiple image upload support
- Single PDF brochure upload
- Checkbox selections for status and amenities
- Property overview fields
- Validation on all inputs
- Auto-creates directories if missing

#### 2. **Read/List Projects** (`/admin/projects`)
- Paginated list of all projects (10 per page)
- Display thumbnail image
- Show project title, location
- Status badges (Featured, Completed, Ongoing)
- Property details preview
- Created date
- Actions (Edit, Delete)
- Empty state when no projects exist

#### 3. **Update Project** (`/admin/projects/{id}/edit`)
- Pre-filled form with existing data
- View existing images with delete option
- Add new images while keeping old ones
- Replace brochure
- Update all fields
- Same validation as create

#### 4. **Delete Project** (`/admin/projects/{id}`)
- Confirmation prompt
- Deletes project from database
- Removes all associated images from disk
- Removes brochure from disk
- Returns success message

#### 5. **Delete Individual Image**
- Delete specific images from existing project
- Removes file from disk
- Updates database

### ✅ Features & Amenities Options
Pre-defined options (checkboxes):
- Swimming Pool
- Gym
- Garden
- Parking
- Security
- Elevator
- Balcony
- Terrace
- Clubhouse
- Kids Play Area
- Power Backup
- CCTV

### ✅ Property Types
Dropdown options:
- Villa
- Apartment
- Penthouse
- Mansion
- Estate
- Townhouse

### ✅ File Upload Specifications

**Images**:
- Format: JPG, PNG, GIF
- Max size: 2MB per image
- Multiple images allowed
- Stored with unique filenames (timestamp + unique ID)

**Brochure**:
- Format: PDF only
- Max size: 10MB
- Single file
- Replaces previous brochure when updated

### ✅ Validation Rules

**Required Fields**:
- Title
- Description

**Optional but Validated**:
- Location: String, max 255 characters
- Bedrooms: Integer, minimum 0
- Bathrooms: Integer, minimum 0
- Square Feet: Numeric, minimum 0
- Year Built: Integer, between 1800 and current year + 1
- Property Type: String, max 100 characters
- Images: Image files only (jpg, png, gif), max 2MB each
- Brochure: PDF only, max 10MB

## Routes

All routes are protected by admin middleware:

```php
// Resource routes (automatically created)
GET    /admin/projects              - List all projects
GET    /admin/projects/create       - Show create form
POST   /admin/projects              - Store new project
GET    /admin/projects/{id}         - Show single project
GET    /admin/projects/{id}/edit    - Show edit form
PUT    /admin/projects/{id}         - Update project
DELETE /admin/projects/{id}         - Delete project

// Custom route
DELETE /admin/projects/{id}/delete-image - Delete specific image
```

## Files Created

### Controllers
- `app/Http/Controllers/Admin/ProjectController.php`

### Models
- `app/Models/Project.php`

### Migrations
- `database/migrations/2025_10_31_101204_create_projects_table.php`

### Views
- `resources/views/admin/projects/index.blade.php` - List projects
- `resources/views/admin/projects/create.blade.php` - Create form
- `resources/views/admin/projects/edit.blade.php` - Edit form
- `resources/views/admin/projects/form.blade.php` - Shared form partial

### Directories
- `public/projects/images/` - Image storage
- `public/projects/brochures/` - PDF storage
- `.gitignore` files added to ignore uploaded files

## Usage Instructions

### Accessing Project Management
1. Login to admin panel: `http://localhost:8000/admin/login`
2. Click "Projects" in the sidebar
3. You'll see the projects list page

### Creating a New Project
1. Click "Add New Project" button
2. Fill in the required fields:
   - Title (required)
   - Description (required)
3. Upload images (optional, multiple allowed)
4. Upload brochure PDF (optional)
5. Set location (optional)
6. Check status boxes (Featured/Completed/Ongoing)
7. Select features & amenities
8. Fill property overview (bedrooms, bathrooms, sqft, year, type)
9. Click "Create Project"

### Editing a Project
1. Click the edit icon (pencil) on any project
2. Modify any fields
3. Add new images or delete existing ones
4. Upload new brochure to replace old one
5. Click "Update Project"

### Deleting a Project
1. Click the delete icon (trash) on any project
2. Confirm deletion
3. Project and all files will be removed

### Deleting Individual Images
1. Edit a project
2. Scroll to "Existing Images"
3. Click the X button on any image
4. Confirm deletion
5. Image will be removed immediately

## Dashboard Integration
- Project count is automatically displayed on the admin dashboard
- Shows real-time count from database

## Security Features
- Admin middleware protection (only admins can access)
- CSRF protection on all forms
- File validation (type and size)
- Unique filename generation (prevents overwrite)
- Confirmation prompts for deletions

## Design Features
- Clean, modern UI with simple colors
- Responsive design (works on mobile/tablet)
- Status badges with colors
- Image thumbnails in list view
- Empty state when no projects
- Success/error messages
- Form validation with error display
- Pagination for large lists

## Technical Details

### File Naming Convention
Files are saved with format: `timestamp_uniqueid.extension`
Example: `1730380000_6543210abcdef.jpg`

This ensures:
- No file overwrites
- Unique identifiers
- Easy sorting by date

### Image Deletion on Edit
- When deleting a specific image, only that image is removed
- Other images remain intact
- Database is updated to reflect the change

### Brochure Replacement
- Uploading a new brochure automatically deletes the old one
- Prevents disk space waste
- Keeps only the latest version

## Future Enhancements (Optional)
- Image reordering
- Set featured/primary image
- Image cropping/resizing
- Bulk delete
- Search and filters
- Export to Excel/PDF
- Image gallery view
- Project status workflow

## Troubleshooting

### Images not displaying?
- Check if files exist in `public/projects/images/`
- Verify file permissions (755 for directories)
- Clear browser cache

### Upload failing?
- Check PHP `upload_max_filesize` and `post_max_size` settings
- Verify directory permissions
- Check available disk space

### Directories not created?
- Ensure web server has write permissions to `public/` folder
- Manually create directories with correct permissions

## Support
For any issues or questions, refer to:
- Laravel Documentation: https://laravel.com/docs
- Project source code comments
- Admin panel interface help text

---

**Version**: 1.0  
**Created**: October 31, 2025  
**Laravel Version**: 12.0  
**PHP Version**: 8.2+

