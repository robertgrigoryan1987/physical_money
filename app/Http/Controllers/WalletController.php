<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Auth;

class WalletController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * wallet add view.
     *
     */
    public function add(){
        return view('wallet.add');
    }

    /**
     * wallet add post.
     *
     */
    public function add_post(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'balance' => 'required|numeric',
        ]);

        $user = Auth::user();
        if($user->hasWallet($request->name)){
            return redirect()->route('home');
        }else{
            $wallet = $user->createWallet([
                'name' => $request->name,
                'slug' => $request->name,
            ]);
            $wallet->deposit($request->balance);
            return redirect()->route('wallets');

        }
    }

    /**
     * show usser all wallets.
     *
     */
    public function wallets(){
        $user = Auth::user();
        $wallets =  $user->wallets;
        return view('wallet.wallets')->with(['wallets'=>$wallets]);
    }

    public function transfer(){
        $user = Auth::user();
        $wallets =  $user->wallets;
        $users = User::all()->where('id','!=',Auth::id());
        $balance_sum = 0;
        foreach ($wallets as $wallet){
            $balance_sum+=$wallet->balance;
        }
        return view('wallet.transfer')->with(['wallets'=>$wallets,'user'=>$user,'balance_sum'=>$balance_sum,'users'=>$users]);

    }

    public function transfer_post(Request $request){
        $user = Auth::user();
        $wallet_from = Wallet::where('id',$request->from)->first();
        $wallet_from_slug = $wallet_from->slug;
        $wallet_to = Wallet::where('id',$request->to)->first();
        $wallet_to_slug = $wallet_to->slug;

        $firstWallet = $user->getWallet($wallet_from_slug);
        $lastWallet = $user->getWallet($wallet_to_slug);
        if($firstWallet->transfer($lastWallet, $request->ammount)){
            return redirect()->route('wallet.transaction');
        }
    }

    public function transfer_user_post(Request $request){
        $user = Auth::user();
        $wallet_from = Wallet::where('id',$request->from_me)->first();
        $wallet_from_slug = $wallet_from->slug;
        $user_to = User::where('id',$request->user)->first();
        $wallet_to = Wallet::where('id',$request->user_wallet)->first();
        $wallet_to_slug = $wallet_to->slug;

        $firstWallet = $user->getWallet($wallet_from_slug);
        $lastWallet = $user_to->getWallet($wallet_to_slug);
        if($firstWallet->transfer($lastWallet, $request->ammount)){
            return redirect()->route('wallet.transaction');
        }
    }


    public function transaction(){
        $transactions = Transaction::all();
        return view('wallet.transactions')->with(['transactions'=>$transactions]);
    }

    public function user_wallets(Request $request){
        $user = User::where('id',$request->user_id)->first();
        if($user){
            $wallets =  $user->wallets;
            if(count($wallets)>0){
                $string = '<label for="staticEmail2" class="sr-only">To</label>';
                $string .= '<select class="form-control" id="" name="user_wallet"><option>Select Wallet</option>';

                foreach($wallets as $wallet){
                    $string .= '<option value="'.$wallet->id.'">'.$wallet->name.':'.$wallet->balance.'</option>';
                }
                $string .= '</select>';
                return $string;
            }else{
                return 'User dont have wallet';
            }
        }else{
            return 'no user';
        }
    }

}
