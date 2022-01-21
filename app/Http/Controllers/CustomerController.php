<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\PurchaseTransaction;
use App\Voucher;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Contracts\Cache\Lock;

class CustomerController extends Controller
{
    public function checkEligible($id)
    {
        //count total of the customer's purchase within 30 days
        $recent_purchase = PurchaseTransaction::where('customer_id', '=', $id)->where('transaction_at', '>', now()->subDays(30)->endOfDay())->count();
        //get the customer's total transcation
        $total_transcations = PurchaseTransaction::where('customer_id', '=', $id)->sum('total_spent');
        //check is there any voucher redeemed by the customer
        $cust_voucher = Voucher::where('customer_id', '=', $id)->count();
        $voucher_available = Voucher::where('status', '=', Voucher::AVAILABLE)->count();

        //check voucher eligibility
        if($voucher_available > 0){
            //check customer eligibility
            if($total_transcations >= 100 && $cust_voucher == 0 && $recent_purchase == 3){
                
                $is_locked = false;
                do{
                    $voucher_id = Voucher::where('status', '=', Voucher::AVAILABLE)->pluck('id')->first();

                    //Atomic lock this voucher for 10s
                    $lock = Cache::put($voucher_id, 10);

                    //While this voucher is locked for 10s, assign this voucher to this eligible customer then unlock and continue to accept new request
                    if (Cache::get($voucher_id)) {
                        //lock voucher for 10 mins for this customer
                        $res = Voucher::where('id', $voucher_id)->update(['customer_id'=>$id,'status'=>Voucher::RESERVED,'reserve_at'=>Carbon::now(),'expired_reserve_at'=>Carbon::now()->addMinutes(10)]);
                        Cache::forget($voucher_id);
                    }else{
                        $is_locked = true;
                    }
                }while($is_locked);
                
                if($res == 1){
                    $result = "Customer with ID ". $id . " is eligible and voucher will be locked for 10 mins for this customer";
                }
            }else{
                $result = "Customer with ID ". $id . " is not eligible";
            }
        }else{
            $result = "No voucher available";
        }
        return $result;
    }

    public function validatePhoto($id)
    {
        //fake api process and return responce, assume response return true
        $client = new \GuzzleHttp\Client();
        $request = $client->get('http://b1b9bea7-e0c5-4d89-bf3e-ff4519183a8e.mock.pstmn.io/fakeImageRecog');
        $response = $request->getBody();
        $response_decode = json_decode($response, true);
        $response_status = $response_decode['status'];

        //get the reserve expired time
        $voucher_reserve_time_end = Voucher::where('customer_id', '=', $id)->where('status', '=', Voucher::RESERVED)->pluck('expired_reserve_at')->first();
        //if response return true and still within 10 min, unlock and return voucher code, else vice verse
        if($response_status == true && Carbon::now('UTC')->lte($voucher_reserve_time_end)){

            //allocate locked voucher to this customer, update voucher status to released
            $voucher_code = Voucher::where('customer_id', '=', $id)->where('status', '=', Voucher::RESERVED)->pluck('code');
            Voucher::where('customer_id', '=', $id)->where('status', '=', Voucher::RESERVED)->update(['status'=>Voucher::RELEASED]);
            //return voucher code
            $result = $voucher_code;
        }else{

            //Remove the lock down, reset the voucher info and voucher become available to customer
            Voucher::where('customer_id', '=', $id)->where('status', '=', Voucher::RESERVED)->update(['customer_id'=>NULL, 'status'=>Voucher::AVAILABLE, 'reserve_at'=>NULL, 'expired_reserve_at'=>NULL,]);
            $result = "Photo Validation Failed";
        }
        return $result;
    }
}
