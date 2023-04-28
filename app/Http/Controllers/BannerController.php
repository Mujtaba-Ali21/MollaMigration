<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Banner;
use App\Models\BannerText;

class BannerController extends Controller
{
    // Create
    public function create(Request $req)
    {
        $validated = $req->validate([
            'bannerText' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Get the file object from the image input field
        $image = $req->file('image');

        $banner = new Banner;
        $banner->image = $image->getClientOriginalName();
        $banner->save();

        $bannerText = new BannerText;
        $bannerText->banner_id = $banner->id;
        $bannerText->text = $validated['bannerText'];
        $bannerText->save();

        // Move the uploaded file to public directory
        $image->move(public_path('bannerImages'), $image->getClientOriginalName());

        $req->session()->flash('success', 'Banner Created Successfully!');
        return redirect('/bannersTable');
    }

    // Read
    public function read()
    {
        $data = Banner::all();
        return view('tables.bannersTable', ['data' => $data]);
    }

    // Update
    public function showUpdate($id)
    {
        $banner = Banner::find($id);
        $text = BannerText::where('banner_id', $banner->id)->first();
        return view('tables.editBanner', ['banner' => $banner, 'text' => $text]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'bannerText' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $banner = Banner::find($id);
    
        $bannerText = BannerText::where('banner_id', $banner->id)->first();
    
        if (!$bannerText) {
            $bannerText = new BannerText();
            $bannerText->banner_id = $banner->id;
        }
    
        $bannerText->text = $validated['bannerText'];
        $bannerText->save();
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $banner->image = $image->getClientOriginalName();
            $image->move(public_path('bannerImages'), $image->getClientOriginalName());
        }
    
        $banner->save();
    
        $request->session()->flash('success', 'Banner Updated Successfully!');
        return redirect('/bannersTable');
    }
    


    // Delete
    public function delete(Request $request, $id)
    {
        $banner = Banner::find($id);
        $banner->delete();

        $request->session()->flash('success', 'Banner Deleted successfully!');
        return redirect('/bannersTable');
    }
}
