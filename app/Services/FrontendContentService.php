<?php

namespace App\Services;

use App\Models\ClientJob;

class FrontendContentService
{
    public function home(): array
    {
        return [
            'heroCategories' => [
                'Logo Design',
                'Web Development',
                'Video Editing',
                'Writing & Translation',
                'Social Media',
                'SEO',
            ],
            'heroStats' => [
                ['value' => '25K+', 'label' => 'Freelancers'],
                ['value' => '98%', 'label' => 'Satisfaction Rate'],
                ['value' => '150K+', 'label' => 'Projects Done'],
                ['value' => '24/7', 'label' => 'Support'],
            ],
            'services' => [
                [
                    'icon' => '🎨',
                    'title' => 'Design & Creative',
                    'description' => 'Logos, branding, illustrations, UI/UX',
                    'count' => '3.2K+ services',
                    'color' => '#f59e0b',
                ],
                [
                    'icon' => '💻',
                    'title' => 'Web Development',
                    'description' => 'Frontend, backend, full-stack, CMS',
                    'count' => '5.8K+ services',
                    'color' => '#3b82f6',
                ],
                [
                    'icon' => '📝',
                    'title' => 'Writing & Content',
                    'description' => 'Copywriting, SEO, blogs, translation',
                    'count' => '4.1K+ services',
                    'color' => '#10b981',
                ],
                [
                    'icon' => '🎬',
                    'title' => 'Video & Animation',
                    'description' => 'Editing, motion graphics, explainers',
                    'count' => '2.4K+ services',
                    'color' => '#ef4444',
                ],
                [
                    'icon' => '📣',
                    'title' => 'Digital Marketing',
                    'description' => 'Social media, ads, email, analytics',
                    'count' => '3.7K+ services',
                    'color' => '#8b5cf6',
                ],
                [
                    'icon' => '🎵',
                    'title' => 'Music & Audio',
                    'description' => 'Voice overs, mixing, sound design',
                    'count' => '1.9K+ services',
                    'color' => '#ec4899',
                ],
            ],
            'howItWorksSteps' => [
                [
                    'number' => '01',
                    'title' => 'Post Your Project',
                    'description' => "Describe what you need — budget, timeline, and requirements. It's free to post.",
                    'icon' => '📋',
                ],
                [
                    'number' => '02',
                    'title' => 'Review Proposals',
                    'description' => 'Talented freelancers reach out within hours. Browse profiles, portfolios, and reviews.',
                    'icon' => '🔍',
                ],
                [
                    'number' => '03',
                    'title' => 'Hire & Collaborate',
                    'description' => 'Choose the best fit, share files, and communicate — all on the platform.',
                    'icon' => '🤝',
                ],
                [
                    'number' => '04',
                    'title' => 'Pay Securely',
                    'description' => 'Funds are held safely and released only when you approve the finished work.',
                    'icon' => '🔒',
                ],
            ],
        ];
    }

    public function about(): array
    {
        return [
            'trusts' => [
                [
                    'icon' => '🔒',
                    'title' => 'Secure Payments',
                    'desc' => 'Funds are held in escrow and only released when the work is approved.',
                    'color' => '#3b82f6',
                ],
                [
                    'icon' => '✅',
                    'title' => 'Verified Profiles',
                    'desc' => 'Every freelancer undergoes identity and skill verification before listing.',
                    'color' => '#22c55e',
                ],
                [
                    'icon' => '⭐',
                    'title' => 'Honest Reviews',
                    'desc' => 'Real ratings from real clients — no fake reviews, ever.',
                    'color' => '#ffcc00',
                ],
                [
                    'icon' => '🛡️',
                    'title' => 'Dispute Protection',
                    'desc' => 'Our dedicated support team mediates and resolves every conflict fairly.',
                    'color' => '#ef4444',
                ],
                [
                    'icon' => '⚡',
                    'title' => 'Fast Matching',
                    'desc' => 'Smart algorithms connect you with the best professional in minutes.',
                    'color' => '#a855f7',
                ],
                [
                    'icon' => '🌍',
                    'title' => 'Global Reach',
                    'desc' => 'Hire locally or internationally — across 80+ countries and 150+ skills.',
                    'color' => '#f59e0b',
                ],
            ],
            'professions' => [
                ['icon' => '🔧', 'name' => 'Mechanics'],
                ['icon' => '✂️', 'name' => 'Barbers'],
                ['icon' => '🚿', 'name' => 'Plumbers'],
                ['icon' => '⚡', 'name' => 'Electricians'],
                ['icon' => '🏠', 'name' => 'Cleaners'],
                ['icon' => '📸', 'name' => 'Photographers'],
                ['icon' => '🚗', 'name' => 'Drivers'],
                ['icon' => '🎓', 'name' => 'Tutors'],
                ['icon' => '🍳', 'name' => 'Chefs'],
            ],
            'steps' => [
                [
                    'num' => '01',
                    'title' => 'Post Your Need',
                    'desc' => 'Describe the job, set your budget and timeline. Free to post in under 2 minutes.',
                ],
                [
                    'num' => '02',
                    'title' => 'Get Matched',
                    'desc' => 'Browse proposals from verified professionals. Compare profiles, ratings, and prices.',
                ],
                [
                    'num' => '03',
                    'title' => 'Work Together',
                    'desc' => 'Communicate, share files, and track progress — all in one secure place.',
                ],
                [
                    'num' => '04',
                    'title' => 'Pay Securely',
                    'desc' => 'Release payment only when the job is done to your satisfaction.',
                ],
            ],
            'stats' => [
                ['value' => 85000, 'suffix' => '+', 'label' => 'Registered Clients'],
                ['value' => 25000, 'suffix' => '+', 'label' => 'Active Freelancers'],
                ['value' => 150000, 'suffix' => '+', 'label' => 'Projects Completed'],
                ['value' => 98, 'suffix' => '%', 'label' => 'Satisfaction Rate'],
            ],
            'teamValues' => [
                [
                    'icon' => '🎯',
                    'title' => 'Purpose-Driven',
                    'desc' => 'We exist to democratize access to skilled work, everywhere.',
                ],
                [
                    'icon' => '🤝',
                    'title' => 'Trust First',
                    'desc' => 'Every decision we make starts with the safety of our community.',
                ],
                [
                    'icon' => '🚀',
                    'title' => 'Built to Scale',
                    'desc' => 'Our platform evolves with your needs — always improving, never settling.',
                ],
            ],
        ];
    }

    public function contact(): array
    {
        return [
            'subjects' => [
                ['value' => '', 'label' => 'Choisir un sujet...'],
                ['value' => 'delay_client', 'label' => "⏱ Retard — De la part d'un client"],
                ['value' => 'delay_service', 'label' => "⏱ Retard — De la part d'un service"],
                ['value' => 'suggestion', 'label' => "💡 Suggestion d'amélioration"],
                ['value' => 'other', 'label' => '✉ Autre demande'],
            ],
            'subjectMeta' => [
                'delay_client' => [
                    'color' => '#ef4444',
                    'label' => 'Retard Client',
                    'hint' => 'Décrivez le retard constaté : date prévue, date réelle, impact sur votre projet.',
                ],
                'delay_service' => [
                    'color' => '#f59e0b',
                    'label' => 'Retard Service',
                    'hint' => 'Précisez le service concerné et les délais non respectés.',
                ],
                'suggestion' => [
                    'color' => '#22c55e',
                    'label' => 'Suggestion',
                    'hint' => 'Partagez votre idée pour améliorer la plateforme.',
                ],
                'other' => [
                    'color' => '#f59e0b',
                    'label' => 'Autre',
                    'hint' => 'Décrivez votre demande en détail.',
                ],
            ],
        ];
    }

    public function signup(): array
    {
        $fallbackJobs = [
            'Laravel backend developer',
            'React landing page',
            'Logo redesign',
            'WordPress website setup',
            'SEO content writer',
        ];

        $availableJobs = ClientJob::query()
            ->select('title')
            ->distinct()
            ->orderBy('title')
            ->pluck('title')
            ->filter()
            ->values()
            ->all();

        return [
            'availableJobs' => $availableJobs !== [] ? $availableJobs : $fallbackJobs,
        ];
    }
}
