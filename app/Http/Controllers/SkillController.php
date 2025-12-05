<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::orderBy('name')->get();
        return view('hrm.skills.index', compact('skills'));
    }

    public function create()
    {
        return view('hrm.skills.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:skills,name',
        ]);

        Skill::create($data);
        return redirect()->route('skills.index')->with('success', 'Skill created');
    }
}
