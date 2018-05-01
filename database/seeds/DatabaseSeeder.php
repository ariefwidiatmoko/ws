<?php

use App\User;
use App\Role;
use App\Permission;
use App\Profile;
use App\Subject;
use Carbon\Carbon;
use App\Lesson;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  
    public function run()
    {

        // Call the php artisan migrate:refresh
        $this->command->call('migrate:refresh');
        $this->command->warn("Data cleared, starting from blank database.");

        // Seed the default permissions
        $permissions = Permission::defaultPermissions();

        foreach ($permissions as $perms) {
            Permission::firstOrCreate(['name' => $perms]);
        }

        $this->command->info('Default Permissions added.');

        // Ask for roles from input
        $input_roles = 'Admin,User';

        // Explode roles
        $roles_array = explode(',', $input_roles);

        // add roles
        foreach($roles_array as $role) {
            $role = Role::firstOrCreate(['name' => trim($role)]);

            if( $role->name == 'Admin' ) {
                // assign all permissions
                $role->syncPermissions(Permission::all());
                $this->command->info('Admin granted all the permissions');
            } else {
                // for others by default only read access
                $role->syncPermissions(Permission::where('name', 'LIKE', 'view_%')->get());
            }
        }

        factory(App\User::class)->create([
          'name' => 'superadmin',
          'email' => 'ariefwidiatmoko@gmail.com',
          'password' => 'secret',
        ])->assignRole('Admin');

        factory(App\User::class)->create([
          'name' => 'superadmin2',
          'email' => 'superadmin2@gmail.com',
          'password' => 'secret',
        ])->assignRole('Admin');

        factory(App\User::class)->create([
          'name' => 'user',
          'password' => 'secret',
        ])->assignRole('User');

        $this->command->info('Here is your admin details to login:');
        $this->command->warn('ariefwidiatmoko@gmail.com');
        $this->command->warn('Password is "secret"');

        $this->command->info('Roles ' . $input_roles . ' added successfully');

        factory(App\Month::class)->create([
          'noId' => '01',
          'monthname' => 'January',
          'alias' => 'Jan',
        ]);

        factory(App\Month::class)->create([
          'noId' => '02',
          'monthname' => 'February',
          'alias' => 'Feb',
        ]);

        factory(App\Month::class)->create([
          'noId' => '03',
          'monthname' => 'March',
          'alias' => 'Mar',
        ]);

        factory(App\Month::class)->create([
          'noId' => '04',
          'monthname' => 'April',
          'alias' => 'Apr',
        ]);

        factory(App\Month::class)->create([
          'noId' => '05',
          'monthname' => 'May',
          'alias' => 'May',
        ]);

        factory(App\Month::class)->create([
          'noId' => '06',
          'monthname' => 'June',
          'alias' => 'Jun',
        ]);

        factory(App\Month::class)->create([
          'noId' => '07',
          'monthname' => 'July',
          'alias' => 'Jul',
        ]);

        factory(App\Month::class)->create([
          'noId' => '08',
          'monthname' => 'August',
          'alias' => 'Aug',
        ]);

        factory(App\Month::class)->create([
          'noId' => '09',
          'monthname' => 'September',
          'alias' => 'Sep',
        ]);

        factory(App\Month::class)->create([
          'noId' => '10',
          'monthname' => 'October',
          'alias' => 'Oct',
        ]);

        factory(App\Month::class)->create([
          'noId' => '11',
          'monthname' => 'November',
          'alias' => 'Nov',
        ]);

        factory(App\Month::class)->create([
          'noId' => '12',
          'monthname' => 'December',
          'alias' => 'Dec',
        ]);

        factory(App\Profile::class)->create([
          'user_id' => '1',
          'profilename' => 'Arief Widiatmoko',
          'dob' => '1984-07-10',
          'phone' => '08974743477',
          'education' => 'Sarjana Pertanian IPB',
          'address' => 'Bogor, Indonesia',
          'about' => 'Passion in Coding, May Coding in You',
          'avatar' => 'owner.jpg'
        ]);

        factory(App\Profile::class)->create([
          'user_id' => '2',
          'profilename' => 'Superadmin2',
          'dob' => '1990-01-01',
          'phone' => '08120000000',
          'education' => 'S1',
          'address' => 'Indonesia',
          'about' => 'Always Forever Selalu',
          'avatar' => 'owner.jpg'
        ]);
        factory(App\Profile::class)->create([
          'user_id' => '3',
        ]);
        factory(App\Grade::class)->create([
          'user_id' => '1',
          'gradename' => '7',
          'alias' => '1',
        ]);
        factory(App\Grade::class)->create([
          'user_id' => '1',
          'gradename' => '8',
          'alias' => '2',
        ]);
        factory(App\Grade::class)->create([
          'user_id' => '1',
          'gradename' => '9',
          'alias' => '3',
        ]);
        factory(App\Classroom::class)->create([
          'user_id' => '1',
          'classroomname' => '7A',
          'alias' => '1A',
          'classroomactive' => '1',
        ]);
        factory(App\Classroom::class)->create([
          'user_id' => '1',
          'classroomname' => '7B',
          'alias' => '1B',
          'classroomactive' => '1',
        ]);
        factory(App\Classroom::class)->create([
          'user_id' => '1',
          'classroomname' => '8A',
          'alias' => '2A',
          'classroomactive' => '1',
        ]);
        factory(App\Classroom::class)->create([
          'user_id' => '1',
          'classroomname' => '8B',
          'alias' => '2B',
          'classroomactive' => '1',
        ]);
        factory(App\Classroom::class)->create([
          'user_id' => '1',
          'classroomname' => '9A',
          'alias' => '3A',
          'classroomactive' => '1',
        ]);
        factory(App\Classroom::class)->create([
          'user_id' => '1',
          'classroomname' => '9B',
          'alias' => '3B',
          'classroomactive' => '1',
        ]);
        factory(App\Subject::class)->create([
          'user_id' => '1',
          'subjectname' => 'AGM',
          'alias' => 'Agama',
          'subjectactive' => '1',
        ]);
        factory(App\Subject::class)->create([
          'user_id' => '1',
          'subjectname' => 'BHS',
          'alias' => 'Bahasa Indonesia',
          'subjectactive' => '1',
        ]);
        factory(App\Subject::class)->create([
          'user_id' => '1',
          'subjectname' => 'PKn',
          'alias' => 'Pendidikan Kewarganegaraan',
          'subjectactive' => '1',
        ]);
        factory(App\Subject::class)->create([
          'user_id' => '1',
          'subjectname' => 'MAT',
          'alias' => 'Matematika',
          'subjectactive' => '1',
        ]);
        factory(App\Subject::class)->create([
          'user_id' => '1',
          'subjectname' => 'PJK',
          'alias' => 'Pendidikan Jasmani Kesehatan',
          'subjectactive' => '1',
        ]);
        factory(App\Subject::class)->create([
          'user_id' => '1',
          'subjectname' => 'SAINS',
          'alias' => 'Ilmu Pengetahuan Alam',
          'subjectactive' => '1',
        ]);
        factory(App\Subject::class)->create([
          'user_id' => '1',
          'subjectname' => 'SOSIAL',
          'alias' => 'Ilmu Pengetahuan Sosial',
          'subjectactive' => '1',
        ]);
        factory(App\Subject::class)->create([
          'user_id' => '1',
          'subjectname' => 'SENI',
          'alias' => 'Seni dan Budaya',
          'subjectactive' => '1',
        ]);
        factory(App\Subject::class)->create([
          'user_id' => '1',
          'subjectname' => 'JAWA',
          'alias' => 'Bahasa Jawa',
          'subjectactive' => '1',
        ]);
        factory(App\Subject::class)->create([
          'user_id' => '1',
          'subjectname' => 'ITK',
          'alias' => 'Ilmu Teknologi dan Komputer',
          'subjectactive' => '1',
        ]);
        factory(App\Position::class)->create([
          'user_id' => '1',
          'positionname' => 'Administration',
          'positionactive' => '1',
        ]);
        factory(App\Position::class)->create([
          'user_id' => '1',
          'positionname' => 'Home Teacher',
          'positionactive' => '1',
        ]);
        factory(App\Position::class)->create([
          'user_id' => '1',
          'positionname' => 'Principal',
          'positionactive' => '1',
        ]);
        factory(App\Position::class)->create([
          'user_id' => '1',
          'positionname' => 'Teacher',
          'positionactive' => '1',
        ]);
        factory(App\Employee::class)->create([
          'user_id' => '1',
          'month_id' => '02',
          'dob' => '2000-02-17',
          'employeeactive' => '1',
        ])->each(function ($employee) {
          $boolean = random_int(0, 1);

          $ids = range(1, 5);

          shuffle($ids);

          if($boolean) {
            $sliced = array_slice($ids, 0, 2);

            $employee->positions()->attach($sliced);
          } else {
            $employee->positions()->attach(array_rand($ids, 1));
          }
        });
        factory(App\Employee::class, 5)->create([
          'employeeactive' => '1',
          'month_id' => '02',
          'dob' => '1999-02-17',
        ])->each(function ($employee) {
          $boolean = random_int(0, 1);

          $ids = range(1, 5);

          shuffle($ids);

          if($boolean) {
            $sliced = array_slice($ids, 0, 2);

            $employee->positions()->attach($sliced);
          } else {
            $employee->positions()->attach(array_rand($ids, 1));
          }
        });
        factory(App\Employee::class, 6)->create([
          'employeeactive' => '1',
          'month_id' => '10',
          'dob' => '1998-10-27',
        ])->each(function ($employee) {
          $boolean = random_int(0, 1);

          $ids = range(1, 5);

          shuffle($ids);

          if($boolean) {
            $sliced = array_slice($ids, 0, 2);

            $employee->positions()->attach($sliced);
          } else {
            $employee->positions()->attach(array_rand($ids, 1));
          }
        });
        factory(App\Employee::class, 5)->create([
          'employeeactive' => '1',
          'month_id' => '07',
          'dob' => '1997-07-17',
        ])->each(function ($employee) {
          $boolean = random_int(0, 1);

          $ids = range(1, 5);

          shuffle($ids);

          if($boolean) {
            $sliced = array_slice($ids, 0, 2);

            $employee->positions()->attach($sliced);
          } else {
            $employee->positions()->attach(array_rand($ids, 1));
          }
        });
        factory(App\Employee::class, 5)->create([
          'employeeactive' => '1',
          'month_id' => '04',
          'dob' => '1997-04-17',
        ])->each(function ($employee) {
          $boolean = random_int(0, 1);

          $ids = range(1, 5);

          shuffle($ids);

          if($boolean) {
            $sliced = array_slice($ids, 0, 2);

            $employee->positions()->attach($sliced);
          } else {
            $employee->positions()->attach(array_rand($ids, 1));
          }
        });
        factory(App\Employee::class, 5)->create([
          'employeeactive' => '1',
          'month_id' => '06',
          'dob' => '1996-06-17',
        ])->each(function ($employee) {
          $boolean = random_int(0, 1);

          $ids = range(1, 5);

          shuffle($ids);

          if($boolean) {
            $sliced = array_slice($ids, 0, 2);

            $employee->positions()->attach($sliced);
          } else {
            $employee->positions()->attach(array_rand($ids, 1));
          }
        });
        factory(App\Employee::class, 5)->create([
          'employeeactive' => '1',
          'month_id' => '03',
          'dob' => '1999-03-17',
        ])->each(function ($employee) {
          $boolean = random_int(0, 1);

          $ids = range(1, 5);

          shuffle($ids);

          if($boolean) {
            $sliced = array_slice($ids, 0, 2);

            $employee->positions()->attach($sliced);
          } else {
            $employee->positions()->attach(array_rand($ids, 1));
          }
        });
        factory(App\Note::class)->create([
          'user_id' => '1',
          'notesegment' => 'Announcement',
          'notetitle' => 'Jadwal Ujian',
          'description' => 'Jadwal Ujian untuk Semester 2 Tahun Ajaran 2017/2018',
          'image' => 'webtitle_default.jpg',
          'noteactive' => '1',
        ]);
        // now lets seed some posts for demo
        factory(\App\Lesson::class)->create([
          'user_id' => '1',
          'notetitle' => 'Pengenalan Matematika Dasar',
          'noteactive' => '1',
        ]);
        factory(\App\Lesson::class)->create([
          'user_id' => '1',
          'notetitle' => 'Belajar Sains Melalui Lingkungan Sekitar',
          'noteactive' => '1',
        ]);
        factory(\App\Lesson::class)->create([
          'user_id' => '1',
          'notetitle' => 'Mempraktekkan Doa dalam Keseharian',
          'noteactive' => '1',
        ]);
        factory(\App\Lesson::class, 100)->create();
        factory(\App\Student::class, 30)->create();
        factory(\App\Studentprofile::class, 5)->create([
          'month_id' => '10',
          'dob' => '2005-10-21',
        ]);
        factory(\App\Studentprofile::class, 5)->create([
          'month_id' => '05',
          'dob' => '2010-05-12',
        ]);
        factory(\App\Studentprofile::class, 5)->create([
          'month_id' => '07',
          'dob' => '2009-07-09',
        ]);
        factory(\App\Studentprofile::class, 5)->create([
          'month_id' => '04',
          'dob' => '2008-04-22',
        ]);
        factory(\App\Studentprofile::class, 5)->create([
          'month_id' => '09',
          'dob' => '2008-09-09',
        ]);
        factory(\App\Studentprofile::class, 5)->create([
          'month_id' => '11',
          'dob' => '2008-11-28',
        ]);
        factory(\App\Year::class)->create([
          'user_id' => '1',
          'yearname' => '2017/2018',
          'alias' => '1718',
        ]);
        factory(\App\Year::class)->create([
          'user_id' => '1',
          'yearname' => '2018/2019',
          'alias' => '1819',
        ]);
        factory(\App\Year::class)->create([
          'user_id' => '1',
          'yearname' => '2019/2020',
          'alias' => '1920',
        ]);
        factory(\App\Year::class)->create([
          'user_id' => '1',
          'yearname' => '2020/2021',
          'alias' => '2021',
        ]);
        factory(\App\Year::class)->create([
          'user_id' => '1',
          'yearname' => '2021/2022',
          'alias' => '2122',
        ]);
        factory(\App\Year::class)->create([
          'user_id' => '1',
          'yearname' => '2022/2023',
          'alias' => '2223',
        ]);
        factory(\App\Year::class)->create([
          'user_id' => '1',
          'yearname' => '2023/2024',
          'alias' => '2324',
        ]);
        factory(\App\Year::class)->create([
          'user_id' => '1',
          'yearname' => '2024/2025',
          'alias' => '2425',
        ]);
        factory(\App\Year::class)->create([
          'user_id' => '1',
          'yearname' => '2025/2026',
          'alias' => '2526',
        ]);
        factory(\App\Semester::class)->create([
          'user_id' => '1',
          'semestername' => 'Semester 1',
          'alias' => 'Sem 1',
        ]);
        factory(\App\Semester::class)->create([
          'user_id' => '1',
          'semestername' => 'Semester 2',
          'alias' => 'Sem 2',
        ]);
        $this->command->info('Some Subjects, Lessons, Years, Semester data seeded.');
        $this->command->warn('All done :)');
    }

}
