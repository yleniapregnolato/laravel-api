<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class ProjectController extends Controller
{
    public function index() {
        $projects = Project::with(['type'])->get();
        $data = [
            'results' => $projects,
            'success' => true
        ];
        return response()->json($data);
    }

    public function show(string $slug) {
        $project = Project::with(['type', 'technologies'])->where('slug', $slug)->first();
        if(!$project) {
            return response()->json(404);
        }

        return response()->json($project);
    }
};

