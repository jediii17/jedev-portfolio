<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Traits\HasPortfolioData;

class PortfolioController extends Controller
{
    use HasPortfolioData;
    public function index(): View
    {
        $projects = $this->getProjectsData();
        $skills = $this->getSkillsData();
        $experience = $this->getExperienceData();
        $certification = array_slice($this->getCertificationsData(), 0, 4);
        $recommendations = $this->getRecommendationsData();

        return view('index', compact('projects', 'skills', 'experience', 'certification', 'recommendations'));
    }

    public function projects(): View
    {
        $projects = $this->getProjectsData();
        return view('projects', compact('projects'));
    }

    public function certifications(): View
    {
        $certifications = $this->getCertificationsData();
        return view('certifications', compact('certifications'));
    }

    public function skills(): View
    {
        $skills = $this->getSkillsData();
        return view('skills', compact('skills'));
    }
}
