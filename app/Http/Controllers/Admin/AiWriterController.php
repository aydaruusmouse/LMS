<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\SettingRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class AiWriterController extends Controller
{
    public function useCases(): array
    {
        return [
            'product_description'  => 'Product Description',
            'brand_name'           => 'Brand Name',
            'email'                => 'Email',
            'email_reply'          => 'Email Reply',
            'review_feedback'      => 'Review Feedback',
            'blog_idea'            => 'Blog Idea & Outline',
            'blog_writing'         => 'Blog Section Writing',
            'business_idea'        => 'Business Ideas',
            'business_idea_pitch'  => 'Business Idea Pitch',
            'proposal_later'       => 'Proposal Later',
            'cover_letter'         => 'Cover Letter',
            'call-to_action'       => 'Call to Action',
            'job_description'      => 'Job Description',
            'legal_agreement'      => 'Legal Agreement',
            'social_ads'           => 'Facebook, Twitter, Linkedin Ads',
            'google_ads'           => 'Google Search Ads',
            'post_idea'            => 'Post & Caption Ideas',
            'police_general_dairy' => 'Police General Dairy',
            'comment_reply'        => 'Comment Reply',
            'birthday_wish'        => 'Birthday Wish',
            'seo_meta'             => 'SEO Meta Description',
            'seo_title'            => 'SEO Meta Title',
            'song_lyrics'          => 'Song Lyrics',
            'story_plot'           => 'Story Plot',
            'review'               => 'Review',
            'testimonial'          => 'Testimonial',
            'video_des'            => 'Video Description',
            'video_idea'           => 'Video Idea',
            'php_code'             => 'PHP Code',
            'python_code'          => 'Python Code',
            'java_code'            => 'Java Code',
            'javascript_code'      => 'Javascript Code',
            'dart_code'            => 'Dart Code',
            'swift_code'           => 'Swift Code',
            'c_code'               => 'C Code',
            'c#_code'              => 'C# Code',
            'mysql_query'          => 'MySQL Query',
            'about_us'             => 'About Us',
        ];
    }

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $data = [
            'use_cases' => $this->useCases(),
        ];

        return view('backend.admin.ai_writer.index', $data);
    }

    public function saveAiSetting(Request $request, SettingRepository $setting): \Illuminate\Http\JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }

        $request->validate([
            'ai_secret_key' => 'required',
        ]);

        try {
            $setting->update($request);
            Toastr::success(__('update_successful'));
            $data = [
                'success' => __('update_successful'),
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'error' => $e->getMessage(),
            ];

            return response()->json($data);
        }
    }

    public function generateContent(Request $request)
    {
        $request->validate([
            'prompt' => 'required',
            'length' => 'required',
        ]);

        try {

            $api_key = setting('ai_secret_key');
            $url     = 'https://api.openai.com/v1/completions';

            $headers = [
                'Content-type'  => 'application/json',
                'Authorization' => "Bearer $api_key",
            ];

            $body    = [
                'model'       => 'text-davinci-003',
                'prompt'      => $request->prompt,
                'max_tokens'  => (int) $request->length,
                'temperature' => 1,
                'n'           => (int) $request->variants,
            ];

            $result  = curlRequest($url, json_encode($body), 'POST', $headers, true);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }

        try {
            if (! (arrayCheck('choices', $result) && count($result['choices']) > 0 && arrayCheck('text', $result['choices'][0]))) {
                return response()->json([
                    'error' => 'Something went wrong. Please try again.',
                ]);
            }
            $data = str_replace("\n", '<br>', $result['choices'][0]['text']);

            return response()->json([
                'content' => $data,
                'success' => 1,
            ]);
        } catch (\Exception $e) {
        }
    }
}
