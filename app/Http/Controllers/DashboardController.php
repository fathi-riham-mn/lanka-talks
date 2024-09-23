<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Blogs;
use App\Models\Users;
use App\Models\Categories;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $users = Users::Where('user_type',1)->get();
        $blogs = Blogs::get();
        $categories = Categories::get();

        $views = 0;
        foreach ($blogs as $blog_view) {
            $views = $views + $blog_view->views;
        }

        $posts = Blogs::with('user')->with('get_ID')->whereDate('publish_at',Carbon::today())->latest()->get();

        $users_count    = BlogCategory::select('blog_id','category_id')->get()->groupBy(function($vender){
            return $vender->category_id;
        });

        $mounth=[];
        $post_counts = [];

        foreach($users_count as $count =>$value){
            $mounth[]    =   $count;
            $post_counts[]    =   count($value);
        }

        return view('dashboard', compact('users','views', 'blogs', 'categories','posts','post_counts','mounth'));
    }

    public function filter(Request $request) {
        $Blogs = Blogs::with('user')->with('get_ID');
    
        if ($request->user) {
            $Blogs->whereIn('user_id', $request->user);
        }
        if ($request->category && !in_array('all', $request->category)) {
            $categoryIds = BlogCategory::whereIn('category_id', $request->category)->pluck('blog_id');
            $Blogs->whereIn('id', $categoryIds);
        }
        
        if ($request->start_date) {
            $Blogs->whereDate('publish_at', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $Blogs->whereDate('publish_at', '<=', $request->end_date);
        }
    
        $posts = $Blogs->get();
    
        $noDataMessage = $posts->isEmpty() ? 'No Data Found' : '';
    
        return view('table', compact('posts', 'noDataMessage'));
    }


    public function publisherTracker(Request $request) {
        $startDate = $request->input('s_start_date');
        $endDate = $request->input('s_end_date');

        $results = DB::table('tl_blogs')
                    ->select('tl_users.id', 'tl_users.name', DB::raw('COUNT(tl_blogs.id) as total_posts'))
                    ->join('tl_users', 'tl_blogs.user_id', '=', 'tl_users.id')
                    ->whereBetween('tl_blogs.created_at', [$startDate, $endDate])
                    ->where ('is_publish', 1)
                    ->groupBy('tl_users.id', 'tl_users.name')
                    ->get();

        return view('table2', ['results' => $results]);
    }
    

}