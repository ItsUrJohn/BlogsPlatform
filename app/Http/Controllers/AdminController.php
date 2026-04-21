<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // Check if user is admin
    private function checkAdmin()
    {
        if (!auth()->check() || auth()->user()->email !== 'admin@blogplatform.com') {
            abort(403, 'Unauthorized access. Admin only area.');
        }
    }
    
    public function dashboard()
    {
        $this->checkAdmin();
        
        // Total users
        $totalUsers = User::count();
        
        // Users registered this month
        $usersThisMonth = User::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        
        // Users registered last month
        $usersLastMonth = User::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();
        
        // Percentage change
        $userGrowth = $usersLastMonth > 0 
            ? round(($usersThisMonth - $usersLastMonth) / $usersLastMonth * 100, 1)
            : 100;
        
        // Total contacts
        $totalContacts = Contact::count();
        
        // Unread contacts
        $unreadContacts = Contact::where('is_read', false)->count();
        
        // Recent contacts
        $recentContacts = Contact::latest()->take(5)->get();
        
        // User registration data for chart (last 6 months)
        $userChartData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $count = User::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
            $userChartData[] = [
                'month' => $month->format('M Y'),
                'count' => $count
            ];
        }
        
        // Recent users
        $recentUsers = User::latest()->take(10)->get();
        
        return view('admin.dashboard', compact(
            'totalUsers', 'usersThisMonth', 'userGrowth', 'totalContacts', 
            'unreadContacts', 'recentContacts', 'userChartData', 'recentUsers'
        ));
    }
    
    public function contacts()
    {
        $this->checkAdmin();
        $contacts = Contact::latest()->paginate(20);
        return view('admin.contacts', compact('contacts'));
    }
    
    public function markAsRead($id)
    {
        $this->checkAdmin();
        $contact = Contact::findOrFail($id);
        $contact->update(['is_read' => true]);
        
        return back()->with('success', 'Message marked as read');
    }
    
    public function deleteContact($id)
    {
        $this->checkAdmin();
        $contact = Contact::findOrFail($id);
        $contact->delete();
        
        return back()->with('success', 'Message deleted successfully');
    }
    
    public function users()
    {
        $this->checkAdmin();
        $users = User::latest()->paginate(20);
        return view('admin.users', compact('users'));
    }
    
    public function deleteUser($id)
    {
        $this->checkAdmin();
        $user = User::findOrFail($id);
        
        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account');
        }
        
        $user->delete();
        
        return back()->with('success', 'User deleted successfully');
    }
}