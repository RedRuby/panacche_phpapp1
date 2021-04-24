<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Designer;
use Illuminate\Support\Facades\Log;
use View;
use App\Collection;
use App\Discount;
use App\Customer;
use App\Helpers\Helper;
use Mail;
use Osiset\BasicShopifyAPI\Options;
use Osiset\BasicShopifyAPI\BasicShopifyAPI;
use Osiset\BasicShopifyAPI\Session;
use App\User;
use App\Http\Requests\ForgotPassowrdRequest;


class PagesController extends Controller
{
    public function ourDesigners()
    {
        $designers = Designer::where('status', 'active')->get();
        $designers = view('pages.ourDesigners')->with('designers', $designers)->render();

        return response()->json(['status' => 200, 'success' => true, 'data' => ["designers" => $designers], 'message' => 'Designers loaded successfully'])->setStatusCode(200);
    }

    public function viewDesigner($id)
    {
        $designer = Designer::find($id);
        $designer = view('pages.view-designer')->with('designer', $designer)->render();

        return response()->json(['status' => 200, 'success' => true, 'data' => ["designer" => $designer], 'message' => 'Designers loaded successfully'])->setStatusCode(200);
    }

    public function viewDesign($id, $customer, $shop)
    {
        $customer = Customer::find($customer);
        $design = Collection::with('designer', 'collectionImages', 'bluePrintImages', 'colorPallettes', 'products', 'products.productImages', 'products.vendor', 'digitalProduct')->find($id);


        // if($design->digitalProduct){
        $shop = User::where('name', $shop)->first();
        $options = new Options();
        $options->setVersion('2021-01');
        $api = new BasicShopifyAPI($options);
        $api->setSession(new Session($shop->name, $shop->password));


        $result = $api->rest('GET', '/admin/products/' . $design->digitalProduct->id . '/variants.json')['body'];

        Log::info('result' . json_encode($result));

        //  }

        $discount = Discount::first();
        $design = view('pages.design')->with('design', $design)
            ->with('discount', $discount)
            ->with('customer', $customer)
            ->with('variant_id', $result["variants"][0]["id"])->render();

        return response()->json(['status' => 200, 'success' => true, 'data' => ["design" => $design], 'message' => 'Design loaded successfully'])->setStatusCode(200);
    }

    public function forgotPassword(ForgotPassowrdRequest $request)
    {
        Log::info("email: ". json_encode($request->all()));

        $customer = Customer::where('email', $request->email)->first();

        if($customer){
                $data = $customer->toArray();

                $template = "emails.reset-password";
                $subject = "Reset Password";
                $fromEmail = "panacche@gmail.com";
                $fromName = "Panacche Team";
                $toEmail = $customer->email;
                $emailTitle = "Reset Password Link";

                Log::info("data " .json_encode($data));
               $myEmail = Helper::sendmail($data, $template, $subject, $fromEmail, $fromName, $toEmail, $emailTitle);


               Log::info('customer ' .json_encode($myEmail));

               return response()->json(['status' => 200, 'success' => true, 'message' => 'Password reset link has been sent successfully, check your email account'])->setStatusCode(200);


        }else{
            $designer = Designer::where('email', $request->email)->first();
            if($designer){
                $temp = $designer;
                $data = $temp->all();
                $template = "emails.reset-password";
                $subject = "Reset Password";
                $fromEmail = "panacche@gmail.com";
                $fromName = "Panacche Team";
                $toEmail = $customer->email;
                $emailTitle = "Reset Password Link";
               $myEmail = Helper::sendmail($data, $template, $subject, $fromEmail, $fromName, $toEmail, $emailTitle);

               Log::info('designer ' .json_encode($myEmail));
               return response()->json(['status' => 200, 'success' => true, 'message' => 'Password reset link has been sent successfully, check your email account'])->setStatusCode(200);
            }else{
                return response()->json(['status' => 422, 'success' => false, 'errors' => ["email" =>"email not found", "message" => "email not found"]])->setStatusCode(422);
            }
        }
    }

    public function resetPassword(Request $request)
    {
        $this->validate($request, [
                'id' => 'required',
                'password' => 'required',
                'confirm_password' => 'required|same:password',
            ]);


            $shop = User::where('name', $request->shop)->first();
            $options = new Options();
            $options->setVersion('2021-01');
            $api = new BasicShopifyAPI($options);
            $api->setSession(new Session($shop->name, $shop->password));

            $data = [
                "customer"=> [
                    "id"=> $request->id,
                    "password"=> $request->password,
                    "password_confirmation"=> $request->password,
                ]
            ];

            $customer = Customer::find($request->id);

            if($customer){


                try {
                    $result = $api->rest('PUT', '/admin/customers/'.$request->id.'.json', $data)['body'];

                    Log::info("result ". json_encode($result));
                } catch (\Exception $e) {
                    Log::info($e->getMessage());
                    return response()->json(['status' => 422, "errors" => $e->getMessage()])->setStatusCode(422);
                }


                return response()->json(['status' => 200, 'success' => true, 'message' => 'Password updated successfully'])->setStatusCode(200);

            }else{
                $designer = Designer::find($request->id);
                if($designer){
                    try {
                        $result = $api->rest('PUT', '/admin/customers/'.$request->id.'.json', $data)['body'];
                        Log::info("result ". json_encode($result));
                    } catch (\Exception $e) {
                        Log::info($e->getMessage());
                        return response()->json(['status' => 422, "errors" => $e->getMessage()])->setStatusCode(422);
                    }

                return response()->json(['status' => 200, 'success' => true, 'message' => 'Password updated successfully'])->setStatusCode(200);

                }else{
                    return response()->json(['status' => 422, 'success' => false, 'message' => ["email" =>"invalid customer"]])->setStatusCode(200);
                }
            }







    }
}
