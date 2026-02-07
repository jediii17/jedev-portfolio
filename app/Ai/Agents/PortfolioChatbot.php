<?php

namespace App\Ai\Agents;

use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Promptable;
use Stringable;

use App\Traits\HasPortfolioData;

class PortfolioChatbot implements Agent
{
    use Promptable, HasPortfolioData;

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): Stringable|string
    {
        return $this->buildInstructions();
    }

    /**
     * Build the system prompt with all portfolio data.
     */
    private function buildInstructions(): string
    {
        $template = file_get_contents(resource_path('prompts/portfolio_chatbot.md'));
        $data = $this->getPortfolioData();

        return strtr($template, [
            '{{skills}}' => $data['skills'],
            '{{experience}}' => $data['experience'],
            '{{projects}}' => $data['projects'],
            '{{certifications}}' => $data['certifications'],
            '{{recommendations}}' => $data['recommendations'],
        ]);
    }

    /**
     * Get all portfolio data for the chatbot context.
     */
    private function getPortfolioData(): array
    {
        return [
            'skills' => $this->formatSkills(),
            'experience' => $this->formatExperience(),
            'projects' => $this->formatProjects(),
            'certifications' => $this->formatCertifications(),
            'recommendations' => $this->formatRecommendations(),
        ];
    }

    private function formatSkills(): string
    {
        $skills = $this->getSkillsData();

        $output = '';
        foreach ($skills as $category => $items) {
            $output .= "- **{$category}**: " . implode(', ', $items) . "\n";
        }
        return $output;
    }

    private function formatExperience(): string
    {
        $experience = $this->getExperienceData();

        $output = '';
        foreach ($experience as $exp) {
            $output .= "- **{$exp['role']}** at {$exp['company']} ({$exp['period']})\n";
        }
        return $output;
    }

    private function formatProjects(): string
    {
        $projects = $this->getProjectsData();

        $output = '';
        foreach ($projects as $project) {
            $tech = implode(', ', $project['tech']);
            $output .= "- **{$project['title']}** ({$project['year']}): {$project['description']} Tech: {$tech}\n";
        }
        return $output;
    }

    private function formatCertifications(): string
    {
        $certs = $this->getCertificationsData();

        $output = '';
        foreach ($certs as $cert) {
            $output .= "- **{$cert['title']}** by {$cert['company']} ({$cert['year']})\n";
        }
        return $output;
    }

    private function formatRecommendations(): string
    {
        $recommendations = $this->getRecommendationsData();

        $output = '';
        foreach ($recommendations as $rec) {
            $output .= "- \"{$rec['text']}\" — **{$rec['author']}**, {$rec['title']}\n";
        }
        return $output;
    }
}
