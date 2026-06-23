<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\Issue;
use App\Models\Tag;
use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Create users
        $user1 = User::factory()->create([
            'name' => 'Edison Ndou',
            'email' => 'edison@example.com',
        ]);

        $user2 = User::factory()->create([
            'name' => 'Edison Ndou 2',
            'email' => 'edison2@example.com',
        ]);

        User::factory()->create([
            'name' => 'Edison Ndou 3',
            'email' => 'edison3@example.com',
        ]);

        // Create tags
        $tags = [];
        $tagData = [
            ['name' => 'Bug', 'color' => '#dc3545'],
            ['name' => 'Feature', 'color' => '#28a745'],
            ['name' => 'Enhancement', 'color' => '#17a2b8'],
            ['name' => 'Documentation', 'color' => '#6c757d'],
            ['name' => 'High Priority', 'color' => '#ffc107'],
        ];

        foreach ($tagData as $data) {
            $tags[] = Tag::create($data);
        }

        // Create projects for user1
        $project1 = Project::create([
            'user_id' => $user1->id,
            'name' => 'E-Commerce Platform',
            'description' => 'A full-featured e-commerce platform with payments integration',
            'start_date' => now()->subDays(30),
            'deadline' => now()->addDays(60),
        ]);

        $project2 = Project::create([
            'user_id' => $user1->id,
            'name' => 'Mobile App',
            'description' => 'React Native mobile application for iOS and Android',
            'start_date' => now()->subDays(15),
            'deadline' => now()->addDays(45),
        ]);

        // Create projects for user2
        $project3 = Project::create([
            'user_id' => $user2->id,
            'name' => 'Dashboard',
            'description' => 'Analytics dashboard for data visualization',
            'start_date' => now()->subDays(20),
            'deadline' => now()->addDays(30),
        ]);

        // Create issues for project1
        $issue1 = Issue::create([
            'project_id' => $project1->id,
            'title' => 'Implement user authentication',
            'description' => 'Add JWT-based authentication system',
            'status' => 'in_progress',
            'priority' => 'high',
            'due_date' => now()->addDays(5),
        ]);
        $issue1->tags()->attach([$tags[1]->id, $tags[4]->id]);
        $issue1->assignees()->attach([$user1->id, $user2->id]);

        $issue2 = Issue::create([
            'project_id' => $project1->id,
            'title' => 'Fix payment gateway bug',
            'description' => 'Stripe integration is throwing errors on certain amounts',
            'status' => 'open',
            'priority' => 'high',
            'due_date' => now()->addDays(2),
        ]);
        $issue2->tags()->attach([$tags[0]->id, $tags[4]->id]);
        $issue2->assignees()->attach($user1->id);

        $issue3 = Issue::create([
            'project_id' => $project1->id,
            'title' => 'Add product search functionality',
            'description' => 'Implement Elasticsearch for fast product search',
            'status' => 'open',
            'priority' => 'medium',
            'due_date' => now()->addDays(14),
        ]);
        $issue3->tags()->attach([$tags[1]->id]);

        // Create issues for project2
        $issue4 = Issue::create([
            'project_id' => $project2->id,
            'title' => 'Setup CI/CD pipeline',
            'description' => 'Configure GitHub Actions for automated testing and deployment',
            'status' => 'closed',
            'priority' => 'high',
            'due_date' => now()->subDays(10),
        ]);
        $issue4->tags()->attach([$tags[2]->id]);
        $issue4->assignees()->attach($user1->id);

        $issue5 = Issue::create([
            'project_id' => $project2->id,
            'title' => 'Update documentation',
            'description' => 'Update API documentation with new endpoints',
            'status' => 'open',
            'priority' => 'low',
            'due_date' => now()->addDays(7),
        ]);
        $issue5->tags()->attach([$tags[3]->id]);

        // Create comments
        Comment::create([
            'issue_id' => $issue1->id,
            'author_name' => $user1->name,
            'body' => 'I\'ve started working on the JWT implementation. Should be done by tomorrow.',
        ]);

        Comment::create([
            'issue_id' => $issue1->id,
            'author_name' => $user2->name,
            'body' => 'Great! Make sure to add refresh token support as well.',
        ]);

        Comment::create([
            'issue_id' => $issue2->id,
            'author_name' => $user1->name,
            'body' => 'Found the issue - it\'s related to decimal precision. Working on a fix.',
        ]);
    }
}

