<?php

use Illuminate\Database\Seeder;
use nojes\employees\Models\Position;

class EmployeePositionTableSeeder extends Seeder
{
    /**
     * @var bool Use the `PositionFactory`.
     */
    public $useFactory = false;

    /**
     * @var array Position titles.
     */
    public static $titles = [
        'Accessibility Specialist',
        'Agile Project Manager',
        'Business Systems Analyst',
        'Cloud Architect',
        'Computer Graphics Animator',
        'Computer Network Architect',
        'Computer Support Specialist',
        'Content Manager',
        'Content Strategist',
        'Data Analyst',
        'Data Architect',
        'Data Modeler',
        'Data Scientist',
        'Database Administrator',
        'Database Administrator',
        'Designer',
        'DevOps Manager',
        'Digital Marketing Manager',
        'Frameworks Specialist',
        'Front-End Designer',
        'Front-End Developer',
        'Full-Stack Developer',
        'Game Developer',
        'Growth Hacker',
        'Information Architect',
        'Information Security Analyst',
        'Interaction Designer',
        'Marketing Technologist',
        'Mobile App Developer',
        'Mobile Developer',
        'Product Manager',
        'Project Lead',
        'QA (Quality Assurance) Specialist',
        'Security Specialist',
        'SEO Consultant',
        'Social Media Manager',
        'Software Developer',
        'Systems Administrator',
        'Systems Engineer',
        'Technical Account Manager',
        'Technical Lead',
        'UI Designer',
        'UX Designer',
        'Web Analytics Developer',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!$this->useFactory) {
            foreach (self::$titles as $title) {
                (new Position(['title' => $title]))->save();
            }
        } else {
            factory(Position::class, count(self::$titles))->create()->each(function($model) {
                $model->save();
            });
        }
    }
}
