<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Models\Countries;
use App\Models\SectionsContent;
use App\Models\identity;
use App\Models\about;
use App\Models\ContactDetail;
use App\Models\TermsPrivacy;
use App\Models\ContactUs;
use App\Models\TravelDeal;
class HomeController extends Controller
{
    ///////// home page function /////////
    public function index(){
      
        $testimonials = Testimonial::where('status', 'active')
        ->latest()
        ->limit(5)
        ->get()->toArray();
        $blogs = Blog::where('status', 'active')
        ->latest()
        ->limit(3)
        ->get()
        ->toArray();
        $TravelDeals = TravelDeal::where('status', 'active')->get();
        return view('frontend/home',compact('testimonials','blogs','TravelDeals'));
        
    }

    public function dealIndex($areaName){

        $TravelDeals = TravelDeal::where('status', 'active')->get();
        $deal = TravelDeal::where('area_name', $areaName)->first();
        if(!$deal){
            return redirect('/');
        }
        return view('frontend/home-deal',compact('TravelDeals','deal'));
        
    }
    ///////// home page function end /////////

    ///////// about page function /////////
    public function about(){
        $about=about::first();
        return view('frontend/pages/about',compact('about'));
        
    }
    ///////// about page function end /////////
    
    ///////// home page function end /////////
    public function home7(){
        return view('frontend/home7');

    }
    ///////// contact page function /////////
    public function contact(){
        
        return view('frontend/pages/contact');
            
    }
    ///////// contact page function end /////////

    ///////// blog page function /////////

    
    public function blogList(Request $request, $category = null)
    {
        $siteIdentity = Identity::all()->toArray();
        $contact = ContactDetail::all()->toArray();
        
        // Get all distinct categories from the blogs table
        $categories = Blog::where('status', 'active')
            ->distinct('category')
            ->pluck('category')
            ->toArray();
        
        // If a category is provided, get blogs with the specified category
        if ($category) {
            $blogs = Blog::where('status', 'active')
                ->where('category', $category)
                ->latest()
                ->paginate(2); // You can adjust the number of blogs per page here
        } else {
            // If no category is provided, get all active blogs
            $blogs = Blog::where('status', 'active')
                ->latest()
                ->paginate(2); // You can adjust the number of blogs per page here
        }
        
        // Get the count of blogs for each category
        $categoryCounts = Blog::where('status', 'active')
            ->groupBy('category')
            ->selectRaw('category, count(*) as count')
            ->pluck('count', 'category')
            ->toArray();
        
        // Recent blogs
        $recentBlogs = Blog::where('status', 'active')
            ->latest()
            ->limit(4)
            ->get()
            ->toArray();
            $paginationLinks = $blogs->links();
        return view('frontend/blog-list', compact('siteIdentity', 'contact', 'blogs', 'categories', 'categoryCounts', 'recentBlogs','paginationLinks'));
    }
    
    
    
    public function blogSingle($slug){
        $blog=Blog::where('slug',$slug)->get()->first()->toArray();
        $id=$blog['id'];
        // Find the next blog
        $nextBlog = Blog::where('id', '>', $id)->orderBy('id', 'asc')->first();
        // Find the previous blog
        $prevBlog = Blog::where('id', '<', $id)->orderBy('id', 'desc')->first();
        $siteIdentity=identity::all()->toArray();
        $contact=ContactDetail::all()->toArray();
        return view('frontend/blog-single',compact('siteIdentity','contact','blog','nextBlog','prevBlog'));

    }
    ///////// blog page function end /////////
    ///////// terms page function /////////
    public function terms(){
       
        $terms=TermsPrivacy::all();
        return view('frontend/pages/terms',compact('terms'));
            
    }
    ///////// terms page function end /////////

    public function contactSave(Request $request){
        $request->validate([
            'name'=>'required|string|max:191',
            'email'=>'required|email|',
            'message'=>'required|string|',
        ]);
        $contact=ContactUs::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'message'=>$request->input('message'),
            'status'=>'active',
        ]);
        $contact->save();
        return redirect()->back()->with('success','Thanks for reaching us. We will contact you soon regarding your query');
    }

    public function faq(){
        return view('frontend/pages/faq');
    }
}
