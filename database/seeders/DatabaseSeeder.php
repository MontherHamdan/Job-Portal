<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Employer;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(100)->create();

        // shuffle() will randomize all the element
        $users = User::all()->shuffle();


        for ($i = 0; $i < 20; $i++) {
            // pop()  itwill return one of the users from the collection and it will also remove it from the $users that we loded in above(all())
            Employer::factory()->create([
                'user_id' => $users->pop()->id
            ]);
        }

        $employers = Employer::all();

        for ($i = 0; $i < 100; $i++) {
            Job::factory()->create([
                'employer_id' => $employers->random()->id
            ]);
        }

        foreach ($users as $user) {
            $jobs = Job::inRandomOrder()->take(rand(0, 4))->get();


            foreach ($jobs as $job) {
                JobApplication::factory()->create([
                    'job_id' => $job->id,
                    'user_id' => $user->id
                ]);
            }
        }




        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'monther',
            'email' => 'm@example.com',
        ]);
    }
}
