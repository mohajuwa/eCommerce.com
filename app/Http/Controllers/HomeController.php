<?php

namespace App\Http\Controllers;

use App\Mail\ContactUsMail;
use App\Models\BlogCategoryModel;
use App\Models\BlogCommentModel;
use App\Models\BlogModel;
use App\Models\Category;
use App\Models\ContactUsModel;
use App\Models\HomeSettingModel;
use App\Models\PageModel;
use App\Models\PartnerModel;
use App\Models\Product;
use App\Models\SliderModel;
use App\Models\SystemSettingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function home()
    {
        $getPage = PageModel::getSlug('home');
        $data['meta_title'] = $getPage->meta_title;
        $data['getHomeSetting'] = HomeSettingModel::getSingle();


        $data['meta_keywords'] = $getPage->meta_keyword;
        $data['getBlog'] = BlogModel::getRecordActive();
        $data['getSlider'] = SliderModel::getRecordActive();
        $data['getPartner'] = PartnerModel::getRecordActive();
        $data['getCategory'] = Category::getRecordActiveHome();
        $data['getProduct'] = Product::getRecentArrival();
        $data['getProductTrendy'] = Product::getProductTrendy();



        $data['meta_description'] = $getPage->meta_description;
        return view('home', $data);
    }
    public function RecentArrivalCategoryProduct(Request $request)

    {
        $getPage = PageModel::getSlug('home');
        $meta_title = $getPage->meta_title;
        $data['meta_keywords'] = $getPage->meta_keyword;
        $getProduct = Product::getRecentArrival();
        $getCategory = Category::getSingle($request->category_id);

        return response()->json([
            "status" => true,
            "success" => view('product._list_recent_arrival', [
                "meta_title" => $meta_title,
                "getProduct" => $getProduct,
                "getCategory" => $getCategory,
            ])->render(),
        ], 200);
    }
    public function contact()

    {
        $firstNumber = mt_rand(0, 9);
        $secondNumber = mt_rand(0, 9);

        $data['first_number'] = $firstNumber;
        $data['second_number'] = $secondNumber;
        Session::put('total_sum', $firstNumber + $secondNumber);


        $getPage = PageModel::getSlug('contact');
        $data['getSystemSettingApp'] = SystemSettingModel::getSingle();

        $data['meta_title'] = $getPage->meta_title;
        $data['meta_keywords'] = $getPage->meta_keyword;
        $data['meta_description'] = $getPage->meta_description;



        $data['getPage'] = $getPage;

        return view('page.contact', $data, $data);
    }
    public function submitContact(Request $request)
    {

        if (!empty($request->verfication) &&  !empty(Session::get('total_sum'))) {
            if (Session::get('total_sum') ==  trim($request->verfication)) {
                $save = new ContactUsModel;
                if (!empty(Auth::check())) {
                    $save->user_id = Auth::user()->id;
                }
                $save->user_id = trim($request->user_id);
                $save->name = trim($request->name);
                $save->email = trim($request->email);
                $save->phone = trim($request->phone);
                $save->subject = trim($request->subject);
                $save->message = trim($request->message);

                $save->save();
                $getSystemSetting = SystemSettingModel::getSingle();

                Mail::to($getSystemSetting->submit_email)->send(new ContactUsMail($save));

                return redirect()->back()->with('success', 'Your information has been sent.');
            } else {
                return redirect()->back()->with('error', 'Your Verification sum is wrong.');
            }
        } else {
            return redirect()->back()->with('error', 'Your Verification sum is wrong.');
        }
    }
    public function about()
    {
        $getPage = PageModel::getSlug('about');
        $data['meta_title'] = $getPage->meta_title;
        $data['meta_keywords'] = $getPage->meta_keyword;
        $data['meta_description'] = $getPage->meta_description;

        $data['getPage'] = $getPage;

        return view('page.about', $data, $data);
    }
    public function faq()
    {
        $getPage = PageModel::getSlug('faq');
        $data['meta_title'] = $getPage->meta_title;
        $data['meta_keywords'] = $getPage->meta_keyword;
        $data['meta_description'] = $getPage->meta_description;

        $data['getPage'] = $getPage;

        return view('page.faq', $data);
    }
    public function payment_methods()
    {
        $getPage = PageModel::getSlug('payment-methods');
        $data['meta_title'] = $getPage->meta_title;
        $data['meta_keywords'] = $getPage->meta_keyword;
        $data['meta_description'] = $getPage->meta_description;

        $data['getPage'] = $getPage;

        return view('page.payment_methods', $data);
    }
    public function money_back_guarantee()
    {
        $getPage = PageModel::getSlug('money-back-guarantee');
        $data['meta_title'] = $getPage->meta_title;
        $data['meta_keywords'] = $getPage->meta_keyword;
        $data['meta_description'] = $getPage->meta_description;

        $data['getPage'] = $getPage;

        return view('page.money_back_guarantee', $data);
    }
    public function return()
    {
        $getPage = PageModel::getSlug('return');
        $data['meta_title'] = $getPage->meta_title;
        $data['meta_keywords'] = $getPage->meta_keyword;
        $data['meta_description'] = $getPage->meta_description;

        $data['getPage'] = $getPage;

        return view('page.return', $data);
    }
    public function shipping()
    {
        $getPage = PageModel::getSlug('shipping');
        $data['meta_title'] = $getPage->meta_title;
        $data['meta_keywords'] = $getPage->meta_keyword;
        $data['meta_description'] = $getPage->meta_description;

        $data['getPage'] = $getPage;

        return view('page.shipping', $data);
    }
    public function terms_conditions()
    {
        $getPage = PageModel::getSlug('terms-conditions');
        $data['meta_title'] = $getPage->meta_title;
        $data['meta_keywords'] = $getPage->meta_keyword;
        $data['meta_description'] = $getPage->meta_description;

        $data['getPage'] = $getPage;

        return view('page.terms_conditions', $data);
    }
    public function privacy_policy()
    {
        $getPage = PageModel::getSlug('privacy-policy');
        $data['meta_title'] = $getPage->meta_title;
        $data['meta_keywords'] = $getPage->meta_keyword;
        $data['meta_description'] = $getPage->meta_description;

        $data['getPage'] = $getPage;

        return view('page.privacy_policy', $data);
    }

    public function blog()
    {
        $getPage = PageModel::getSlug('blog');
        $data['meta_title'] = $getPage->meta_title;
        $data['meta_keywords'] = $getPage->meta_keyword;
        $data['meta_description'] = $getPage->meta_description;

        $data['getPage'] = $getPage;
        $data['getBlog'] = BlogModel::getBlog();
        $data['getBlogCategory'] = BlogCategoryModel::getRecordActive();
        $data['getPopular'] = BlogModel::getPopular();


        return view('blog.list', $data);
    }
    public function blogDetail($slug)
    {
        $getBlog = BlogModel::getSingleSlug($slug);
        if (!empty($getBlog)) {
            $total_view = $getBlog->total_view;
            $getBlog->total_view = $total_view + 1;
            $getBlog->save();


            $data['getBlog'] = $getBlog;

            $data['meta_title'] = $getBlog->meta_title;
            $data['meta_keywords'] = $getBlog->meta_keyword;
            $data['meta_description'] = $getBlog->meta_description;
            $data['getBlogCategory'] = BlogCategoryModel::getRecordActive();

            $data['getPopular'] = BlogModel::getPopular();
            $data['getRelatedPost'] = BlogModel::getRelatedPost($getBlog->blog_category_id, $getBlog->id);

            return view('blog.detail', $data);
        } else {
            abort(404);
        }
    }
    public function blogCategory($slug)
    {
        $getCategory = BlogCategoryModel::getSingleSlug($slug);
        if (!empty($getCategory)) {



            $data['getCategory'] = $getCategory;

            $data['meta_title'] = $getCategory->meta_title;
            $data['meta_keywords'] = $getCategory->meta_keyword;
            $data['meta_description'] = $getCategory->meta_description;
            $data['getBlogCategory'] = BlogCategoryModel::getRecordActive();

            $data['getPopular'] = BlogModel::getPopular();
            $data['getBlog'] = BlogModel::getBlog($getCategory->id);


            return view('blog.category', $data);
        } else {
            abort(404);
        }
    }


    public function submitBlogComment(Request $request)
    {
        $comment = new BlogCommentModel;
        $comment->user_id = Auth::user()->id;
        $comment->blog_id = $request->blog_id;
        $comment->comment = $request->comment;

        $comment->save();

        return redirect()->back()->with('success', 'Comment Added Successfully');
    }
}
