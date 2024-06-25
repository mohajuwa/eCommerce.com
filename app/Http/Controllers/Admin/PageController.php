<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUsModel;
use App\Models\HomeSettingModel;
use App\Models\NotificationModel;
use App\Models\PageModel;
use App\Models\SystemSettingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{

    public function contactUs()
    {
        $data['header_title'] = 'Contact Us';
        $data['getRecord'] = ContactUsModel::getRecord();

        return view('admin.contactus.list', $data);
    }
    public function notification()
    {
        $data['header_title'] = 'Notifications';
        $data['getRecord'] = NotificationModel::getRecord();

        return view('admin.notification.list', $data);
    }
    public function contactUsDelete($id)
    {

        ContactUsModel::where('id', '=', $id)->delete();
        return redirect()->back()->with('success', 'Record successfully deleted');
    }
    public function list()
    {
        $data['header_title'] = 'Page';
        $data['getRecord'] = PageModel::getRecord();

        return view('admin.page.list', $data);
    }

    public function edit($id)
    {
        $data['getRecord'] = PageModel::getSingle($id);
        $data['header_title'] = 'Edit Page';
        return view('admin.page.edit', $data);
    }
    public function update(Request $request, $id)
    {
        $page = PageModel::getSingle($id);

        $page->name = trim($request->name);
        $page->slug = trim($request->slug);
        $page->title = trim($request->title);
        $page->description = trim($request->description);
        $page->meta_title = trim($request->meta_title);
        $page->meta_description = trim($request->meta_description);
        $page->meta_keywords = trim($request->meta_keywords);

        $page->save();
        if (!empty($request->file('image'))) {

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $randomStr = $page->id . Str::random(20);
            $fileName = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/page/', $fileName);
            $page->image_name = trim($fileName);

            $page->save();
        }

        return redirect()->back()->with('success', "Page Updated Successfully");
    }

    public function systemSettings()
    {
        $data['header_title'] = 'System Settings';
        $data['getRecord'] = SystemSettingModel::getSingle();

        return view('admin.setting.system_settings', $data);
    }
    public function updateSystemSettings(Request $request)
    {
        $systemSetting = SystemSettingModel::getSingle();
        $systemSetting->website_name = trim($request->website_name);
        // $systemSetting->logo = trim($request->logo);
        // $systemSetting->fevicon = trim($request->fevicon);
        // $systemSetting->footer_payment_icon = trim($request->footer_payment_icon);
        $systemSetting->address = trim($request->address);
        $systemSetting->footer_description = trim($request->footer_description);
        $systemSetting->phone = trim($request->phone);
        $systemSetting->phone_two = trim($request->phone_two);
        $systemSetting->submit_email = trim($request->submit_email);
        $systemSetting->email = trim($request->email);
        $systemSetting->email_two = trim($request->email_two);
        $systemSetting->working_hours = trim($request->working_hours);
        $systemSetting->facebook_link = trim($request->facebook_link);
        $systemSetting->twitter_link = trim($request->twitter_link);
        $systemSetting->instagram_link = trim($request->instagram_link);
        $systemSetting->youtube_link = trim($request->youtube_link);
        $systemSetting->paintrest_link = trim($request->paintrest_link);

        $systemSetting->save();

        if (!empty($request->file('logo'))) {

            $file = $request->file('logo');
            $ext = $file->getClientOriginalExtension();
            $randomStr = $systemSetting->id . Str::random(20);
            $fileName = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/setting/', $fileName);
            $systemSetting->logo = trim($fileName);

            $systemSetting->save();
        }
        if (!empty($request->file('fevicon'))) {

            $file = $request->file('fevicon');
            $ext = $file->getClientOriginalExtension();
            $randomStr = $systemSetting->id . Str::random(20);
            $fileName = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/setting/', $fileName);
            $systemSetting->fevicon = trim($fileName);

            $systemSetting->save();
        }
        if (!empty($request->file('footer_payment_icon'))) {

            $file = $request->file('footer_payment_icon');
            $ext = $file->getClientOriginalExtension();
            $randomStr = $systemSetting->id . Str::random(20);
            $fileName = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/setting/', $fileName);
            $systemSetting->footer_payment_icon = trim($fileName);

            $systemSetting->save();
        }

        return redirect()->back()->with('success', "Page Updated Successfully");
    }

    public function homeSettings()
    {
        $data['header_title'] = 'System Settings';
        $data['getRecord'] = HomeSettingModel::getSingle();

        return view('admin.setting.home_settings', $data);
    }
    public function updateHomeSettings(Request $request)
    {

        $homeSetting = HomeSettingModel::getSingle();

        $homeSetting->trendy_product_title = trim($request->trendy_product_title);
        $homeSetting->shop_category_title = trim($request->shop_category_title);
        $homeSetting->recent_arrival_title = trim($request->recent_arrival_title);
        $homeSetting->blog_title = trim($request->blog_title);
        $homeSetting->payment_delivery_title = trim($request->payment_delivery_title);
        $homeSetting->payment_delivery_description = trim($request->payment_delivery_description);
        $homeSetting->refund_title = trim($request->refund_title);
        $homeSetting->refund_description = trim($request->refund_description);
        $homeSetting->support_title = trim($request->support_title);
        $homeSetting->support_description = trim($request->support_description);
        $homeSetting->signup_title = trim($request->signup_title);
        $homeSetting->signup_description = trim($request->signup_description);
        $homeSetting->save();

        if (!empty($request->file('payment_delivery_image'))) {

            $file = $request->file('payment_delivery_image');
            $ext = $file->getClientOriginalExtension();
            $randomStr = $homeSetting->id . Str::random(20);
            $fileName = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/setting/', $fileName);
            $homeSetting->payment_delivery_image = trim($fileName);

            $homeSetting->save();
        }

        if (!empty($request->file('refund_image'))) {

            $file = $request->file('refund_image');
            $ext = $file->getClientOriginalExtension();
            $randomStr = $homeSetting->id . Str::random(20);
            $fileName = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/setting/', $fileName);
            $homeSetting->refund_image = trim($fileName);

            $homeSetting->save();
        }
        if (!empty($request->file('support_image'))) {

            $file = $request->file('support_image');
            $ext = $file->getClientOriginalExtension();
            $randomStr = $homeSetting->id . Str::random(20);
            $fileName = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/setting/', $fileName);
            $homeSetting->support_image = trim($fileName);

            $homeSetting->save();
        }
        if (!empty($request->file('signup_image'))) {

            $file = $request->file('signup_image');
            $ext = $file->getClientOriginalExtension();
            $randomStr = $homeSetting->id . Str::random(20);
            $fileName = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/setting/', $fileName);
            $homeSetting->signup_image = trim($fileName);

            $homeSetting->save();
        }

        return redirect()->back()->with('success', "Page Updated Successfully");
    }
}
