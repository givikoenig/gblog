<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Custom\SubnetCalculator;

class IpCalculateController extends Controller
{
    public function index() {
        return view('posts.ipcalculator');
    }
    
    public function netData(Request $request) {

	    // $ip = '192.168.110.11';

  //       if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		//     $ip = $_SERVER['HTTP_CLIENT_IP'];
		// } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		//     $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		// } else {
		//     $ip = $_SERVER['REMOTE_ADDR'];
		// } 
	        
	    $result = [
	    		'ipAddress' => '192.168.100.11',
	    		'bitMask' => '24',
	    	];

	    if ($request->has('ipAddress')) {
	    	$result['ipAddress'] = $request->input('ipAddress');
	    	$result['bitMask'] = $request->input('bitMask');
	    }

	    $sub = new SubnetCalculator( $result['ipAddress'], $result['bitMask'] );

	    $result['ip'] = $sub->getIPAddress();
	    $result['bitmask'] = $sub->getNetworkSize();
	    $result['ipbinary'] = $sub->getIPAddressBinary();
	    $result['ipbinary'] = $sub->getIPAddressBinary();
	    $result['netmask'] = $sub->getSubnetMask();
	    $result['netmaskbin'] = $sub->getSubnetMaskBinary();
	    $result['wildcard'] = $sub->getHostPortion();
	    $result['wildcardbin'] = $sub->getHostPortionBinary();
	    $result['network'] = $sub->getNetworkPortion();
	    $result['networkbin'] = $sub->getNetworkPortionBinary();
	    $result['broadcast'] = $sub->getBroadcastAddress();
	    $result['hostmin'] = $sub->getMinHost();
	    $result['hostminbin'] = $sub->getMinHostBinary();
	    $result['hostmax'] = $sub->getMaxHost();
	    $result['hostmaxbin'] = $sub->getMaxHostBinary();
	    $result['ipsnumber'] = $sub->getNumberIPAddresses();
	    $result['hostsnumber'] = $sub->getNumberAddressableHosts();

	    return $result;
	    
	}
    
}
