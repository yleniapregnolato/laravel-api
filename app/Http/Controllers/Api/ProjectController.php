<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class ProjectController extends Controller
{
    public function index() {
        $projects = Project::with(['type', 'technologies'])->get();
        $data = [
            'results' => $projects,
            'success' => true
        ];
        return response()->json($data);
    }
}
