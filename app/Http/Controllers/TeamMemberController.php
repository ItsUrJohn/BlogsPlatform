<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends Controller
{
    private function checkAdmin()
    {
        if (!auth()->check() || auth()->user()->email !== 'admin@blogplatform.com') {
            abort(403, 'Unauthorized access.');
        }
    }

    public function index()
    {
        $this->checkAdmin();
        $members = TeamMember::orderBy('order')->get();
        return view('admin.team.index', compact('members'));
    }

    public function create()
    {
        $this->checkAdmin();
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $this->checkAdmin();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'description' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer',
        ]);

        $member = new TeamMember();
        $member->name = $request->name;
        $member->role = $request->role;
        $member->description = $request->description;
        $member->order = $request->order ?? 0;
        $member->is_active = $request->has('is_active');

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('team-avatars', 'public');
            $member->avatar = $path;
        }

        $member->save();

        return redirect('/admin/team')->with('success', 'Team member added successfully!');
    }

    public function edit($id)
    {
        $this->checkAdmin();
        $member = TeamMember::findOrFail($id);
        return view('admin.team.edit', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $this->checkAdmin();
        
        $member = TeamMember::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'description' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer',
        ]);

        $member->name = $request->name;
        $member->role = $request->role;
        $member->description = $request->description;
        $member->order = $request->order ?? 0;
        $member->is_active = $request->has('is_active');

        if ($request->hasFile('avatar')) {
            // Delete old avatar
            if ($member->avatar && Storage::disk('public')->exists($member->avatar)) {
                Storage::disk('public')->delete($member->avatar);
            }
            $path = $request->file('avatar')->store('team-avatars', 'public');
            $member->avatar = $path;
        }

        $member->save();

        return redirect('/admin/team')->with('success', 'Team member updated successfully!');
    }

    public function destroy($id)
    {
        $this->checkAdmin();
        $member = TeamMember::findOrFail($id);
        
        if ($member->avatar && Storage::disk('public')->exists($member->avatar)) {
            Storage::disk('public')->delete($member->avatar);
        }
        
        $member->delete();

        return redirect('/admin/team')->with('success', 'Team member deleted successfully!');
    }

    public function toggleStatus($id)
    {
        $this->checkAdmin();
        $member = TeamMember::findOrFail($id);
        $member->is_active = !$member->is_active;
        $member->save();

        return back()->with('success', 'Team member status updated!');
    }
}