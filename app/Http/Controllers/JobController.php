<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\Company;
use App\Category;
use App\Http\Requests\JobPostRequest;
use Auth;
use App\Post;
use App\Testimonial;
use Carbon\Carbon;

class JobController extends Controller
{

    public function __construct()
    {
        $this->middleware(['employer', 'verified'], ['except' => array('index', 'show', 'apply', 'allJobs', 'searchJobs')]);
    }
    public function index()
    {
        $jobs = Job::latest()->limit(10)->where('status', 1)->get();
        $categories = Category::with('jobs')->get();
        $posts = Post::where('status', 1)->get();
        $testimonial = Testimonial::orderBy('id', 'DESC')->first();
        //$companies = Company::get()->random();
        $companies = 0;

        return view('welcome', compact('jobs', 'companies', 'categories', 'posts', 'testimonial'));
    }

    public function show($id, Job $job)
    {

        $jobRecommendations = $this->jobRecommendations($job);
        return view('jobs.show', compact('job', 'jobRecommendations'));
    }



    public function jobRecommendations($job)
    {

        $data = [];

        $jobsBasedOnCategories = Job::latest()->where('category_id', $job->category_id)
            ->whereDate('last_date', '>', date('Y-m-d'))
            ->where('id', '!=', $job->id)
            ->where('status', 1)
            ->limit(6)
            ->get();
        array_push($data, $jobsBasedOnCategories);

        $jobBasedOnCompany = Job::latest()
            ->where('company_id', $job->company_id)
            ->whereDate('last_date', '>', date('Y-m-d'))
            ->where('id', '!=', $job->id)
            ->where('status', 1)
            ->limit(6)
            ->get();
        array_push($data, $jobBasedOnCompany);

        $jobBasedOnPosition = Job::where('position', 'LIKE', '%' . $job->position . '%')
            ->where('id', '!=', $job->id)
            ->where('status', 1)
            ->limit(6);
        array_push($data, $jobBasedOnPosition);

        $collection = collect($data);
        $unique = $collection->unique("id");
        $jobRecommendations = $unique->values()->first();

        return $jobRecommendations;
    }






    public function create()
    {
        return view('jobs.create');
    }

    public function myjob()
    {
        $jobs = Job::where('user_id', auth()->user()->id)->get();
        return view('jobs.myjob', compact('jobs'));
    }

    public function edit($id)
    {
        $job = Job::findOrFail($id);
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, $id)
    {
        $job = Job::findOrFail($id);
        $job->update($request->all());
        return redirect()->back()->with('message', 'Job successfullu updated!');
    }

    public function applicant()
    {

        $applicants = Job::where('user_id', auth()->user()->id)
            ->orderBy('experience', 'asc')
            ->orderBy('gender', 'desc')
            ->with('users.profile')
            ->get()->filter(function ($job) {
                // age filter
                $users = $job->users;
                $rang = [$job->age_min, $job->age_max];
                if (empty($job->age_min) || empty($job->age_max)) return false;
                $approvedUsers = [];
                foreach ($users as $user) {
                    if (empty($user->profile->dob)) continue;
                    $dob = Carbon::createFromFormat("d-m-Y", $user->profile->dob);
                    $this_year = Carbon::now()->year;
                    $year = $this_year - $dob->year;
                    if ($year >= $rang[0] && $year <= $rang[1]) {
                        $user->profile->age = $year;
                        $approvedUsers[] = $user;
                    }
                }
                $job->users = $approvedUsers;
                return true;
            })->values()->filter(function ($job) {
                // gender filter
                $users = $job->users;
                $approvedUsers = [];
                foreach ($users as $user) {
                    if (empty($user->profile->gender)) continue;

                    if ($job->gender == 'any' || $job->gender == 'Any' || $user->profile->gender == $job->gender) {
                        $approvedUsers[] = $user;
                    }
                }
                $job->users = $approvedUsers;
                return true;
            })->values()->filter(function ($job) {
                // experience filter
                $users = $job->users;
                $approvedUsers = [];
                foreach ($users as $user) {
                    if (empty($user->profile->experience)) continue;

                    if ($user->profile->experience >= $job->experience) {
                        $approvedUsers[] = $user;
                    }
                }
                $job->users = $approvedUsers;
                return true;
            })->values();
        $show = false;
        return view('jobs.applicants', compact('applicants', 'show'));
    }



    public function showAllApplicants()
    {
        $applicants = Job::where('user_id', auth()->user()->id)
            ->orderBy('experience', 'asc')
            ->orderBy('gender', 'desc')
            ->with('users.profile')
            ->get()
            ->filter(function ($job) {
                // age filter
                $users = $job->users;
                $rang = [$job->age_min, $job->age_max];
                if (empty($job->age_min) || empty($job->age_max)) return false;
                $approvedUsers = [];
                foreach ($users as $user) {
                    if (empty($user->profile->dob)) continue;
                    $dob = Carbon::createFromFormat("d-m-Y", $user->profile->dob);
                    $this_year = Carbon::now()->year;
                    $year = $this_year - $dob->year;
                    $user->profile->age = $year;
                    $approvedUsers[] = $user;
                }
                $job->users = $approvedUsers;
                return true;
            })->values();
        $show = true;
        return view('jobs.applicants', compact('applicants', 'show'));
    }


    public function store(JobPostRequest $request)
    {
        $user_id = auth()->user()->id;
        $company = Company::where('user_id', $user_id)->first();
        $company_id = $company->id;
        Job::create([
            'user_id' => $user_id,
            'company_id' => $company_id,
            'title' => request('title'),
            'slug' => str_slug(request('title')),
            'description' => request('description'),
            'roles' => request('roles'),
            'category_id' => request('category'),
            'position' => request('position'),
            'address' => request('address'),
            'type' => request('type'),
            'status' => request('status'),
            'last_date' => Carbon::createFromFormat("d/m/Y",request('last_date')),
            'number_of_vacancy' => request('number_of_vacancy'),
            'gender' => request('gender'),
            'experience' => request('experience'),
            'salary' => request('salary'),
            'age_min' => request("age_min"),
            'age_max' => request("age_max"),
        ]);


        return redirect()->back()->with('message', 'Job posted successfully');
    }

    public function apply(Request $request, $id)
    {
        $jobId = Job::find($id);
        $jobId->users()->attach(Auth::user()->id);

        return redirect()->back()->with('message', 'Application sent!');
    }

    public function allJobs(Request $request)
    {

        //front search
        $search = $request->get('search');
        $address = $request->get('address');
        if ($search && $address) {
            $jobs = Job::where('address', 'LIKE', '%' . $address . '%')
                ->where(function ($query) use ($search) {
                    $query->orWhere('position', 'LIKE', '%' . $search . '%');
                    $query->orWhere('title', 'LIKE', '%' . $search . '%');
                    $query->orWhere('type', 'LIKE', '%' . $search . '%');
                })
                ->paginate(10);

            return view('jobs.alljobs', compact('jobs'));
        } else if ($address) {
            $jobs = Job::where('address', 'LIKE', '%' . $address . '%')
                ->paginate(10);

            return view('jobs.alljobs', compact('jobs'));
        } else if ($search) {

            $jobs = Job::whereHas("company", function ($query) use ($search) {

                $query->where('cname', 'LIKE', '%' . $search . '%');
            })
                ->OrWhere('position', 'LIKE', '%' . $search . '%')

                ->orWhere('title', 'LIKE', '%' . $search . '%')
                ->orWhere('type', 'LIKE', '%' . $search . '%')
                ->orWhere('company_id', 'LIKE', '%' . $search . '%')

                ->paginate(10);

            return view('jobs.alljobs', compact('jobs'));
        }





        $keyword = $request->get('title');
        $type = $request->get('type');
        $category = $request->get('category_id');
        $address = $request->get('address');
        if ($keyword || $type || $category || $address) {
            $jobs = Job::where('title', 'LIKE', '%' . $keyword . '%')
                ->orWhere('type', $type)
                ->orWhere('category_id', $category)
                ->orWhere('address', $address)
                ->paginate(10);
            return view('jobs.alljobs', compact('jobs'));
        } else {


            $jobs = Job::latest()->paginate(10);
            return view('jobs.alljobs', compact('jobs'));
        }
    }


    public function searchJobs(Request $request)
    {
        $keyword = $request->get('keyword');
        $users = Job::where('title', 'like', '%' . $keyword . '%')
            ->orWhere('position', 'like', '%' . $keyword . '%')
            ->limit(5)->get();
        return response()->json($users);
    }
}
