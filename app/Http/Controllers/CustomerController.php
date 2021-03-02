<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use View;
use Osiset\BasicShopifyAPI\Options;
use Osiset\BasicShopifyAPI\BasicShopifyAPI;
use Osiset\BasicShopifyAPI\Session;
use App\User;


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
            'username' => 'required',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'locality' => 'required',
            'full_address' => 'required',
            'password' => 'required|string',
            'confirm_password' => 'required|same:password',
        ]);


        $shop = User::where('name', $request->shop)->first();
        $options = new Options();
        $options->setVersion('2021-01');
        $api = new BasicShopifyAPI($options);
        $api->setSession(new Session($shop->name, $shop->password));



        try {
            $communication_channel = [];
            $send_email_invite = false;
            $imgFileName = "";
            $fileName = "";
            $status = "";
            $password = "";
            $profile_pic = $request->file('profile_pic');
            $certificate = $request->file('certificate');
            $success_message = 'New account has been created successfully to shopify, Account activation link has been sent to your email account!';
            //$error_message = "";


            $communication_channel['cc_email'] = $request->cc_email;
            $communication_channel['cc_phone'] = $request->cc_phone;
            $communication_channel['cc_inperson'] = $request->cc_inperson;
            $communication_channel['cc_whatsapp'] = $request->cc_whatsapp;
            $communication_channel['cc_skype'] = $request->cc_skype;

            Log::info(json_encode($communication_channel));
            $communication_channel = serialize($communication_channel);
            Log::info(json_encode($communication_channel));


            if ($request->tag == 'role:designer') {
                $send_email_invite = true;
            }


            if ($request->tag == 'role:designer') {
                $status = 'pending';
                $success_message = "Designer Account Created successfully";
            } else {
                $status = 'active';
                $password = $request->password;
                $success_message = "Customer Account Created successfully";
            }

            if (!empty($profile_pic)) {
                //Display File Name
                $imgFileName = $profile_pic->getClientOriginalName();

                //Move Uploaded File
                $destinationPath = public_path() . '/uploads/profile_pic';
                $profile_pic->move($destinationPath, $profile_pic->getClientOriginalName());
            }


            if (!empty($certificate)) {
                //Display File Name
                $fileName = $certificate->getClientOriginalName();

                //Move Uploaded File
                $destinationPath = public_path() . '/uploads/certificate';
                $certificate->move($destinationPath, $certificate->getClientOriginalName());
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
                    'addresses' => [
                        [
                            'address1' => $request->full_address,
                            'city' => $request->city,
                            'province' => 'ON',
                            'phone' => $request->phone,
                            'zip' => $request->zip,
                            'last_name' => 'A',
                            'first_name' => 'B',
                            'country' => 'CA'
                        ]
                    ],
                    'send_email_invite' => $send_email_invite,
                    'metafields' => [
                        [
                            "key" => "username",
                            "value" => $request->username,
                            "value_type" => "string",
                            "namespace" => "global"

                        ],
                        [
                            "key" => "profile_type",
                            "value" => $request->profile_type,
                            "value_type" => "string",
                            "namespace" => "global"

                        ],
                        [
                            "key" => "locality",
                            "value" => $request->locality,
                            "value_type" => "string",
                            "namespace" => "global"

                        ],
                        [
                            "key" => "state",
                            "value" => $request->state,
                            "value_type" => "string",
                            "namespace" => "global"

                        ],
                        [
                            "key" => "communication_channel",
                            "value" => $request->communication_channel,
                            "value_type" => "string",
                            "namespace" => "global"

                        ],
                        [
                            "key" => "profile_pic",
                            "value" => "uploads/profile_pic/" . $imgFileName,
                            "value_type" => "string",
                            "namespace" => "global"

                        ],
                        [
                            "key" => "certificate",
                            "value" => "uploads/certificate/" . $fileName,
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


            $result = $api->rest('POST', '/admin/customers.json', $data)['body']['customer'];

            Log::info("result " . json_encode($result));

            if ($result) {
                $customer = Customer::create([
                    'username' => $request->username,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'phone' => $request->phone,
                    'status' => $status,
                    'address' => $request->address,
                    'locality' => $request->locality,
                    'city' => $request->city,
                    'zip' => $request->zip,
                    'state' => $request->state,
                    'country' => $request->country,
                    'profile_type' => $request->profile_type,
                    'profile_picture' => $imgFileName,
                    'designer_certificate' => $fileName,
                    'communication_channels' => $communication_channel,
                ]);

                if ($request->tag == "role:customer") {
                    $success_message = "Account created successfully!";
                }

                return response()->json(['data' => $customer, 'message' => $success_message])->setStatusCode(201);
            } else {
                return response()->json(['status' => 500, 'message' => 'something went wrong!'])->setStatusCode(500);
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return response()->json([$e->getMessage()])->setStatusCode(422);
        }
    }

    public function verifyUsername(Request $request)
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
    }

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

    public function designerApproval($id)
    {

        $customer = Customer::find($id);
        // $customer->status = "active";
        $customer->save();

        return response()->json(["status" => "success", "statusCode" => 200, "message" => "Designer profile has been approved successfully"]);
    }

    public function designerRejection($id)
    {
        $customer = Customer::find($id);
        // $customer->status = "disabled";
        $customer->save();

        return response()->json(["status" => "success", "statusCode" => 200, "message" => "Designer profile has been rejected successfully"]);
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
}
