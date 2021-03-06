<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'HomeController@home');

/* PRODUCT */
Route::get('/product-listing', 'ProductController@product');
Route::get('/product-listing-detail/{slug}', 'ProductController@productDetail');
Route::get('/product-listing/download/{slug}', 'ProductController@downloadImage');

// Route::get('/search', function () {
//     return view('product/search');
// });

// Route::get('/search-empty', function () {
//     return view('product/search-empty');
// });

/* INFORMATION */
Route::get('/contact-us', 'PageController@contactUs');
Route::post('/submit-contact', 'PageController@submitContact');
Route::get('/about-us', 'PageController@aboutUs');
Route::get('/faq', 'PageController@faq');
Route::get('/privacy', 'PageController@privacyPolicy');
Route::get('/disclaimers', 'PageController@disclaimers');
Route::get('/regulation-details', 'PageController@regulation');
Route::get('/procurement-flow', 'PageController@procurement');
Route::get('/payment', 'PageController@payment');

/* AUTH */
Route::get('/guest', function () {
    return view('auth/guest');
});
Route::get('brand/getModel/{id}', 'QuoteController@getModel');
Route::get('brand/getModelSlug/{id}', 'QuoteController@getModelSlug');
Route::get('getPort/{country}', 'QuoteController@getPort');
Route::get('/login', 'LoginController@getViewLogin');
Route::get('/register', 'LoginController@getViewRegister');
Route::get('/facebook-login', 'LoginController@facebookLogin');
Route::get('/facebook-callback', 'LoginController@facebookCallback');
Route::get('/google-login', 'LoginController@googleLogin');
Route::get('/google-callback', 'LoginController@googleCallback');

Route::post('/submit-register', 'LoginController@submitRegister');
Route::post('/signin', 'LoginController@signin');
Route::get('/member-verified/{code}', 'LoginController@verified');

Route::get('/forgot-password', 'LoginController@getViewForgot');
Route::post('/submit-forgot', 'LoginController@submitForgot');

Route::get('/recovery', 'LoginController@recovery');
Route::post('/submit-recovery', 'LoginController@submitRecovery');

Route::get('/logout', 'LoginController@logout');
Route::post('/submit-quote-guest', 'QuoteController@submitQuoteGuest');
Route::get('/invoice', function () {
    return view('invoice');
});
Route::post('/proceedLogin', 'LoginController@proceedLogin');
/* MEMBER AREA */
Route::group(['middleware' => ['membersession']], function () {
    Route::get('/personal-info', 'MemberController@index');
    Route::post('/upload-profile', 'MemberController@uploadPhoto');
    Route::post('/update-account', 'MemberController@updateAccount');
    Route::get('/remove-photo', 'MemberController@removePhoto');
    Route::post('/submit-quote', 'QuoteController@submitQuote');
    Route::get('/transaction-history', 'MemberController@transactionHistory');
    Route::get('/quotation-history', 'MemberController@quotationHistory');
    Route::get('/shipment-documentation', 'MemberController@shipmentDocumentation');
    Route::get('/view-quotation/{id}', 'MemberController@viewQuotation');
    Route::get('/download-quotation/{id}', 'MemberController@downloadQuotation');

    Route::get('/view-shipment-document/{id}', 'MemberController@viewShipment');
    Route::get('/download-shipment-document/{id}', 'MemberController@downloadShipment');
    Route::get('/link-account', 'MemberController@linkGoogle');
});

Route::group(['prefix' => 'gtexport-admin'], function () {
    Route::get('/', function () {
        return redirect('gtexport-admin/login');
    });
    Route::get('login', 'Admin\AuthController@checkLogin');
    Route::post('auth/login', 'Admin\AuthController@login');
    Route::get('auth/logout', 'Admin\AuthController@logout');

    Route::group(['middleware' => ['checksession']], function () {
        Route::get('dashboard', 'Admin\DashboardController@view');
        Route::get('dashboard/report_product', 'Admin\DashboardController@report_product');
        Route::post('dashboard/export_report_product', 'Admin\DashboardController@export_report_product');

        Route::get('banner', 'Admin\BannerController@view')
            ->name('banner_view');
        Route::get('banner/create', 'Admin\BannerController@create');
        Route::get('banner/edit/{id}', 'Admin\BannerController@edit');
        Route::post('banner/insert', 'Admin\BannerController@insert');
        Route::post('banner/update', 'Admin\BannerController@update');
        Route::get('banner/delete/{id}', 'Admin\BannerController@delete');
        Route::get('banner/status/{id}/{status}', 'Admin\BannerController@status');
        Route::post('banner/update_sort', 'Admin\BannerController@update_sort');
        Route::post('banner/update_language', 'Admin\BannerController@updateLanguage');

        Route::get('category', 'Admin\CategoryController@view')
            ->name('category_view');
        Route::get('category/create', 'Admin\CategoryController@create');
        Route::get('category/edit/{id}', 'Admin\CategoryController@edit');
        Route::post('category/insert', 'Admin\CategoryController@insert');
        Route::post('category/update', 'Admin\CategoryController@update');
        Route::get('category/delete/{id}', 'Admin\CategoryController@delete');
        Route::get('category/status/{id}/{status}', 'Admin\CategoryController@status');
        Route::post('category/update_sort', 'Admin\CategoryController@update_sort');

        Route::get('brand', 'Admin\BrandController@view')
            ->name('brand_view');
        Route::get('brand/create', 'Admin\BrandController@create');
        Route::get('brand/edit/{id}', 'Admin\BrandController@edit');
        Route::post('brand/insert', 'Admin\BrandController@insert');
        Route::post('brand/update', 'Admin\BrandController@update');
        Route::get('brand/delete/{id}', 'Admin\BrandController@delete');
        Route::get('brand/status/{id}/{status}', 'Admin\BrandController@status');
        Route::post('brand/update_sort', 'Admin\BrandController@update_sort');

        Route::get('model', 'Admin\ModelController@view')
            ->name('model_view');
        Route::get('model/create', 'Admin\ModelController@create');
        Route::get('model/edit/{id}', 'Admin\ModelController@edit');
        Route::post('model/insert', 'Admin\ModelController@insert');
        Route::post('model/update', 'Admin\ModelController@update');
        Route::get('model/delete/{id}', 'Admin\ModelController@delete');
        Route::get('model/status/{id}/{status}', 'Admin\ModelController@status');
        Route::post('model/update_sort', 'Admin\ModelController@update_sort');

        Route::get('transmission', 'Admin\TransmissionController@view')
            ->name('transmission_view');
        Route::get('transmission/create', 'Admin\TransmissionController@create');
        Route::get('transmission/edit/{id}', 'Admin\TransmissionController@edit');
        Route::post('transmission/insert', 'Admin\TransmissionController@insert');
        Route::post('transmission/update', 'Admin\TransmissionController@update');
        Route::get('transmission/delete/{id}', 'Admin\TransmissionController@delete');
        Route::get('transmission/status/{id}/{status}', 'Admin\TransmissionController@status');
        Route::post('transmission/update_sort', 'Admin\TransmissionController@update_sort');

        Route::get('about', 'Admin\AboutController@view')
            ->name('about_view');
        Route::get('about/create', 'Admin\AboutController@create');
        Route::get('about/edit/{id}', 'Admin\AboutController@edit');
        Route::post('about/insert', 'Admin\AboutController@insert');
        Route::post('about/update', 'Admin\AboutController@update');
        Route::get('about/delete/{id}', 'Admin\AboutController@delete');
        Route::get('about/status/{id}/{status}', 'Admin\AboutController@status');
        Route::post('about/update_sort', 'Admin\AboutController@update_sort');

        Route::get('our_value', 'Admin\OurValueController@view')
            ->name('our_value_view');
        Route::get('our_value/create', 'Admin\OurValueController@create');
        Route::get('our_value/edit/{id}', 'Admin\OurValueController@edit');
        Route::post('our_value/insert', 'Admin\OurValueController@insert');
        Route::post('our_value/update', 'Admin\OurValueController@update');
        Route::get('our_value/delete/{id}', 'Admin\OurValueController@delete');
        Route::get('our_value/status/{id}/{status}', 'Admin\OurValueController@status');
        Route::post('our_value/update_sort', 'Admin\OurValueController@update_sort');
        Route::post('our_value/update_image', 'Admin\OurValueController@updateImage');

        Route::get('regulation', 'Admin\RegulationController@view')
            ->name('regulation_view');
        Route::get('regulation/create', 'Admin\RegulationController@create');
        Route::get('regulation/edit/{id}', 'Admin\RegulationController@edit');
        Route::post('regulation/insert', 'Admin\RegulationController@insert');
        Route::post('regulation/update', 'Admin\RegulationController@update');
        Route::get('regulation/delete/{id}', 'Admin\RegulationController@delete');
        Route::get('regulation/status/{id}/{status}', 'Admin\RegulationController@status');
        Route::post('regulation/update_sort', 'Admin\RegulationController@update_sort');


        Route::get('company_data', 'Admin\DashboardController@company_data')
            ->name('company_data_view');
        Route::post('company_data/update', 'Admin\DashboardController@company_data_update');

        Route::get('product', 'Admin\ProductController@view')
            ->name('product_view');
        Route::get('product/create', 'Admin\ProductController@create');
        Route::get('product/edit/{id}', 'Admin\ProductController@edit');
        Route::post('product/insert', 'Admin\ProductController@insert');
        Route::post('product/update', 'Admin\ProductController@update');
        Route::get('product/delete/{id}', 'Admin\ProductController@delete');
        Route::get('product/status/{id}/{status}', 'Admin\ProductController@status');
        Route::get('product/reserve/{id}/{status}', 'Admin\ProductController@reserve');
        Route::post('product/update_sort', 'Admin\ProductController@update_sort');
        Route::get('product/getData', 'Admin\ProductController@getData');
        Route::get('product/export', 'Admin\ProductController@export');
        Route::get('product/replace', 'Admin\ProductController@replaceimage');

        Route::get('blog', 'Admin\BlogController@view')
            ->name('blog_view');
        Route::get('blog/create', 'Admin\BlogController@create');
        Route::get('blog/edit/{id}', 'Admin\BlogController@edit');
        Route::post('blog/insert', 'Admin\BlogController@insert');
        Route::post('blog/update', 'Admin\BlogController@update');
        Route::get('blog/delete/{id}', 'Admin\BlogController@delete');
        Route::get('blog/status/{id}/{status}', 'Admin\BlogController@status');
        Route::post('blog/update_sort', 'Admin\BlogController@update_sort');
        Route::get('blog/featured/{id}/{status}', 'Admin\BlogController@featured');

        Route::get('faq_category', 'Admin\FaqCategoryController@view')
            ->name('faq_category_view');
        Route::get('faq_category/create', 'Admin\FaqCategoryController@create');
        Route::get('faq_category/edit/{id}', 'Admin\FaqCategoryController@edit');
        Route::post('faq_category/insert', 'Admin\FaqCategoryController@insert');
        Route::post('faq_category/update', 'Admin\FaqCategoryController@update');
        Route::get('faq_category/delete/{id}', 'Admin\FaqCategoryController@delete');
        Route::get('faq_category/status/{id}/{status}', 'Admin\FaqCategoryController@status');
        Route::post('faq_category/update_sort', 'Admin\FaqCategoryController@update_sort');

        Route::get('faq', 'Admin\FaqController@view')
            ->name('faq_view');
        Route::get('faq/create', 'Admin\FaqController@create');
        Route::get('faq/edit/{id}', 'Admin\FaqController@edit');
        Route::post('faq/insert', 'Admin\FaqController@insert');
        Route::post('faq/update', 'Admin\FaqController@update');
        Route::get('faq/delete/{id}', 'Admin\FaqController@delete');
        Route::get('faq/status/{id}/{status}', 'Admin\FaqController@status');
        Route::post('faq/update_sort', 'Admin\FaqController@update_sort');

        Route::get('terms', 'Admin\DashboardController@terms')
            ->name('terms_view');
        Route::post('terms/update', 'Admin\DashboardController@terms_update');

        Route::get('privacy_policy', 'Admin\DashboardController@privacy_policy')
            ->name('privacy_policy_view');
        Route::post('privacy_policy/update', 'Admin\DashboardController@privacy_policy_update');

        Route::get('disclaimers', 'Admin\DashboardController@disclaimers')
            ->name('disclaimers_view');
        Route::post('disclaimers/update', 'Admin\DashboardController@disclaimers_update');

        Route::get('reservation_time', 'Admin\DashboardController@reservationTime')
            ->name('reservation_time_view');
        Route::post('reservation_time/update', 'Admin\DashboardController@reservationTimeUpdate');

        Route::get('contact', 'Admin\DashboardController@enquiry')
            ->name('contact_view');
        Route::get('contact/detail/{id}', 'Admin\DashboardController@enquiryDetail');
        Route::get('contact/delete/{id}', 'Admin\DashboardController@enquiryDelete');

        Route::get('country', 'Admin\ShippingController@view')
            ->name('country_view');
        Route::get('country/create', 'Admin\ShippingController@create');
        Route::post('country/insert', 'Admin\ShippingController@insert');
        Route::get('country/edit/{id}', 'Admin\ShippingController@edit');
        Route::post('country/update', 'Admin\ShippingController@update');
        Route::get('country/delete/{id}', 'Admin\ShippingController@delete');

        Route::get('member', 'Admin\MemberController@view')
        ->name('member_view');
        Route::get('member/create', 'Admin\MemberController@create');
        Route::get('member/edit/{id}', 'Admin\MemberController@edit');
        Route::post('member/insert', 'Admin\MemberController@insert');
        Route::post('member/update', 'Admin\MemberController@update');
        Route::get('member/delete/{id}', 'Admin\MemberController@delete');
        Route::get('member/status/{id}/{status}', 'Admin\MemberController@status');
        Route::get('member/verified/{id}/{status}', 'Admin\MemberController@verified');
        Route::get('member/detail/{id}', 'Admin\MemberController@detail');

        Route::post('quotation/data', 'Admin\QuotationController@data');
        Route::get('quotation', 'Admin\QuotationController@view')
        ->name('quotation_view');
        Route::get('quotation/detail/{id}', 'Admin\QuotationController@detail');
        Route::post('quotation/exportToExcel', 'Admin\QuotationController@exportToExcel');
        

        Route::get('invoice', 'Admin\InvoiceController@view')
        ->name('invoice_view');
        Route::post('invoice/exportToExcel', 'Admin\InvoiceController@exportOrderToExcel');
        Route::get('invoice/create', 'Admin\InvoiceController@create');
        Route::get('invoice/detail/{id}', 'Admin\InvoiceController@detail');
        Route::get('invoice/edit/{id}', 'Admin\InvoiceController@edit');
        Route::post('invoice/insert', 'Admin\InvoiceController@insert');
        Route::post('invoice/update', 'Admin\InvoiceController@update');
        Route::post('invoice/exportToCsv', 'Admin\InvoiceController@exportCstarOrderToCsv');
        Route::post('invoice/id/{id}/export/invoice', 'Admin\InvoiceController@exportInvoice');
        Route::get('invoice/delete/{id}', 'Admin\InvoiceController@delete');
        Route::get('invoice/paid/{id}', 'Admin\InvoiceController@paidinvoice');
        Route::get('invoice/partial/{id}', 'Admin\InvoiceController@partialInvoice');
        Route::get('invoice/send/{id}', 'Admin\InvoiceController@sendInvoice');

        Route::get('change-password', 'Admin\AuthController@changePassword')->name('change_password_view');
        Route::post('auth/update', 'Admin\AuthController@updatePassword');

        Route::get('metadata', 'Admin\MetadataController@view')
            ->name('metadata_view');
        Route::get('metadata/create', 'Admin\MetadataController@create');
        Route::get('metadata/edit/{id}', 'Admin\MetadataController@edit');
        Route::post('metadata/update', 'Admin\MetadataController@update');
        Route::post('metadata/insert', 'Admin\MetadataController@insert');

        Route::get('newsletter', 'Admin\DashboardController@newsletter')
            ->name('newsletter_view');
        Route::get('newsletter/export', 'Admin\DashboardController@exportNewsletter');
        Route::get('newsletter/delete/{id}', 'Admin\DashboardController@deleteNewsletter');

        Route::get('accessories', 'Admin\AccessoriesController@view')
            ->name('accessories_view');
        Route::get('accessories/create', 'Admin\AccessoriesController@create');
        Route::get('accessories/edit/{id}', 'Admin\AccessoriesController@edit');
        Route::post('accessories/insert', 'Admin\AccessoriesController@insert');
        Route::post('accessories/update', 'Admin\AccessoriesController@update');
        Route::get('accessories/delete/{id}', 'Admin\AccessoriesController@delete');
        Route::get('accessories/status/{id}/{status}', 'Admin\AccessoriesController@status');
        Route::post('accessories/update_sort', 'Admin\AccessoriesController@update_sort');

        Route::get('shipment_document', 'Admin\ShipmentDocumentController@view')
        ->name('shipment_document_view');
        Route::get('shipment_document/create', 'Admin\ShipmentDocumentController@create');
        Route::get('shipment_document/edit/{id}', 'Admin\ShipmentDocumentController@edit');
        Route::post('shipment_document/insert', 'Admin\ShipmentDocumentController@insert');
        Route::post('shipment_document/update', 'Admin\ShipmentDocumentController@update');
        Route::get('shipment_document/delete/{id}', 'Admin\ShipmentDocumentController@delete');

        Route::get('procurement_flow', 'Admin\ProcurementFlowController@view')
            ->name('procurement_flow_view');
        Route::get('procurement_flow/create', 'Admin\ProcurementFlowController@create');
        Route::get('procurement_flow/edit/{id}', 'Admin\ProcurementFlowController@edit');
        Route::post('procurement_flow/insert', 'Admin\ProcurementFlowController@insert');
        Route::post('procurement_flow/update', 'Admin\ProcurementFlowController@update');
        Route::get('procurement_flow/delete/{id}', 'Admin\ProcurementFlowController@delete');
        Route::get('procurement_flow/status/{id}/{status}', 'Admin\ProcurementFlowController@status');
        Route::post('procurement_flow/update_sort', 'Admin\ProcurementFlowController@update_sort');
        Route::get('procurement_flow/title', 'Admin\ProcurementFlowController@title')
            ->name('procurement_flow_title');
        Route::post('procurement_flow/update_title', 'Admin\ProcurementFlowController@update_title');

        Route::get('payment', 'Admin\PaymentController@view')
            ->name('payment_view');
        Route::get('payment/create', 'Admin\PaymentController@create');
        Route::get('payment/edit/{id}', 'Admin\PaymentController@edit');
        Route::post('payment/insert', 'Admin\PaymentController@insert');
        Route::post('payment/update', 'Admin\PaymentController@update');
        Route::get('payment/delete/{id}', 'Admin\PaymentController@delete');
        Route::get('payment/status/{id}/{status}', 'Admin\PaymentController@status');
        Route::post('payment/update_sort', 'Admin\PaymentController@update_sort');

        Route::get('port', 'Admin\PortController@view')
            ->name('port_view');
        Route::get('port/create', 'Admin\PortController@create');
        Route::post('port/insert', 'Admin\PortController@insert');
        Route::get('port/edit/{id}', 'Admin\PortController@edit');
        Route::post('port/update', 'Admin\PortController@update');
        Route::get('port/delete/{id}', 'Admin\PortController@delete');
    });
});
        Route::group(['prefix' => 'laravel-filemanager'], function () {
            \UniSharp\LaravelFilemanager\Lfm::routes();
        });
        Route::group(['prefix' => 'filemanager'], function () {
            \UniSharp\LaravelFilemanager\Lfm::routes();
        });
        //Barryvdh\Elfinder\ElfinderController@showPopup


