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
          'employee_id' => 1,
          'created_by' => 'System',
        ])->assignRole('Admin');

        factory(App\User::class)->create([
          'name' => 'superadmin2',
          'email' => 'superadmin2@gmail.com',
          'employee_id' => 2,
          'password' => 'secret',
          'created_by' => 'System',
        ])->assignRole('Admin');

        factory(App\User::class)->create([
          'name' => 'user',
          'password' => 'secret',
          'employee_id' => 3,
          'created_by' => 'System',
        ])->assignRole('User');

        $this->command->info('Here is your admin details to login:');
        $this->command->warn('ariefwidiatmoko@gmail.com');
        $this->command->warn('Password is "secret"');

        $this->command->info('Roles ' . $input_roles . ' added successfully');

        factory(App\Month::class)->create([
          'noId' => '01',
          'monthname' => 'January',
          'alias' => 'Jan',
          'created_by' => 'System',
        ]);

        factory(App\Month::class)->create([
          'noId' => '02',
          'monthname' => 'February',
          'alias' => 'Feb',
          'created_by' => 'System',
        ]);

        factory(App\Month::class)->create([
          'noId' => '03',
          'monthname' => 'March',
          'alias' => 'Mar',
          'created_by' => 'System',
        ]);

        factory(App\Month::class)->create([
          'noId' => '04',
          'monthname' => 'April',
          'alias' => 'Apr',
          'created_by' => 'System',
        ]);

        factory(App\Month::class)->create([
          'noId' => '05',
          'monthname' => 'May',
          'alias' => 'May',
          'created_by' => 'System',
        ]);

        factory(App\Month::class)->create([
          'noId' => '06',
          'monthname' => 'June',
          'alias' => 'Jun',
          'created_by' => 'System',
        ]);

        factory(App\Month::class)->create([
          'noId' => '07',
          'monthname' => 'July',
          'alias' => 'Jul',
          'created_by' => 'System',
        ]);

        factory(App\Month::class)->create([
          'noId' => '08',
          'monthname' => 'August',
          'alias' => 'Aug',
          'created_by' => 'System',
        ]);

        factory(App\Month::class)->create([
          'noId' => '09',
          'monthname' => 'September',
          'alias' => 'Sep',
          'created_by' => 'System',
        ]);

        factory(App\Month::class)->create([
          'noId' => '10',
          'monthname' => 'October',
          'alias' => 'Oct',
          'created_by' => 'System',
        ]);

        factory(App\Month::class)->create([
          'noId' => '11',
          'monthname' => 'November',
          'alias' => 'Nov',
          'created_by' => 'System',
        ]);

        factory(App\Month::class)->create([
          'noId' => '12',
          'monthname' => 'December',
          'alias' => 'Dec',
          'created_by' => 'System',
        ]);

        factory(App\Profile::class)->create([
          'user_id' => '1',
          'profilename' => 'Arief Widiatmoko',
          'dob' => '1984-07-10',
          'phone' => '08974743477',
          'education' => 'Sarjana Pertanian IPB',
          'address' => 'Bogor, Indonesia',
          'about' => 'Passion in Coding, May Coding in You',
          'avatar' => 'owner.jpg',
          'created_by' => 'System',
        ]);

        factory(App\Profile::class)->create([
          'user_id' => '2',
          'profilename' => 'Superadmin2',
          'dob' => '1990-01-01',
          'phone' => '08120000000',
          'education' => 'S1',
          'address' => 'Indonesia',
          'about' => 'Always Forever Selalu',
          'avatar' => 'owner.jpg',
          'created_by' => 'System',
        ]);
        factory(App\Profile::class)->create([
          'user_id' => '3',
          'created_by' => 'System',
        ]);
        factory(App\Grade::class)->create([
          'user_id' => '1',
          'gradename' => '7',
          'alias' => '1',
          'created_by' => 'System',
        ]);
        factory(App\Grade::class)->create([
          'user_id' => '1',
          'gradename' => '8',
          'alias' => '2',
          'created_by' => 'System',
        ]);
        factory(App\Grade::class)->create([
          'user_id' => '1',
          'gradename' => '9',
          'alias' => '3',
          'created_by' => 'System',
        ]);
        factory(App\Classroom::class)->create([
          'user_id' => '1',
          'classroomname' => '7A',
          'alias' => '1A',
          'classroomactive' => '1',
          'grade_id' => '1',
          'created_by' => 'System',
        ]);
        factory(App\Classroom::class)->create([
          'user_id' => '1',
          'classroomname' => '7B',
          'alias' => '1B',
          'classroomactive' => '1',
          'grade_id' => '1',
          'created_by' => 'System',
        ]);
        factory(App\Classroom::class)->create([
          'user_id' => '1',
          'classroomname' => '7C',
          'alias' => '1C',
          'classroomactive' => '1',
          'grade_id' => '1',
          'created_by' => 'System',
        ]);
        factory(App\Classroom::class)->create([
          'user_id' => '1',
          'classroomname' => '8A',
          'alias' => '2A',
          'classroomactive' => '1',
          'grade_id' => '2',
          'created_by' => 'System',
        ]);
        factory(App\Classroom::class)->create([
          'user_id' => '1',
          'classroomname' => '8B',
          'alias' => '2B',
          'classroomactive' => '1',
          'grade_id' => '2',
          'created_by' => 'System',
        ]);
        factory(App\Classroom::class)->create([
          'user_id' => '1',
          'classroomname' => '8C',
          'alias' => '2C',
          'classroomactive' => '1',
          'grade_id' => '2',
          'created_by' => 'System',
        ]);
        factory(App\Classroom::class)->create([
          'user_id' => '1',
          'classroomname' => '9A',
          'alias' => '3A',
          'classroomactive' => '1',
          'grade_id' => '3',
          'created_by' => 'System',
        ]);
        factory(App\Classroom::class)->create([
          'user_id' => '1',
          'classroomname' => '9B',
          'alias' => '3B',
          'classroomactive' => '1',
          'grade_id' => '3',
          'created_by' => 'System',
        ]);
        factory(App\Classroom::class)->create([
          'user_id' => '1',
          'classroomname' => '9C',
          'alias' => '3C',
          'classroomactive' => '1',
          'grade_id' => '3',
          'created_by' => 'System',
        ]);
        factory(App\Classyear::class)->create([
          'classroom_id' => '1',
          'year_id' => '1',
          'semester_id' => '1',
          'created_by' => 'System',
        ]);
        factory(App\Classyear::class)->create([
          'classroom_id' => '1',
          'year_id' => '1',
          'semester_id' => '2',
          'created_by' => 'System',
        ]);
        factory(App\Classyear::class)->create([
          'classroom_id' => '2',
          'year_id' => '1',
          'semester_id' => '1',
          'created_by' => 'System',
        ]);
        factory(App\Classyear::class)->create([
          'classroom_id' => '2',
          'year_id' => '1',
          'semester_id' => '2',
          'created_by' => 'System',
        ]);
        factory(App\Classyear::class)->create([
          'classroom_id' => '3',
          'year_id' => '1',
          'semester_id' => '1',
          'created_by' => 'System',
        ]);
        factory(App\Classyear::class)->create([
          'classroom_id' => '3',
          'year_id' => '1',
          'semester_id' => '2',
          'created_by' => 'System',
        ]);
        factory(App\Classyear::class)->create([
          'classroom_id' => '4',
          'year_id' => '1',
          'semester_id' => '1',
          'created_by' => 'System',
        ]);
        factory(App\Classyear::class)->create([
          'classroom_id' => '4',
          'year_id' => '1',
          'semester_id' => '2',
          'created_by' => 'System',
        ]);
        factory(App\Classyear::class)->create([
          'classroom_id' => '5',
          'year_id' => '1',
          'semester_id' => '1',
          'created_by' => 'System',
        ]);
        factory(App\Classyear::class)->create([
          'classroom_id' => '5',
          'year_id' => '1',
          'semester_id' => '2',
          'created_by' => 'System',
        ]);
        factory(App\Classyear::class)->create([
          'classroom_id' => '6',
          'year_id' => '1',
          'semester_id' => '1',
          'created_by' => 'System',
        ]);
        factory(App\Classyear::class)->create([
          'classroom_id' => '6',
          'year_id' => '1',
          'semester_id' => '2',
          'created_by' => 'System',
        ]);
        factory(App\Subject::class)->create([
          'user_id' => '1',
          'alias' => 'AGM',
          'subjectname' => 'Agama',
          'subjectactive' => '1',
          'created_by' => 'System',
        ]);
        factory(App\Subject::class)->create([
          'user_id' => '1',
          'alias' => 'BHS',
          'subjectname' => 'Bahasa Indonesia',
          'subjectactive' => '1',
          'created_by' => 'System',
        ]);
        factory(App\Subject::class)->create([
          'user_id' => '1',
          'alias' => 'PKn',
          'subjectname' => 'Pendidikan Kewarganegaraan',
          'subjectactive' => '1',
          'created_by' => 'System',
        ]);
        factory(App\Subject::class)->create([
          'user_id' => '1',
          'alias' => 'MAT',
          'subjectname' => 'Matematika',
          'subjectactive' => '1',
          'created_by' => 'System',
        ]);
        factory(App\Subject::class)->create([
          'user_id' => '1',
          'alias' => 'PJK',
          'subjectname' => 'Pendidikan Jasmani Kesehatan',
          'subjectactive' => '1',
          'created_by' => 'System',
        ]);
        factory(App\Subject::class)->create([
          'user_id' => '1',
          'alias' => 'SAINS',
          'subjectname' => 'Ilmu Pengetahuan Alam',
          'subjectactive' => '1',
          'created_by' => 'System',
        ]);
        factory(App\Subject::class)->create([
          'user_id' => '1',
          'alias' => 'SOSIAL',
          'subjectname' => 'Ilmu Pengetahuan Sosial',
          'subjectactive' => '1',
          'created_by' => 'System',
        ]);
        factory(App\Subject::class)->create([
          'user_id' => '1',
          'alias' => 'SENI',
          'subjectname' => 'Seni dan Budaya',
          'subjectactive' => '1',
          'created_by' => 'System',
        ]);
        factory(App\Subject::class)->create([
          'user_id' => '1',
          'alias' => 'JAWA',
          'subjectname' => 'Bahasa Jawa',
          'subjectactive' => '1',
          'created_by' => 'System',
        ]);
        factory(App\Subject::class)->create([
          'user_id' => '1',
          'alias' => 'ITK',
          'subjectname' => 'Ilmu Teknologi dan Komputer',
          'subjectactive' => '1',
          'created_by' => 'System',
        ]);
        factory(App\Position::class)->create([
          'user_id' => '1',
          'positionname' => 'Administration',
          'positionactive' => '1',
          'created_by' => 'System',
        ]);
        factory(App\Position::class)->create([
          'user_id' => '1',
          'positionname' => 'Home Teacher',
          'positionactive' => '1',
          'created_by' => 'System',
        ]);
        factory(App\Position::class)->create([
          'user_id' => '1',
          'positionname' => 'Principal',
          'positionactive' => '1',
          'created_by' => 'System',
        ]);
        factory(App\Position::class)->create([
          'user_id' => '1',
          'positionname' => 'Teacher',
          'positionactive' => '1',
          'created_by' => 'System',
        ]);
        factory(App\Employee::class)->create([
          'user_id' => '1',
          'month_id' => '02',
          'dob' => '2000-02-17',
          'employeeactive' => '1',
          'created_by' => 'System',
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
          'created_by' => 'System',
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
          'created_by' => 'System',
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
          'created_by' => 'System',
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
          'created_by' => 'System',
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
          'created_by' => 'System',
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
          'created_by' => 'System',
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
          'created_by' => 'System',
        ]);
        // now lets seed some lessons for demo
        factory(\App\Lesson::class)->create([
          'user_id' => '1',
          'lessontitle' => 'Pengenalan Matematika Dasar',
          'lessonactive' => '1',
          'created_by' => 'System',
        ]);
        factory(\App\Lesson::class)->create([
          'user_id' => '1',
          'lessontitle' => 'Belajar Sains Melalui Lingkungan Sekitar',
          'lessonactive' => '1',
          'created_by' => 'System',
        ]);
        factory(\App\Lesson::class)->create([
          'user_id' => '1',
          'lessontitle' => 'Mempraktekkan Doa dalam Keseharian',
          'lessonactive' => '1',
          'created_by' => 'System',
        ]);
        factory(\App\Lesson::class, 100)->create();
        factory(\App\Year::class)->create([
          'user_id' => '1',
          'yearname' => '2018/2019',
          'alias' => '1819',
          'created_by' => 'System',
        ]);
        factory(\App\Year::class)->create([
          'user_id' => '1',
          'yearname' => '2019/2020',
          'alias' => '1920',
          'created_by' => 'System',
        ]);
        factory(\App\Year::class)->create([
          'user_id' => '1',
          'yearname' => '2020/2021',
          'alias' => '2021',
          'created_by' => 'System',
        ]);
        factory(\App\Year::class)->create([
          'user_id' => '1',
          'yearname' => '2021/2022',
          'alias' => '2122',
          'created_by' => 'System',
        ]);
        factory(\App\Year::class)->create([
          'user_id' => '1',
          'yearname' => '2022/2023',
          'alias' => '2223',
          'created_by' => 'System',
        ]);
        factory(\App\Year::class)->create([
          'user_id' => '1',
          'yearname' => '2023/2024',
          'alias' => '2324',
          'created_by' => 'System',
        ]);
        factory(\App\Year::class)->create([
          'user_id' => '1',
          'yearname' => '2024/2025',
          'alias' => '2425',
          'created_by' => 'System',
        ]);
        factory(\App\Year::class)->create([
          'user_id' => '1',
          'yearname' => '2025/2026',
          'alias' => '2526',
          'created_by' => 'System',
        ]);
        factory(\App\Semester::class)->create([
          'id' => '1',
          'user_id' => '1',
          'semestername' => 'Semester 1',
          'alias' => '1',
          'created_by' => 'System',
        ]);
        factory(\App\Semester::class)->create([
          'id' => '2',
          'user_id' => '1',
          'semestername' => 'Semester 2',
          'alias' => '2',
          'created_by' => 'System',
        ]);
        factory(\App\Yearactive::class)->create([
          'id' => '1',
          'year_id' => '1',
          'semester_id' => '1',
          'created_by' => function() { return \App\User::first()->name; },
          'updated_by' => function() { return \App\User::first()->name; },
          'user_id' => function() { return \App\User::first()->id; },
          'created_by' => 'System',
        ]);
        factory(\App\School::class)->create([
          'id' => '1',
          'schoolname' => 'Sekolah Alfa',
          'principal' => function() { return \App\Employee::inRandomOrder()->first()->employeename; },
          'viceprincipal' => function() { return \App\Employee::inRandomOrder()->first()->employeename; },
          'address' => 'Jalan Raya Kemenangan Merdeka Barat Jakarta',
          'phone' => '021 65746321',
          'email' => 'info@sekolahalfa.co.id',
          'created_by' => 'System',
        ]);
        factory(\App\Type::class)->create([
          'id' => '1',
          'typename' => '1',
          'typedescription' => 'Spiritual',
          'created_by' => 'System',
        ]);
        factory(\App\Type::class)->create([
          'id' => '2',
          'typename' => '2',
          'typedescription' => 'Sikap',
          'created_by' => 'System',
        ]);
        factory(\App\Type::class)->create([
          'id' => '3',
          'typename' => '3',
          'typedescription' => 'Pengetahuan',
          'created_by' => 'System',
        ]);
        factory(\App\Type::class)->create([
          'id' => '4',
          'typename' => '4',
          'typedescription' => 'Ketrampilan',
          'created_by' => 'System',
        ]);
        factory(\App\Group::class)->create([
          'id' => '1',
          'groupname' => 'NH',
          'groupdescription' => 'Nilai Harian',
          'created_by' => 'System',
        ]);
        factory(\App\Group::class)->create([
          'id' => '2',
          'groupname' => 'NA',
          'groupdescription' => 'Nilai Akhir',
          'created_by' => 'System',
        ]);
        factory(\App\Detail::class)->create([
          'id' => '1',
          'detailname' => 'UH',
          'detaildescription' => 'Ulangan Harian',
          'created_by' => 'System',
        ]);
        factory(\App\Detail::class)->create([
          'id' => '2',
          'detailname' => 'QZ',
          'detaildescription' => 'Quiz',
          'created_by' => 'System',
        ]);
        factory(\App\Detail::class)->create([
          'id' => '3',
          'detailname' => 'TG',
          'detaildescription' => 'Tugas',
          'created_by' => 'System',
        ]);
        factory(\App\Detail::class)->create([
          'id' => '4',
          'detailname' => 'PK',
          'detaildescription' => 'Praktek',
          'created_by' => 'System',
        ]);
        factory(\App\Detail::class)->create([
          'id' => '5',
          'detailname' => 'UT',
          'detaildescription' => 'Ujian Akhir',
          'created_by' => 'System',
        ]);
        factory(\App\Detail::class)->create([
          'id' => '6',
          'detailname' => 'UP',
          'detaildescription' => 'Ujian Praktek',
          'created_by' => 'System',
        ]);
        factory(\App\Competencyalpha::class)->create([
          'id' => '1',
          'alphabet' => 'A',
          'score' => array(0 => 90, 1 => 100),
          'description' => 'sangat mampu',
          'created_by' => 'System',
        ]);
        factory(\App\Competencyalpha::class)->create([
          'id' => '2',
          'alphabet' => 'B',
          'score' => array(0 => 80, 1 => 90),
          'description' => 'mampu',
          'created_by' => 'System',
        ]);
        factory(\App\Competencyalpha::class)->create([
          'id' => '3',
          'alphabet' => 'C',
          'score' => array(0 => 70, 1 => 80),
          'description' => 'cukup mampu',
          'created_by' => 'System',
        ]);
        factory(\App\Competencyalpha::class)->create([
          'id' => '4',
          'alphabet' => 'D',
          'score' => array(0 => 0, 1 => 70),
          'description' => 'kurang mampu',
          'created_by' => 'System',
        ]);
        $this->command->info('Some Dummy Data are successfully seeded.');
        $this->command->warn('All done :)');
    }

}
