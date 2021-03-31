<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Collection;
use View;
use Mail;
use App\User;
use App\Customer;
use App\Designer;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Osiset\BasicShopifyAPI\Options;
use Osiset\BasicShopifyAPI\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Spatie\Activitylog\Models\Activity;
use Osiset\BasicShopifyAPI\BasicShopifyAPI;
use App\Http\Requests\DesignerStoreRequest;
class DesignerController extends Controller
{
    /*public function users($id)
    {
        // $customers = Customer::where('tag', 'role:designer')
        //     ->where('status', 'pending')
        //     ->get();

        // return View::make("admin.newDesigners")->with("customers", $customers);
    }*/

   /* public function designs($id)
    {
        $designs = Collection::where('customer_id', $id)->with('customer')->with('collectionImages')->get();
        //return $designs;
        $data = ['abc', "xyz", "lmn"];
        $template = "emails.mail";
        $subject = "just for testing";
        $fromEmail = "panacchebeta@gmail.com";
        $fromName = "Panacche Team";
        $toEmail = "nileshbari.8085@gmail.com";
        $emailTitle = "Account Creation";

        Helper::sendmail($data, $template, $subject, $fromEmail, $fromName, $toEmail, $emailTitle);

        return View::make("designer.mydesigns")->with("designs", $designs);
    }*/

    public function dashboard($id)
    {

        $inprogressDesigns = Collection::where('designer_id', $id)->where('status', 'disabled')->count();

        //return $inprogressDesigns;
        $draftDesigns = Collection::where('designer_id', $id)->where('status', 'draft')->count();
        $publishedDesigns = Collection::where('published', true)->where('status', 'active')->count();
        $underReviewDesigns = Collection::where('published', false)->where('status', 'active')->count();

        $designs = Collection::where('designer_id', $id)->with('designer')->with('collectionImages')->get();

        $designer = Designer::find($id);

        $dataCards = view('designer.dashboardStatistics')->with('inprogressDesigns', $inprogressDesigns)->with("draftDesigns", $draftDesigns)->with("publishedDesigns", $publishedDesigns)->with("underReviewDesigns", $underReviewDesigns)->render();
        $designCards = view('designer.mydesigns')->with('designs', $designs)->render();
        //$orderRows = view('designer.mymyorders')->with('designs', $designs)->render();

        return response()->json(['status'=>201, 'success' => true, 'data'=>["dataCards"=>$dataCards, "designCards"=>$designCards, "designer"=>$designer], 'message'=>'Designer Dashboard loaded successfully'])->setStatusCode(200);


        //return View::make("designer.dashboardStatistics")->with('inprogressDesigns', $inprogressDesigns)->with("draftDesigns", $draftDesigns)->with("publishedDesigns", $publishedDesigns)->with("underReviewDesigns", $underReviewDesigns);
    }

    public function store(DesignerStoreRequest $request)
    {
        Log::info("in store method");

/*
        $validator = Validator::make($request->all(), [
            'shop' => 'required',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|unique:customers',
            'phone' => array('required', 'regex:/^(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([0-9]{3})\s*\)|([0-9]{3}))\s*(?:[.-]\s*)?([0-9]{3})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/'),
            'password' => 'required|string',
            'confirm_password' => 'required|same:password',
            'website_url' => 'url',
            'resume' => 'required',
            'portfolio' => 'required'
        ]);


        //$validator = Validator::make($request->all(), $rules);

        // Validate the input and return correct response
        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()
            ), 422);
        }
*/


        $shop = User::where('name', $request->shop)->first();
        $options = new Options();
        $options->setVersion('2021-01');
        $api = new BasicShopifyAPI($options);
        $api->setSession(new Session($shop->name, $shop->password));

        try {
            $communication_channel = [];
            $displayPictureFileName = "";
            $resumeFileName = "";
            $portfolioFileName = "";
            $password = "";
            $display_picture = $request->file('display_picture');
            $resume = $request->file('resume');
            $portfolio = $request->file('portfolio');
            $status = 'pending';
            $success_message = "Designer Account Created successfully";
            $emailTemplate = "emails.designerAccount";
            $emailSubject = "Designer Account Created successfully!";
            $role = "designer";
            //$success_message = 'New account has been created successfully to shopify, Account activation link has been sent to your email account!';

            if (!empty($display_picture)) {
                //Display File Name
                $displayPictureFileName = $display_picture->getClientOriginalName();

                //Move Uploaded File
                $destinationPath = public_path() . '/uploads/designer/display_picture/';
                $display_picture->move($destinationPath, $display_picture->getClientOriginalName());
            }


            if (!empty($resume)) {
                //Display File Name
                $resumeFileName = $resume->getClientOriginalName();

                //Move Uploaded File
                $destinationPath = public_path() . '/uploads/designer/resume/';
                $resume->move($destinationPath, $resume->getClientOriginalName());
            }

            if (!empty($portfolio)) {
                //Display File Name
                $portfolioFileName = $portfolio->getClientOriginalName();

                //Move Uploaded File
                $destinationPath = public_path() . '/uploads/designer/portfolio/';
                $portfolio->move($destinationPath, $portfolio->getClientOriginalName());
            }

            $data = [
                'customer' => [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'verified_email' => true,
                    'password' => $password,
                    'password_confirmation' => $password,
                    'send_email_invite' => true,
                    'metafields' => [
                        [
                            "key" => "display_picture",
                            "value" => "uploads/user/display_picture/" . $displayPictureFileName,
                            "value_type" => "string",
                            "namespace" => "global"

                        ],
                        [
                            "key" => "resume",
                            "value" => "uploads/user/resume/" . $resumeFileName,
                            "value_type" => "string",
                            "namespace" => "global"

                        ], [
                            "key" => "portfolio",
                            "value" => "uploads/user/portfolio/" . $portfolioFileName,
                            "value_type" => "string",
                            "namespace" => "global"

                        ], [
                            "key" => "status",
                            "value" => $status,
                            "value_type" => "string",
                            "namespace" => "global"

                        ],
                        [
                            "key" => "tag",
                            "value" => $request->tag,
                            "value_type" => "string",
                            "namespace" => "global"

                        ]
                    ]
                ]
            ];


            try {
                $result = $api->rest('POST', '/admin/customers.json', $data)['body'];
            } catch (\Exception $e) {
                Log::info($e->getMessage());
                return response()->json(['status' => 422, "errors" => $e->getMessage()])->setStatusCode(422);
            }

            Log::info("result " . json_encode($result));

            if (isset($result['customer'])) {
                $designer = Designer::create([
                    'id' => $result['customer']['id'],
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'phone' => $request->phone,
                    'status' => $status,
                    'display_picture' => $displayPictureFileName,
                    'resume' => $resumeFileName,
                    'portfolio' => $portfolioFileName,
                    'tag' => $request->tag,
                    'bio' => $request->bio,
                    'quote' => $request->quote,
                    'business_name' => $request->business_name,
                    'business_address' => $request->business_address,
                ]);

                $temp = $designer;
                $data = $temp->toArray();
                $template = $emailTemplate;
                $subject = $emailSubject;
                $fromEmail = "panacchebeta@gmail.com";
                $fromName = "Panacche Team";
                $toEmail = $request->email;
                $emailTitle = "Account Creation";

                if (!empty($designer->id)) {
                    // Model has been successfully inserted
                    $myEmail = Helper::sendmail($data, $template, $subject, $fromEmail, $fromName, $toEmail, $emailTitle);
                    if (empty($myEmail)) {
                        Log::info("mail has been sent because empty no error " . $myEmail);

                        $log_message = "Account creation email has been sent to " . $role;

                        Helper::log_activity($designer, $designer, $designer, $log_message);
                    } else {
                        $log_message = "Due to some error account creation email has not sent to " . $role;
                        Helper::log_activity($designer, $designer, $designer, $log_message);
                    }

                    Helper::log_activity($designer, $designer, $designer, $success_message);

                    return response()->json(['status' => 201, 'data' => $request->all(), 'message' => $success_message])->setStatusCode(201);
                } else {
                    $data = $request->all();
                    $template = "emails.accountNotCreated";
                    $subject = "Record is created in shopify but not is App due to some error";
                    $toEmail = "admin@admin.com"; // or admin@panacche.com
                    $emailTitle = "Record is not created in app";
                    $myEmail = Helper::sendmail($data, $template, $subject, $fromEmail, $fromName, $toEmail, $emailTitle);
                    $log_message = "Record is created in shopify but not is App due to some error";
                    $newCustomer = new Customer();
                    Helper::log_activity($newCustomer, $designer, $data, $log_message);
                }
            } else {
                return response()->json(['status' => 422, 'errors' => $result])->setStatusCode(422);
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return response()->json(['status' => 422, "errors" => $e->getMessage()])->setStatusCode(422);
        }
    }

    public function inProgress(){
        $designs  = Collection::where('status', 'disabled')->get();
        $designCards = view('designer.inprogress')->with('designs', $designs)->render();

        return response()->json(['status'=>201, 'success' => true, 'data'=>["designCards"=>$designCards], 'message'=>'Designer Dashboard loaded successfully'])->setStatusCode(200);
    }

    public function draft(){
        $designs  = Collection::where('status', 'disabled')->get();
        $designCards = view('designer.draft')->with('designs', $designs)->render();

        return response()->json(['status'=>201, 'success' => true, 'data'=>["designCards"=>$designCards], 'message'=>'Designer Dashboard loaded successfully'])->setStatusCode(200);
    }

    public function published(){
        $designs  = Collection::where('status', 'disabled')->get();
        $designCards = view('designer.published')->with('designs', $designs)->render();

        return response()->json(['status'=>201, 'success' => true, 'data'=>["designCards"=>$designCards], 'message'=>'Designer Dashboard loaded successfully'])->setStatusCode(200);
    }

    public function under_review(){
        $designs  = Collection::where('status', 'disabled')->get();
        $designCards = view('designer.under_review')->with('designs', $designs)->render();

        return response()->json(['status'=>201, 'success' => true, 'data'=>["designCards"=>$designCards], 'message'=>'Designer Dashboard loaded successfully'])->setStatusCode(200);
    }

}
