<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductReportController extends Controller
{
    public function index()
    {
        // Fetch all products from the database
        $products = Product::paginate(8);
        
        return view('report.product_report', compact('products'));
    }

    public function downloadPDF()
    {
        // Fetch all products
        $products = Product::all();
        
        // Generate PDF
        $pdf = Pdf::loadView('report.product_report_pdf', compact('products'));

        // Download PDF
        return $pdf->download('product_report.pdf');
    }
}
