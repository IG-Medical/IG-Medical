<?php


namespace Setting\Http\Controllers\AdminPanel\Setting;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Setting\Http\Controllers\AdminPanel\CoreController;
use Setting\Http\Requests\AdminPanel\StoreSettingRequest;
use Setting\Models\Setting;

class SettingController extends CoreController
{
    public function __construct(Setting $setting)
    {
        $this->subDirView = 'settings';
        $this->asRoute = 'setting';
        $this->route = 'settings';

        if (request('page'))
            $this->routeUrl = route_admin($this->asRoute . '.index', ['page' => request('page')]);
        parent::__construct($setting);

        $permission1 = 'index-general-settings|index-email-settings|index-custom-css-js-settings|index-maintenances-settings';
        $permission2 = 'edit-general-settings|edit-email-settings|edit-custom-css-js-settings|edit-maintenances-settings';
//
//        $this->middleware('permission:'.$permission1.'|'.$permission2, ['only' => ['index', 'store']]);
//        $this->middleware('permission:'.$permission2, ['only' => ['store']]);
    }

    public function index($page)
    {
        $pageTitle = $this->getBasenamePage($page);

        meta_data($pageTitle, $pageTitle, [
            '#' => trans_module_setting('admin.settings'),
            '' => $pageTitle
        ]);

        $moduleNamespace = $this->moduleNamespace;

        $settings = getSettings();

        return view($this->moduleDirView . '.' . $this->subDirView . '.' . $page,
            compact('settings', 'page', 'moduleNamespace')
        );
    }

    // public function store(StoreSettingRequest $request)
    // {
    //     $settings = [];
    //     $currentSettings = getSettings();
    //     $oldSettings = [];

    //     $requestArray = $request->toArray();
    //     unset($requestArray['page']);

    //     foreach ($requestArray as $key => $value) {
    //         $currentKey = $currentSettings->where('key', $key);

    //         if (count($currentKey) > 0)
    //             $oldSettings[] = $key;


    //         $settings[] = [
    //             'key' => $key,
    //             'value' => is_array($value) ? serialize($value) : $value,
    //         ];
    //     }

    //     Setting::whereIn('key', $oldSettings)->delete();
    //     $save = Setting::insert($settings);

    //     Cache::forget('settings');

    //     return $this->successResponse($save);
    // }
    public function store(StoreSettingRequest $request)
    {
        // Log request info for debugging
        Log::info('Settings store request', [
            'has_file' => $request->hasFile('slider_video'),
            'file_size' => $request->hasFile('slider_video') ? $request->file('slider_video')->getSize() : null,
            'post_max_size' => ini_get('post_max_size'),
            'upload_max_filesize' => ini_get('upload_max_filesize'),
        ]);

        $settings = [];
        $currentSettings = getSettings();
        $oldSettings = [];

        $requestArray = $request->except(['page', 'remove_slider_video']);

        // Get current slider_video value before processing (get raw value, not accessor)
        $currentSliderVideo = $currentSettings->where('key', 'slider_video')->first();
        $oldFilename = null;
        if ($currentSliderVideo) {
            // Get raw value from database to avoid accessor transformation
            $oldFilename = $currentSliderVideo->getOriginal('value');
        }

        // Handle slider video removal
        if ($request->has('remove_slider_video') && $request->remove_slider_video) {
            $requestArray['slider_video'] = null;
            
            // Delete old file if exists
            if ($oldFilename) {
                $oldFilePath = public_path('uploads/' . Setting::DIR_SLIDER_VIDEO_UPLOADS . '/' . $oldFilename);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
            }
        }
        // Handle slider video upload
        elseif ($request->hasFile('slider_video')) {
            try {
                $file = $request->file('slider_video');
                
                // Log file info for debugging
                Log::info('Slider video upload attempt', [
                    'has_file' => $request->hasFile('slider_video'),
                    'is_valid' => $file ? $file->isValid() : 'file is null',
                    'error' => $file ? $file->getError() : 'no file',
                    'size' => $file ? $file->getSize() : 'no file',
                    'mime' => $file ? $file->getMimeType() : 'no file',
                ]);
                
                // Validate file is valid
                if (!$file || !$file->isValid()) {
                    $errorCode = $file ? $file->getError() : UPLOAD_ERR_NO_FILE;
                    $errorMessages = [
                        UPLOAD_ERR_INI_SIZE => 'The file exceeds the upload_max_filesize directive in php.ini',
                        UPLOAD_ERR_FORM_SIZE => 'The file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
                        UPLOAD_ERR_PARTIAL => 'The file was only partially uploaded',
                        UPLOAD_ERR_NO_FILE => 'No file was uploaded',
                        UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder',
                        UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk',
                        UPLOAD_ERR_EXTENSION => 'A PHP extension stopped the file upload',
                    ];
                    $errorMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : 'Unknown upload error (code: ' . $errorCode . ')';
                    
                    Log::error('Slider video upload validation failed', [
                        'error_code' => $errorCode,
                        'error_message' => $errorMessage,
                    ]);
                    
                    if (!$request->expectsJson()) {
                        return redirect()->back()->withErrors(['slider_video' => 'The slider video failed to upload. ' . $errorMessage]);
                    }
                    return response()->json(['error' => 'The slider video failed to upload. ' . $errorMessage], 422);
                }

                $filename = uniqid('slider_', true) . '.' . $file->getClientOriginalExtension();

                // Ensure upload directory exists
                $uploadDir = public_path('uploads/' . Setting::DIR_SLIDER_VIDEO_UPLOADS);
                if (!File::exists($uploadDir)) {
                    if (!File::makeDirectory($uploadDir, 0755, true)) {
                        if (!$request->expectsJson()) {
                            return redirect()->back()->withErrors(['slider_video' => 'Failed to create upload directory. Please check permissions.']);
                        }
                        return response()->json(['error' => 'Failed to create upload directory. Please check permissions.'], 422);
                    }
                }

                // Check if directory is writable
                if (!is_writable($uploadDir)) {
                    if (!$request->expectsJson()) {
                        return redirect()->back()->withErrors(['slider_video' => 'Upload directory is not writable. Please check permissions.']);
                    }
                    return response()->json(['error' => 'Upload directory is not writable. Please check permissions.'], 422);
                }

                // Delete old file if exists
                if ($oldFilename) {
                    $oldFilePath = public_path('uploads/' . Setting::DIR_SLIDER_VIDEO_UPLOADS . '/' . $oldFilename);
                    if (File::exists($oldFilePath)) {
                        File::delete($oldFilePath);
                    }
                }

                // Move uploaded file
                if ($file->move($uploadDir, $filename)) {
                    $requestArray['slider_video'] = $filename;
                } else {
                    // If move fails, return with error
                    if (!$request->expectsJson()) {
                        return redirect()->back()->withErrors(['slider_video' => 'The slider video failed to upload. Please check file permissions and disk space.']);
                    }
                    return response()->json(['error' => 'The slider video failed to upload. Please check file permissions and disk space.'], 422);
                }
            } catch (\Exception $e) {
                // Catch any exceptions during upload
                Log::error('Slider video upload failed: ' . $e->getMessage(), [
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString()
                ]);
                
                if (!$request->expectsJson()) {
                    return redirect()->back()->withErrors(['slider_video' => 'The slider video failed to upload: ' . $e->getMessage()]);
                }
                return response()->json(['error' => 'The slider video failed to upload: ' . $e->getMessage()], 422);
            }
        }

        foreach ($requestArray as $key => $value) {
            $currentKey = $currentSettings->where('key', $key);

            if (count($currentKey) > 0) {
                $oldSettings[] = $key;
            }

            $settings[] = [
                'key' => $key,
                'value' => is_array($value) ? serialize($value) : $value,
            ];
        }

        Setting::whereIn('key', $oldSettings)->delete();
        $save = Setting::insert($settings);

        Cache::forget('settings');

        // Redirect back for non-JSON requests (normal form submit)
        if (!$request->expectsJson()) {
            return redirect()->back()->with('success', 'Saved successfully');
        }

        return $this->successResponse($save);
    }

    private function getBasenamePage($page)
    {
        switch ($page) {
            case PAGE_CUSTOM_CSS_JS:
                $page = trans_module_setting('admin.custom_css_and_js');
                break;
            case PAGE_GENERAL:
                $page = trans_module_setting('admin.general');
                break;
            case PAGE_MAIL:
                $page = trans_module_setting('admin.mail');
                break;
            case PAGE_MAINTENANCE:
                $page = trans_module_setting('admin.maintenance');
                break;
            default:
                $page = trans_module_setting('admin.site');
                break;
        }

        return $page;
    }
}
