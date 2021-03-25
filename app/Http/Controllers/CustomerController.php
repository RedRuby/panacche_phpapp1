<?php

namespace App\Http\Controllers;

use View;
use Mail;
use App\User;
use App\Customer;
use App\Designer;
use GuzzleHttp\Client;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use GuzzleHttp\RequestOptions;
use Osiset\BasicShopifyAPI\Options;
use Osiset\BasicShopifyAPI\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Spatie\Activitylog\Models\Activity;
use Osiset\BasicShopifyAPI\BasicShopifyAPI;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'Get Customers';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $this->validate($request, [
            'shop' => 'required',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|unique:customers',
            'phone' => array('required', 'regex:/^(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([0-9]{3})\s*\)|([0-9]{3}))\s*(?:[.-]\s*)?([0-9]{3})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/'),
            'password' => 'required|string',
            'confirm_password' => 'required|same:password',
            // 'resume' => 'required',
            // 'portfolio' => 'required'
        ]);


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

                        ],[
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


    public function customerRegistration(Request $request)
    {


        $this->validate($request, [
            'shop' => 'required',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|unique:customers',
            'phone' => array('required', 'regex:/^(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([0-9]{3})\s*\)|([0-9]{3}))\s*(?:[.-]\s*)?([0-9]{3})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/'),
            'how_did_you_hear_about_us' => 'required',
            'password' => 'required|string',
            'confirm_password' => 'required|same:password',
        ]);

        $shop = User::where('name', $request->shop)->first();
        $options = new Options();
        $options->setVersion('2021-01');
        $api = new BasicShopifyAPI($options);
        $api->setSession(new Session($shop->name, $shop->password));

        try {
            $imgFileName = "";
            $status = "active";
            $display_picture = $request->file('display_picture');
            $success_message = "Customer Account Created successfully";
            $emailTemplate = "emails.customerAccount";
            $emailSubject = "Customer Account Created successfully!";
            $role = "customer";

            if (!empty($display_picture)) {
                //Display File Name
                $imgFileName = $display_picture->getClientOriginalName();

                //Move Uploaded File
                $destinationPath = public_path() . '/uploads/user/display_picture';
                $display_picture->move($destinationPath, $display_picture->getClientOriginalName());
            }


            $data = [
                'customer' => [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'verified_email' => true,
                    'password' => $request->password,
                    'password_confirmation' => $request->password,
                    'send_email_invite' => false,
                    'metafields' => [
                        [
                            "key" => "display_picture",
                            "value" => "uploads/user/display_picture/" . $imgFileName,
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
                $customer = Customer::create([
                    'id' => $result['customer']['id'],
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'phone' => $request->phone,
                    'status' => $status,
                    'display_picture' => $imgFileName,
                    'how_did_you_hear_about_us' => $request->how_did_you_hear_about_us
                ]);

                $temp = $customer;
                $data = $temp->toArray();
                $template = $emailTemplate;
                $subject = $emailSubject;
                $fromEmail = "panacchebeta@gmail.com";
                $fromName = "Panacche Team";
                $toEmail = $request->email;
                $emailTitle = "Account Creation";

                if (!empty($customer->id)) {
                    // Model has been successfully inserted
                    $myEmail = Helper::sendmail($data, $template, $subject, $fromEmail, $fromName, $toEmail, $emailTitle);
                    if (empty($myEmail)) {
                        Log::info("mail has been sent because empty no error " . $myEmail);

                        $log_message = "Account creation email has been sent to " . $role;

                        Helper::log_activity($customer, $customer, $customer, $log_message);
                    } else {
                        $log_message = "Due to some error account creation email has not sent to " . $role;
                        Helper::log_activity($customer, $customer, $customer, $log_message);
                    }

                    Helper::log_activity($customer, $customer, $customer, $success_message);

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
                    Helper::log_activity($newCustomer, $customer, $data, $log_message);
                }
            } else {
                return response()->json(['status' => 422, 'errors' => $result])->setStatusCode(422);
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return response()->json(['status' => 422, "errors" => $e->getMessage()])->setStatusCode(422);
        }
    }

    /*public function verifyUsername(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
        ]);

        $customer = Customer::where('username', $request->username)->get();
        if ($customer->isEmpty()) {
            return response()->json(["success" => ["username" => "Username verified successfully"]])->setStatusCode(200);

            //Log::info("email not exist". json_encode($customer));
        } else {
            return response()->json(["errors" => ["username" => "Username has already taken"]])->setStatusCode(422);
        }
        Log::info("customer" . json_encode($customer));
    }*/

    public function verifyEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $customer = Customer::where('email', $request->email)->get();
        if ($customer->isEmpty()) {
            return response()->json(["success" => ["email" => "Email verified successfully"]])->setStatusCode(200);

            //Log::info("email not exist". json_encode($customer));
        } else {
            return response()->json(["errors" => ["email" => "Email has already taken"]])->setStatusCode(422);
        }
        Log::info("customer" . json_encode($customer));
    }

    public function verifyPhone(Request $request)
    {
        $this->validate($request, [
            'phone' => array('required', 'regex:/^(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([0-9]{3})\s*\)|([0-9]{3}))\s*(?:[.-]\s*)?([0-9]{3})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/'),
        ]);

        $customer = Customer::where('phone', $request->phone)->get();
        if ($customer->isEmpty()) {
            return response()->json(["success" => ["phone" => "Phone verified successfully"]])->setStatusCode(200);

            //Log::info("email not exist". json_encode($customer));
        } else {
            return response()->json(["errors" => ["phone" => "Phone has already taken"]])->setStatusCode(422);
        }
        Log::info("customer" . json_encode($customer));
    }

   /* public function verifyZip(Request $request)
    {
        $this->validate($request, [
            'zip' => array('required', 'regex:/(^\d{5}$)|(^\d{5}-\d{4}$)/'),
        ]);

        $customer = Customer::where('zip', $request->phone)->get();
        if ($customer->isEmpty()) {
            return response()->json(["success" => ["zip" => "Zip verified successfully"]])->setStatusCode(200);

            //Log::info("email not exist". json_encode($customer));
        } else {
            return response()->json(["errors" => ["zip" => "Zip has already taken"]])->setStatusCode(422);
        }
        Log::info("customer" . json_encode($customer));
    }*/

    public function approveDesigner($id, $shop)
    {
        Log::info('profile id' . $id);
        try {
            $customer = Customer::find($id);
            $customer->status = "active";
            $customer->save();

            return response()->json(["status" => "success", "statusCode" => 200, "message" => "Designer profile has been approved successfully"]);
        } catch (\Exception $e) {
            return response()->json(['status' => 422, 'errors' => $e->getMessage()])->setStatusCode(422);
        }

    }

    public function rejectDesigner($id, $shop)
    {

        try {
            $customer = Customer::find($id);
            $customer->status = "disabled";
            $customer->save();

            return response()->json(["status" => "success", "statusCode" => 200, "message" => "Designer profile has been rejected successfully"]);
        } catch (\Exception $e) {
            return response()->json(['status' => 422, 'errors' => $e->getMessage()])->setStatusCode(422);
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        return View::make('customer.view', ["customer" => $customer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getCustomer($id)
    {
        $customer = Customer::find($id);
        return response()->json(["status" => "success", "statusCode" => 200, "message" => "Customer profile data", "data" => $customer]);
    }

    public function viewDesignerProfile($id)
    {
        $designer  = Customer::find($id);
        return $designer;
    }
}
