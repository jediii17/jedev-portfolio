<?php

namespace App\Traits;

trait HasPortfolioData
{
    /**
     * Get the skills data grouped by category.
     */
    public function getSkillsData(): array
    {
        return [
            'Frontend' => ['JavaScript', 'TypeScript', 'React', 'Next.js', 'Vue.js', 'Tailwind CSS', 'Alpine.js', 'Matter.js', 'GSAP', 'Lenis', 'Three.js', 'WebGL', 'Framer Motion', 'Vite', 'WebSockets'],
            'Backend' => ['PHP', 'Laravel', 'Node.js', 'Python', 'Flask', 'PostgreSQL', 'MySQL', 'SQL Server', 'RESTful APIs', 'JWT', 'OAuth', 'Spatie Packages'],
            'AI & Machine Learning' => ['OpenAI', 'OpenCV', 'Roboflow', 'PyTorch', 'YOLOv8', 'Google Colab'],
            'DevOps & Tools' => ['Docker', 'GitHub', 'Gitlab', 'Google Cloud', 'Firebase', 'VS Code', 'Azure Data Studio', 'SourceTree'],
        ];
    }

    /**
     * Get the professional experience data.
     */
    public function getExperienceData(): array
    {
        return [
            [
                'role' => 'Software Engineer',
                'company' => 'MobileMinds Inc.',
                'period' => '2024 - Present',
                'description' => '',
            ],
            [
                'role' => 'Web Application Developer',
                'company' => 'NYK-Fil Maritime E-Training, Inc.',
                'period' => '2024',
                'description' => '',
            ],
            [
                'role' => 'Freelance Developer',
                'company' => 'Self-Employed',
                'period' => '2022 - 2023',
                'description' => '',
            ],
            [
                'role' => 'BS Computer Engineering',
                'company' => 'University of Perpetual Help System DALTA - Calamba Campus',
                'period' => '2024',
                'description' => '',
            ],
            [
                'role' => 'Hello World! 🤖',
                'company' => '',
                'period' => '2020',
                'description' => '',
            ]
        ];
    }

    /**
     * Get all projects.
     */
    public function getProjectsData(): array
    {
        return [
            [
                'title' => 'AI Assistance Mobile App (Backend Server)',
                'year' => '2025 - Present',
                'description' => 'A dating app backend that uses AI to generate personalized pickup lines and facilitate conversations. Built with Node.js, Express, and Firebase, featuring Google Play subscription integration.',
                'tech' => ['Node.js', 'Express', 'Firebase', 'OpenAI', 'Google Cloud Pub/Sub', 'Google Play Console'],
                'contribution' => [
                    'Created backend server and APIs for the mobile app.',
                    'Integrated OpenAI for AI-driven features.',
                    'Managed Google Play subscriptions and Real-Time Developer Notifications (RTDN).',
                    'Implemented event-driven architecture with Google Cloud Pub/Sub.'
                ]
            ],
            [
                'title' => 'Employee Portal Redevelopment',
                'year' => '2025',
                'description' => 'Full system redevelopment migrating a legacy ColdFusion employee portal to Laravel 12. Improved performance, security, and maintainability.',
                'tech' => ['Laravel 12', 'Inertia.js', 'Vue 3', 'Tailwind CSS', 'SQL Server', 'Docker', 'Spatie Multitenancy'],
                'contribution' => [
                    'Replicated legacy ColdFusion encryption logic for seamless transition.',
                    'Implemented Spatie Laravel Multitenancy for database switching.',
                    'Developed secure salary encryption/decryption modules using DLLs.',
                    'Built core project structure and reusable Vue 3 components.'
                ]
            ],
            [
                'title' => 'Desktop to Web Tellering System Migration',
                'year' => '2025',
                'description' => 'Transformed a desktop tellering system into a modern web application with a custom CMS using Laravel 12 and Vue 3.',
                'tech' => ['Laravel 12', 'Inertia.js', 'Vue 3', 'Tailwind CSS', 'MySQL', 'WebSockets (Reverb)'],
                'contribution' => [
                    'Developed the Content Management System (CMS).',
                    'Implemented officer-override features using Laravel Reverb (WebSockets).',
                    'Created Check Deposit module and reusable POC components.',
                    'Resolved complex environment issues (419 page expired during concurrent execution).'
                ]
            ],
            [
                'title' => 'Monitoring Work Order System',
                'year' => '2025',
                'description' => 'Web-based system for tracking work orders, time charges, leave management, and manpower allocation across projects.',
                'tech' => ['Laravel 11', 'Inertia.js', 'Vue 3', 'Tailwind CSS', 'MySQL'],
                'contribution' => [
                    'Designed database schema and implemented Eloquent ORM relationships.',
                    'Developed CRUD functionalities for project modules.',
                    'Integrated Spatie Permission for role-based access control.',
                    'Implemented automated email notifications for password resets.'
                ]
            ],
            [
                'title' => 'Content Management System',
                'year' => '2024',
                'description' => 'Centralized administration system for employee records, user roles, and audit trails to ensure meaningful accountability.',
                'tech' => ['Laravel 11', 'Inertia.js', 'Vue 3', 'Tailwind CSS', 'MySQL'],
                'contribution' => [
                    'Designed comprehensive database schema and established Eloquent ORM.',
                    'Implemented granular role-based security with Spatie.',
                    'Developed secure CRUD modules for employee data.'
                ]
            ],
            [
                'title' => 'Attendance Monitoring System with Face Recognition',
                'year' => '2025',
                'description' => 'IoT-based attendance system using face recognition to automate logging and send SMS/email notifications to guardians.',
                'tech' => ['Python', 'Tkinter', 'OpenCV', 'SQLite', 'Raspberry Pi', 'GSM Module'],
                'contribution' => [
                    'Designed GUI for attendance logs using Tkinter.',
                    'Enhanced notification system (SMS/Email).',
                    'Integrated SQLite for structured record keeping.'
                ]
            ],
            [
                'title' => 'FireQuake Detection Prototype (Capstone)',
                'year' => '2023 - 2024',
                'description' => 'Award-winning "Best in Thesis" prototype detecting fire via computer vision and earthquakes via seismic sensors.',
                'tech' => ['Python', 'YOLOv8', 'OpenCV', 'Raspberry Pi', 'Flask', 'Roboflow'],
                'contribution' => [
                    'Trained YOLOv8 models for fire/smoke detection.',
                    'Developed web dashboard for real-time monitoring and logging.',
                    'Integrated seismic sensors and hardware components.'
                ]
            ],
            [
                'title' => 'Supplier Management System',
                'year' => '2024',
                'description' => 'System facilitating efficient transaction management between company and suppliers for Bill of Materials (BOM).',
                'tech' => ['PHP', 'Laravel', 'Livewire', 'Bootstrap', 'MySQL'],
                'contribution' => [
                    'Designed overall system UI.',
                    'Implemented supplier dashboard and document uploads.',
                    'Built authentication features including password reset and real-time validation.'
                ]
            ]
        ];
    }

    /**
     * Get all certifications.
     */
    public function getCertificationsData(): array
    {
        return [
            [
                'title' => 'Artificial Intelligence for Communities Workshop',
                'company' => 'VJAL Institute',
                'year' => '2026',
                'link' => 'https://cert.vjal.ai/certificate/?uid=6451931831327090123'
            ],
            [
                'title' => 'CompTIA IT Fundamentals+ (ITTF+)',
                'company' => 'CompTIA',
                'year' => '2024',
                'link' => 'https://www.credly.com/badges/bd9d1b08-b5b8-4be4-846c-b661128f1dec/linked_in_profile'
            ],
            [
                'title' => 'Google AI Essentials V1',
                'company' => 'Google (Coursera)',
                'year' => '2024',
                'link' => 'https://coursera.org/share/123742dfacbf353d3cbbdbedfb2e2a30'
            ],
            [
                'title' => 'Google AI Essentials V1 Badge',
                'company' => 'Credly',
                'year' => '2024',
                'link' => 'https://www.credly.com/badges/4f22f53a-31a7-4032-9351-4cfb3c281c5b/public_url'
            ],
            [
                'title' => 'Google IT Automation with Python',
                'company' => 'Google (Coursera)',
                'year' => '2024',
                'link' => 'https://coursera.org/share/8f283c6773691134f30a82a52dc0f9ea'
            ],
            [
                'title' => 'Configuration Management and the Cloud',
                'company' => 'Google (Coursera)',
                'year' => '2024',
                'link' => 'https://coursera.org/share/f3e400c444c9d2e7eb728023193f9687'
            ],
            [
                'title' => 'Troubleshooting and Debugging Techniques',
                'company' => 'Google (Coursera)',
                'year' => '2024',
                'link' => 'https://coursera.org/share/d2674b3be36b1a497eb9277b56a145ef'
            ],
            [
                'title' => 'Introduction to Git and GitHub',
                'company' => 'Google (Coursera)',
                'year' => '2024',
                'link' => 'https://coursera.org/share/2574f20ec2bfe80db16e0584eb8971f0'
            ],
            [
                'title' => 'Using Python to Interact with the Operating System',
                'company' => 'Google (Coursera)',
                'year' => '2024',
                'link' => 'https://coursera.org/share/d89aab17c8714d9d8d4d9bb594e1603d'
            ],
            [
                'title' => 'Crash Course on Python',
                'company' => 'Google (Coursera)',
                'year' => '2024',
                'link' => 'https://coursera.org/share/fd4148dc63f8dcafc392d0a3609bfcb3'
            ]
        ];
    }

    /**
     * Get recommendations data.
     */
    public function getRecommendationsData(): array
    {
        return [
            [
                'text' => 'Jed is a good student and software developer who shows professionalism and dedication in whatever he does. His software projects during his academic years are up to standard and is being used by the university for some of its operations.',
                'author' => 'Jerome Refran, MIT',
                'title' => 'Professor at University of Perpetual Help System DALTA - Calamba Campus'
            ],
            [
                'text' => 'A highly skilled developer who consistently delivers high-quality code. His ability to solve complex problems and adapt to new technologies is impressive.',
                'author' => 'Ms Marilyn',
                'title' => 'Project Manager at Asia United Bank'
            ],
            [
                'text' => 'A pleasure to work with. He has a great eye for detail and is always willing to go the extra mile to ensure project success.',
                'author' => 'Ms Kristel Matriano',
                'title' => 'Senior Software Engineer at MobileMinds Inc.'
            ],
            [
                'text' => 'Jed is one of those rare backend developers who truly cares about the elegance and scalability of our code. While working together on our mobile app, I was consistently impressed by his ability to design robust REST APIs and  optimize complex database queries. His commitment to clean code and thorough unit testing significantly reduced our production bugs and improved system reliability. Any engineering team would be happy to have Jed as a core contributor.',
                'author' => 'Timothy Cruz',
                'title' => 'Senior Mobile Developer'
            ]
        ];
    }
}
