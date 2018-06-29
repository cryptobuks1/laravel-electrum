<?php

namespace AraneaDev\Electrum\App\Api;

use Illuminate\Http\Request;
use AraneaDev\Electrum\Electrum;
use App\Http\Controllers\Controller;

/**
 * Class WalletController.
 */
class WalletController extends Controller
{
    /** @var Electrum */
    protected $electrum;

    /**
     * WalletController constructor.
     *
     * @param Electrum $electrum
     */
    public function __construct(Electrum $electrum)
    {
        $this->middleware(config('electrum.web_interface.middleware', ['web', 'auth']));
        $this->electrum = $electrum;
    }

    /**
     * Create a wallet
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        return response()->json($this->electrum->createWallet(
            $request->get('seed'),
	    $request->get('password')
        ));
    }

    /**
     * Load a wallet
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function load(Request $request)
    {
        return response()->json($this->electrum->loadWallet(
	    $request->get('password')
        ));
    }

    /**
     * Create a seed and a key for a multisig wallet
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createMultisigKey(Request $request)
    {
        return response()->json($this->electrum->createMultisigKey(
            $request->get('seed')
        ));
    }

    /**
     * Create a multisig wallet
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createMultisigWallet(Request $request)
    {
        return response()->json($this->electrum->createMultisigWallet(
            $request->get('seed'),
            $request->get('cosignerkey'),
            $request->get('password')
        ));
    }
}
