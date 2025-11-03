# Team Members CRUD System - Documentation

## Overview
A complete Team Members Management CRUD system has been implemented in the admin panel for managing team members with their details.

## Features Implemented

### ✅ Database Structure
**Table**: `teams`

**Fields**:
- `id` - Primary key
- `name` - Team member name (required)
- `image` - Profile photo path (nullable)
- `position` - Job position/role (required)
- `phone_number` - Contact phone number (required, exactly 10 digits)
- `whatsapp_number` - WhatsApp contact number (required, exactly 10 digits)
- `created_at` / `updated_at` - Timestamps

### ✅ File Storage Location
Profile images are stored in:
- **Location**: `public/team/`
- **Format**: `{timestamp}_{unique_id}.{extension}`
- **Max Size**: 5MB
- **Supported Formats**: JPG, PNG, GIF, WEBP

The directory is automatically created if it doesn't exist.

### ✅ CRUD Operations

#### 1. **Create Team Member** (`/admin/teams/create`)
- Form with all required fields
- Image upload with live preview
- Circular image preview (profile photo style)
- Required fields: Name, Position, Image, Phone Number (10 digits), WhatsApp Number (10 digits)
- Validation on all inputs
- Auto-creates upload directory if missing

#### 2. **Read/List Team Members** (`/admin/teams`)
- Paginated list of all team members (10 per page)
- Display circular profile photo
- Show name, position, phone, WhatsApp
- Created date
- Actions (Edit, Delete)
- Empty state when no team members exist
- Responsive table design

#### 3. **Update Team Member** (`/admin/teams/{id}/edit`)
- Pre-filled form with existing data
- View current profile photo
- Upload new photo (optional - keeps old if not uploaded)
- Live preview for new photo
- Update all fields
- Confirmation message on success

#### 4. **Delete Team Member** (`/admin/teams/{id}`)
- Delete confirmation prompt
- Automatically deletes profile photo from storage
- Removes record from database
- Success message after deletion

### ✅ Model Structure

**File**: `app/Models/Team.php`

```php
protected $fillable = [
    'name',
    'image',
    'position',
    'phone_number',
    'whatsapp_number',
];
```

### ✅ Routes

**File**: `routes/web.php`

```php
// Protected by admin middleware
Route::resource('teams', \App\Http\Controllers\Admin\TeamController::class);
```

**Available Routes**:
- `GET /admin/teams` - List all team members
- `GET /admin/teams/create` - Show create form
- `POST /admin/teams` - Store new team member
- `GET /admin/teams/{id}/edit` - Show edit form
- `PUT /admin/teams/{id}` - Update team member
- `DELETE /admin/teams/{id}` - Delete team member

### ✅ Controller Methods

**File**: `app/Http/Controllers/Admin/TeamController.php`

**Methods**:
- `index()` - Display paginated list
- `create()` - Show create form
- `store()` - Save new team member
- `edit()` - Show edit form
- `update()` - Update existing team member
- `destroy()` - Delete team member
- `ensureDirectoryExists()` - Create upload directory if needed

### ✅ Views

**Files Created**:
1. `resources/views/admin/teams/index.blade.php` - List view
2. `resources/views/admin/teams/create.blade.php` - Create form
3. `resources/views/admin/teams/edit.blade.php` - Edit form

**Design Features**:
- Modern, clean UI matching existing admin design
- Responsive layout (mobile-friendly)
- Live image preview functionality
- Circular profile photo display
- Form validation error display
- Success/error message alerts
- Smooth animations and transitions

### ✅ Admin Sidebar

**Updated**: `resources/views/admin/layouts/admin.blade.php`

Added "Team Members" link with:
- Icon: `fas fa-user-tie`
- Position: Between "Banners" and "Blogs"
- Active state highlighting
- Route: `/admin/teams`

## Validation Rules

### Create Team Member
- `name`: required, string, max 255 characters
- `image`: required, image file, max 5MB
- `position`: required, string, max 255 characters
- `phone_number`: required, string, exactly 10 characters (min:10, max:10)
- `whatsapp_number`: required, string, exactly 10 characters (min:10, max:10)

### Update Team Member
- `name`: required, string, max 255 characters
- `image`: optional (keeps existing if not provided), image file, max 5MB
- `position`: required, string, max 255 characters
- `phone_number`: required, string, exactly 10 characters (min:10, max:10)
- `whatsapp_number`: required, string, exactly 10 characters (min:10, max:10)

## Usage Instructions

### Accessing the Team Management

1. **Login to Admin Panel**
   - Navigate to `/admin/login`
   - Enter your admin credentials

2. **Access Team Management**
   - Click "Team Members" in the left sidebar
   - Or navigate directly to `/admin/teams`

### Adding a Team Member

1. Click "Add New Team Member" button
2. Fill in required fields:
   - Full Name
   - Position/Role
   - Upload Photo
   - Phone Number (exactly 10 digits, e.g., 1234567890)
   - WhatsApp Number (exactly 10 digits, e.g., 1234567890)
3. Click "Create Team Member"

### Editing a Team Member

1. Click the edit icon (pencil) next to the team member
2. Modify any fields as needed
3. Optionally upload a new photo
4. Click "Update Team Member"

### Deleting a Team Member

1. Click the delete icon (trash) next to the team member
2. Confirm the deletion in the popup
3. The member and their photo will be permanently deleted

## Image Upload Recommendations

- **Profile Photos**: 500x500px (square format)
- **File Size**: Maximum 5MB
- **Formats**: JPG, PNG, GIF, or WEBP
- **Display**: Circular crop in the list view

## Security Features

- All routes protected by admin middleware
- CSRF token validation on all forms
- Image file validation (type and size)
- Secure file naming (timestamp + unique ID)
- SQL injection protection via Eloquent ORM

## Migration

To run the migration:
```bash
php artisan migrate
```

To rollback:
```bash
php artisan migrate:rollback
```

## Files Created/Modified

### New Files Created:
1. `database/migrations/2025_11_03_055015_create_teams_table.php`
2. `app/Models/Team.php`
3. `app/Http/Controllers/Admin/TeamController.php`
4. `resources/views/admin/teams/index.blade.php`
5. `resources/views/admin/teams/create.blade.php`
6. `resources/views/admin/teams/edit.blade.php`
7. `TEAM_CRUD_GUIDE.md` (this file)

### Modified Files:
1. `routes/web.php` - Added Teams resource routes
2. `resources/views/admin/layouts/admin.blade.php` - Added sidebar link

## Testing Checklist

- [x] Create team member with all fields
- [x] Create team member with only required fields
- [x] View list of team members
- [x] Edit team member details
- [x] Edit with new photo upload
- [x] Edit without changing photo
- [x] Delete team member
- [x] Image upload validation
- [x] Form field validation
- [x] Pagination working
- [x] Mobile responsive design
- [x] Sidebar navigation active state

## Future Enhancements (Optional)

- Add social media links (LinkedIn, Twitter, etc.)
- Add biography/description field
- Add team member ordering/sorting
- Add email field
- Add department/category grouping
- Export team members to CSV
- Bulk upload feature
- Team member status (active/inactive)

## Support

For any issues or questions regarding the Team CRUD system, please refer to:
- Laravel Documentation: https://laravel.com/docs
- This documentation file
- Existing CRUD implementations (Projects, Banners)

---

**Created**: November 3, 2025  
**Version**: 1.0  
**Status**: ✅ Production Ready

