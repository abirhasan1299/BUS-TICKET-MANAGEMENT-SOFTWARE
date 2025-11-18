<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Support\Facades\Auth;

class SslCommerzPaymentController extends Controller
{


    public function index(Request $request)
    {
        $post_data = array();
        $post_data['total_amount'] = $request->amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = strtoupper(uniqid());


        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
         Payment::create([
                'transaction_id' => $post_data['tran_id'],
                'user_id' => Auth::user()->id,
                'cart_id' => $request->cart_id,
                'slot_id' => $request->slot_id,
                'amount' => $post_data['total_amount'],
                'currency' => $post_data['currency'],
                'created_at' => now(),
                'updated_at'=>now()
            ]);


        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }



    public function success(Request $request)
    {

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_details = DB::table('payments')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount','cart_id')->first();

        if ($order_details->status == 'pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation) {

                DB::table('payments')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'paid']);
                DB::table('carts')
                    ->where('id', $order_details->cart_id)
                    ->update(['status' => 'purchased']);

            }
        }

        return view('public.success');

    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('payments')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount','cart_id')->first();

        if ($order_details->status == 'pending') {
           DB::table('payments')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'failed']);
           DB::table('carts')
                ->where('id', $order_details->cart_id)
                ->update(['status' => 'failed']);

        } else if ($order_details->status == 'paid' || $order_details->status == 'complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }
        return redirect()->route('users.cart')->with('error', 'Transaction is Failed');
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('payments')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount','cart_id')->first();

        if ($order_details->status == 'pending') {
            DB::table('payments')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'cancelled']);
            DB::table('carts')
                ->where('id', $order_details->cart_id)
                ->update(['status' => 'cancelled']);

        } else if ($order_details->status == 'paid' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

        return redirect()->route('users.cart')->with('error', 'Transaction is Cancelled');
    }

}
