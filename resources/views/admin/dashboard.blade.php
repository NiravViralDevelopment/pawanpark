@extends('admin.layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="dashboard-content">
    <!-- Welcome Section -->
    <div class="welcome-card">
        <div class="welcome-content">
            <h2>Welcome back, {{ auth()->user()->name }}! 👋</h2>
            <p>Here's what's happening with your luxury villas platform today.</p>
        </div>
        <div class="welcome-date">
            <i class="fas fa-calendar-alt"></i>
            <span>{{ now()->format('l, F j, Y') }}</span>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <!-- Projects Card -->
        <div class="stat-card card-blue">
            <div class="stat-icon">
                <i class="fas fa-briefcase"></i>
            </div>
            <div class="stat-details">
                <h3>Total Projects</h3>
                <div class="stat-number">{{ $stats['projects'] }}</div>
                <p class="stat-label">Active luxury villas</p>
            </div>
            <div class="stat-chart">
                <i class="fas fa-chart-line"></i>
            </div>
        </div>

        <!-- Blogs Card -->
        <div class="stat-card card-green">
            <div class="stat-icon">
                <i class="fas fa-blog"></i>
            </div>
            <div class="stat-details">
                <h3>Total Blogs</h3>
                <div class="stat-number">{{ $stats['blogs'] }}</div>
                <p class="stat-label">Published articles</p>
            </div>
            <div class="stat-chart">
                <i class="fas fa-chart-line"></i>
            </div>
        </div>

        <!-- Messages Card -->
        <div class="stat-card card-orange">
            <div class="stat-icon">
                <i class="fas fa-envelope"></i>
            </div>
            <div class="stat-details">
                <h3>Total Messages</h3>
                <div class="stat-number">{{ $stats['messages'] }}</div>
                <p class="stat-label">Pending inquiries</p>
            </div>
            <div class="stat-chart">
                <i class="fas fa-chart-line"></i>
            </div>
        </div>

        <!-- Users Card -->
        <div class="stat-card card-purple">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-details">
                <h3>Total Users</h3>
                <div class="stat-number">{{ $stats['users'] }}</div>
                <p class="stat-label">Registered users</p>
            </div>
            <div class="stat-chart">
                <i class="fas fa-chart-line"></i>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <h3 class="section-title">
            <i class="fas fa-bolt"></i>
            Quick Actions
        </h3>
        <div class="actions-grid">
            <a href="#" class="action-card">
                <div class="action-icon bg-blue">
                    <i class="fas fa-plus"></i>
                </div>
                <div class="action-content">
                    <h4>Add New Project</h4>
                    <p>Create a new luxury villa listing</p>
                </div>
            </a>

            <a href="#" class="action-card">
                <div class="action-icon bg-green">
                    <i class="fas fa-pen"></i>
                </div>
                <div class="action-content">
                    <h4>Write Blog Post</h4>
                    <p>Publish a new article</p>
                </div>
            </a>

            <a href="#" class="action-card">
                <div class="action-icon bg-orange">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="action-content">
                    <h4>View Messages</h4>
                    <p>Check customer inquiries</p>
                </div>
            </a>

            <a href="#" class="action-card">
                <div class="action-icon bg-purple">
                    <i class="fas fa-cog"></i>
                </div>
                <div class="action-content">
                    <h4>Settings</h4>
                    <p>Manage system settings</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="recent-activity">
        <h3 class="section-title">
            <i class="fas fa-history"></i>
            Recent Activity
        </h3>
        <div class="activity-list">
            <div class="activity-item">
                <div class="activity-icon bg-blue">
                    <i class="fas fa-briefcase"></i>
                </div>
                <div class="activity-details">
                    <h4>New project added</h4>
                    <p>Luxury Villa in Beverly Hills was added to the listings</p>
                    <span class="activity-time">2 hours ago</span>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-icon bg-green">
                    <i class="fas fa-blog"></i>
                </div>
                <div class="activity-details">
                    <h4>Blog post published</h4>
                    <p>"10 Tips for Luxury Real Estate Investment" is now live</p>
                    <span class="activity-time">5 hours ago</span>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-icon bg-orange">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="activity-details">
                    <h4>New message received</h4>
                    <p>Customer inquiry about Villa Grande Estate</p>
                    <span class="activity-time">1 day ago</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra_css')
<style>
    .dashboard-content {
        animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Welcome Card */
    .welcome-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px;
        border-radius: 15px;
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }

    .welcome-content h2 {
        font-size: 28px;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .welcome-content p {
        font-size: 16px;
        opacity: 0.95;
    }

    .welcome-date {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 16px;
        opacity: 0.9;
    }

    .welcome-date i {
        font-size: 20px;
    }

    /* Statistics Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    .stat-card {
        background: white;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        display: flex;
        align-items: flex-start;
        gap: 20px;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        flex-shrink: 0;
    }

    .card-blue .stat-icon {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .card-green .stat-icon {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
    }

    .card-orange .stat-icon {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }

    .card-purple .stat-icon {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }

    .stat-details {
        flex: 1;
    }

    .stat-details h3 {
        font-size: 14px;
        color: #7f8c8d;
        margin-bottom: 8px;
        font-weight: 500;
    }

    .stat-number {
        font-size: 36px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 13px;
        color: #95a5a6;
    }

    .stat-chart {
        position: absolute;
        right: 20px;
        bottom: 20px;
        font-size: 60px;
        opacity: 0.05;
    }

    /* Section Titles */
    .section-title {
        font-size: 20px;
        color: #2c3e50;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 600;
    }

    .section-title i {
        color: #3498db;
    }

    /* Quick Actions */
    .quick-actions {
        margin-bottom: 40px;
    }

    .actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
    }

    .action-card {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        display: flex;
        align-items: center;
        gap: 15px;
        text-decoration: none;
        color: inherit;
        transition: all 0.3s ease;
    }

    .action-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    .action-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 20px;
        flex-shrink: 0;
    }

    .bg-blue {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .bg-green {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    }

    .bg-orange {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .bg-purple {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .action-content h4 {
        font-size: 16px;
        color: #2c3e50;
        margin-bottom: 4px;
        font-weight: 600;
    }

    .action-content p {
        font-size: 13px;
        color: #7f8c8d;
    }

    /* Recent Activity */
    .recent-activity {
        background: white;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    }

    .activity-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .activity-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        padding: 15px;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .activity-item:hover {
        background: #f8f9fa;
    }

    .activity-icon {
        width: 45px;
        height: 45px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 18px;
        flex-shrink: 0;
    }

    .activity-details h4 {
        font-size: 15px;
        color: #2c3e50;
        margin-bottom: 5px;
        font-weight: 600;
    }

    .activity-details p {
        font-size: 14px;
        color: #7f8c8d;
        margin-bottom: 5px;
    }

    .activity-time {
        font-size: 12px;
        color: #95a5a6;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .welcome-card {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }

        .welcome-content h2 {
            font-size: 22px;
        }

        .stats-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .actions-grid {
            grid-template-columns: 1fr;
        }

        .stat-number {
            font-size: 28px;
        }
    }
</style>
@endsection

