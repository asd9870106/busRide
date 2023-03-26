<?php
    namespace App\Http\Controllers;
    
    use Illuminate\Http\Request;
    use SimpleSoftwareIO\QrCode\Facades\QrCode;

    class QrcodeController extends Controller
    {
        public function index() {
            return view('qrcode.index');
        }
    
        public function generate(Request $request) {
            $request->validate([
                'station' => 'required|string',
            ]);
    
            $station = $request->input('station');
            $url = 'http://127.0.0.1:8000/station/'. '?station=' . urlencode($station);
            $qrCode = QrCode::size(250)->generate($url);
    
            return view('qrcode.generate', compact('station', 'qrCode'));
        }
    }
    